<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property install_actions       $install_actions
    */
    
  class Install extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('install_actions');
      }
      
      function index()
      {
         if ($this->install_actions->is_installed())
         {
             exit($this->load->view('layout/success_page',array('message'=>'Application already installed. <a href="'.$this->config->item('base_url').'">Go to application</a>'),TRUE));
         }
         
         $this->load->view('install/index');
      }
      
      function save_config()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'database_host','rules'=>'required','label'=>'Database host'),
                array('field'=>'database_name','rules'=>'required','label'=>'Database name'),
                array('field'=>'database_user','rules'=>'required','label'=>'Database user'),
                array('field'=>'database_password','rules'=>'required','label'=>'Database password'),
                array('field'=>'admin_password','rules'=>'required','label'=>'Admin password'),
                array('field'=>'admin_password_again','rules'=>'required|matches[admin_password]','label'=>'Admin password again'),
                array('field'=>'school_name','rules'=>'requried','label'=>'School name'),
                array('field'=>'base_url','rules'=>'required','label'=>'Applicaion url')
          ));
          
          
          if ($this->form_validation->run()===FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('install_actions');
          if (!$this->install_actions->install())
          {
              exit($this->load->view('layout/error',array('message'=>$this->install_actions->get_error()),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>'Application sucessfully installed. You can login as admin'));
          $this->load->view('layout/redirect',array('url'=>$this->input->post('base_url').'/admin'));
      }
  }
?>