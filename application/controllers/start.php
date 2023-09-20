<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property install_actions          $install_actions
    */  
  class Start extends CI_Controller
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
          if (!$this->language_actions->get_current_language('user_login'))
          {
              $this->load->vars('language_error',TRUE);
          }
          
          $this->load->language('user_login');
          $this->load->config('schoolboard');
      }
      
      function index()
      {
          $this->load->view('pages/login_users');
      }

      function user_login()
      {
          $this->load->view('pages/login_users');
      }
            
	  
      function check_user()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                    array('field'=>'user_email','rules'=>'required|valid_email','label'=>$this->lang->line('your_email')),
                    array('field'=>'user_password','rules'=>'required','label'=>$this->lang->line('your_password'))
          ));
          
          $view=(!$this->config->item('simple_login'))?'layout/error':'user/login';
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view($view,array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('user_actions');
          if (!$this->user_actions->check_user($this->input->post('user_email'),$this->input->post('user_password')))
          {
              exit($this->load->view($view,array('message'=>$this->lang->line('wrong_email_or_password')),TRUE));
          }
          
          if ($this->config->item('simple_login'))
          {
              header('Location: '.$this->config->item('base_url').$this->user_actions->get_person_dashboard());
              exit();
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('going_to_dashboard')));
          $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').$this->user_actions->get_person_dashboard()));
      }
      
      function accept_invite($code='')
      {
          $this->load->model('user_actions');
          if (!$this->user_actions->check_code($code,'invitation'))
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('invite_not_found')),TRUE));
          }
          
          $this->load->view('user/accept_invite',array('code'=>$code));
      }
      
      function add_user()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'code','rules'=>'requried','label'=>$this->lang->line('code')),
                array('field'=>'password','rules'=>'required','label'=>$this->lang->line('password')),
                array('field'=>'password_again','rules'=>'required|match[password]','label'=>$this->lang->line('password_again'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('user_actions');
          if (!$this->user_actions->check_code($this->input->post('code'),'invitation'))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('invite_not_found')),TRUE));
          }
          
          $result=$this->user_actions->add_user($this->input->post('password'),$this->input->post('code'));
          if (!$result)
          {
              exit($this->load->view('layout/error',array('message'=>$this->user_actions->get_error()),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('password_set')));
          $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url')));
      }
      
      function new_password()
      {
          $this->load->view('user/new_password');
      }
  }
?>