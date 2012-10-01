<?php

class Apns {
   
   private $CONNECTION = null;

   private $certificate_path = '';
   private $root_certificate_path = '';
   private $environment = 'development';

   public function __construct()
   {
      $ci =& get_instance();
      $ci->config->load('apns');
      $this->certificate_path = $ci->config->item('certificate_path');
      $this->root_certificate_path = $ci->config->item('root_certificate_path');
      $this->environment = $ci->config->item('apns_environment');

      require_once(APPPATH.'libraries/ApnsPHP/Autoload.php');

      $environment = ApnsPHP_Abstract::ENVIRONMENT_SANDBOX;
      if ($this->environment == 'production')
         $environment = ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION;

      $this->CONNECTION = new ApnsPHP_Push($environment, $this->certificate_path);
      $this->CONNECTION->setRootCertificationAuthority($this->root_certificate_path);
   }

   public function send_message($key, $text)
   {
      $message = new ApnsPHP_Message($key);
      $message->setCustomIdentifier('notification');
      // $message->setBadge(1);
      $message->setText($text);
      $message->setSound();
      $message->setExpiry(30);

      $this->CONNECTION->connect();
      $this->CONNECTION->add($message);
      $this->CONNECTION->send();
      $this->CONNECTION->disconnect();

   }
}
