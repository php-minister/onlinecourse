<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions     $admin_actions
    * @property report_actions     $report_actions
    */
    
  class Admin extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__);
      }
      
      function index()
      {
		  
         $this->load->model('fee_actions');
         $this->load->language('settings');
         $this->load->model('settings_actions');		  

          $this->load->model('registrations_actions');          		  
          $this->load->view('admin/dashboard' ,array(
            'form'=>array('form_id'=>1,'form_name'=>$this->lang->line('default')),
            'registrations'=>$this->registrations_actions->get_registrations(1),
			 'payments'=>$this->fee_actions->get_pending_payments(),
            'currency'=>$this->settings_actions->get_setting('current_currency')
          ));
      }
      
      function logout()
      {
          $this->admin_actions->logout();
          header('Location:'.$this->config->item('base_url').'admin');
      }
      
      function new_password()
      {
          $this->load->view('admin/new_password');
      }
      
      function change_password()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                                array('field'=>'current_password','rules'=>'required','label'=>$this->lang->line('current_password')),
                                array('field'=>'new_password','rules'=>'required','label'=>$this->lang->line('new_password')),
                                array('field'=>'new_password_again','rules'=>'required|matches[new_password]','label'=>$this->lang->line('new_password_again'))
          ));
          
          if ($this->form_validation->run()===FALSE)
          {
              exit ($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if (!$this->admin_actions->change_password($this->input->post('current_password'),$this->input->post('new_password')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error_wrong_password')),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('password_changed')));
      }
  }
?>