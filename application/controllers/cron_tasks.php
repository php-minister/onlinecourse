<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property email_actions          $email_actions
    * @property cron_actions          $cron_actions
    */ 
  class Cron_tasks extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          if (!$this->input->is_cli_request())
          {
              //show_404();
              //exit();
          }
      }
      
      function run_cron()
      {
          $this->load->model('cron_actions');
          $this->cron_actions->run_tasks();
      }
      
      function send_emails()
      {
          $this->load->model('cron_actions');
          $this->cron_actions->run_tasks('send_emails');
      }
      
      function test()
      {
         $this->load->model('cron_actions');
         $this->cron_actions->run_tasks('check_payments'); 
      }
	  
	  function deduct_from_donor()
	  {
		  $this->load->model('cron_actions');
		 $fees = $this->cron_actions->cron_deduct_from_donor();
	  }
  }
?>