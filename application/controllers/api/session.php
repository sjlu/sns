<?php

class Session extends API_Controller {

   function index_get()
   {
   	$this->load->library('session');
   	$this->load->library('users_model');

   	$user = $this->session->userdata('user');

      $this->response(array('user' => $this->users_model->get_user($user)));
   }

   function index_post()
   {
      $email = $this->post('email');
      $password = $this->post('password');

      if (empty($email) || empty($password))
         $this->error_response(100);

      $this->load->model("users_model");
      if ($user = $this->users_model->validate($email, $password))
      {
	      $this->load->library("session");
         $session = array('user' => $user['id']);
         $this->session->set_userdata($session);
      }
      else
         $this->error_response(1);

      $this->response(array('success' => 'Authenticated, session created.', 'user' => $user));
   }

   function index_delete()
   {
      $this->load->library("session");
      $this->session->sess_destroy();

      $this->response(array('success' => 'Logged out, session destroyed.'));
   }

}