<?php

class Apns {
   
   private $CONNECTION = null;

   private $certificate_path = '';
   private $root_certificate_path = '';
   private $environment = 'development';

   function __construct()
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
      $this->CONNECTION->connect();
   }

   function send_message($key, $text, $badge = 0)
   {
      $message = new ApnsPHP_Message($key);
      $message->setCustomIdentifier('notification');
      $message->setBadge($badge);
      $message->setText($text);
      $message->setSound();
      $message->setExpiry(30);

      $this->CONNECTION->add($message);
      $this->CONNECTION->send();

      return true;
   }

   function __destruct()
   {
      $this->CONNECTION->disconnect();
   }
}
