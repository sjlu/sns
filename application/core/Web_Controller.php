<?php

class Web_Controller extends CI_Controller
{
   function __construct()
   {
      parent::__construct();
      $this->main = new MY_Controller();
   }
}