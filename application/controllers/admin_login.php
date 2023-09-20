<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions          $admin_actions
    */
  class Admin_login extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('install_actions');
          if (!$this->install_actions->is_installed())
          {
              header('Location:'.$_SERVER['REQUEST_URI'].'/../install');
              exit();
          }
          
          $this->load->model('language_actions');
          if (!$this->language_actions->get_current_language('admin_login'))
          {
              $this->load->vars('language_error',TRUE);
          }
          
          $this->load->language('admin_login');
          $this->load->config('schoolboard');
      }
      
      function  index()
      {
         $this->load->view('admin/login');
      }
      
      function check_admin()
      {
          $this->load->library('form_validation');
          
          $this->form_validation->set_rules(array(
                                                array('field'=>'admin_name','rules'=>'required','label'=>$this->lang->line('login')),
                                                array('field'=>'password','rules'=>'required','label'=>$this->lang->line('password'))
          ));
          
          $view=(!$this->config->item('simple_login'))?'layout/error':'admin/login';
          
          if ($this->form_validation->run()===FALSE)
          {
             exit($this->load->view($view,array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('admin_actions');
          
          if (!$this->admin_actions->check_admin($this->input->post('admin_name'),$this->input->post('password')))
          {
              exit($this->load->view($view,array('message'=>$this->lang->line('login_password_wrong')),TRUE));
          }
          
          if ($this->config->item('simple_login'))
          {
              header('Location: '.$this->config->item('base_url').'admin');
              exit();
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('going_to_dashboard')));
          $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'admin'));
      }
  }
?>