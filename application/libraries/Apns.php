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
      $environment = $ci->config->item('apns_environment');

      require_once(APPPATH.'libraries/ApnsPHP/Autoload.php');

      $this->environment = ApnsPHP_Abstract::ENVIRONMENT_SANDBOX;
      if ($environment == 'production')
         $this->environment = ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION;
   }

   function send_message($key, $text, $badge = 0)
   {
      $socket = new ApnsPHP_Push($this->environment, $this->certificate_path);
      $socket->setRootCertificationAuthority($this->root_certificate_path);
      $socket->connect();

      $message = new ApnsPHP_Message($key);
      $message->setCustomIdentifier('notification');
      $message->setBadge($badge);
      $message->setText($text);
      $message->setSound();
      $message->setExpiry(30);

      $socket->add($message);

      try {
         $socket->send();
         $socket->disconnect();
      } 
      catch (Exception $e)
      {
         return false;
      }

      $errors = $socket->getErrors();
      if (!empty($errors))
         return false;

      return true;
   }
}
