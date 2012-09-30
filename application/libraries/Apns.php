<?php
require_once('ApnsPHP/Autoload.php');

class Apns {
   
   private $CONNECTION = null;

   private $certificate_path = '';
   private $root_certificate_path = '';

   public function __construct()
   {
      $ci =& get_instance();
      $ci->config->load('apns');
      $this->certificate_path = $ci->config->item('certificate_path');
      $this->root_certificate_path = $ci->config->item('root_certificate_path');

      $this->CONNECTION = new ApnsPHP_Push(ApnsPHP_Abstract::ENVIRONMENT_PRODUCTION, $this->certificate_path);
      $this->CONNECTION->setRootCertificationAuthority($this->root_certificate_path);
   }

   public function send_message($key, $message)
   {
      $message = new ApnsPHP_Message($key);
      $message->setCustomIdentifier('notification');
      $message->setText($message);
      $message->setSound();
      $message->setExpiry(30);

      $this->CONNECTION->connect();
      $this->CONNECTION->add($message);
      $this->CONNECTION->send();
      $this->CONNECTION->disconnect();
   }

}
