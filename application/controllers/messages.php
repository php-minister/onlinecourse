<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property notification_actions          $notification_actions
    * @property messages_actions          $messages_actions
    */
  class Messages extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in();
          if ($this->session->userdata('person_type')=='teacher')
          {
              $this->load->model('settings_actions');
              $this->load->vars('settings',$this->settings_actions->get_settings('global'));
          }
      }
      
      function index()
      {
          $this->load->model('notification_actions');
          $this->load->model('messages_actions');
          
          $this->load->view('messages/messages',array(
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages_list'=>$this->messages_actions->get_messages(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function thread($thread_id=0)
      {
          $this->load->model('messages_actions');
          if (!$this->messages_actions->check_permissions($thread_id))
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          $this->load->model('notification_actions');
          
          $this->load->view('messages/thread',array(
                'thread'=>$this->messages_actions->get_thread($thread_id,TRUE),
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function reply($thread_id=0)
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                                            array('field'=>'new_message','rules'=>'required|max_length[2000]','label'=>$this->lang->line('new_message'))
            ));
            
          if ($this->form_validation->run()===FALSE)
          {
              exit ($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('messages_actions');
          if (!$this->messages_actions->check_permissions($thread_id))
          {
              $this->load->view('layout/error',array('message'=>$this->lang->line('error')));
          }
          
          $this->messages_actions->add_message($thread_id);
          
          $this->load->view('messages/add_message',array(
                                                    'message'=>preg_replace('/\n/si','<br/>',addslashes($this->input->post('new_message'))),
                                                    'autor'=>$this->session->userdata('full_name'),
                                                    'avatar'=>$this->session->userdata('avatar'),
            ));
      }
      
      function new_message()
      {
          $this->load->model('notification_actions');
          $this->load->model('messages_actions');
          
          $this->load->view('messages/new_message',array(
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function send_message()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'message','rules'=>'required|max_length[2000]','label'=>$this->lang->line('message')),
                array('field'=>'subject','rules'=>'required|max_length[200]','label'=>$this->lang->line('subject'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          if ($this->session->userdata('person_type')=='student')
          {
              unset($_POST['students_list'],$_POST['parents_list'],$_POST['to_all_students'],$_POST['to_all_parents'],$_POST['to_all_teachers']);
          }
          
          if ($this->session->userdata('person_type')=='parent')
          {
              unset($_POST['students_list'],$_POST['to_all_students']);
          }
          
          if ((!isset($_POST['teachers_list'])) AND (!isset($_POST['students_list'])) AND (!isset($_POST['parents_list'])) AND ($_POST['to_admin']!='on') )
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('one_recipient')),TRUE));
          }
          
          if (
            (!is_array(json_decode($this->input->post('teachers_list'),TRUE))) AND 
            (!is_array(json_decode($this->input->post('students_list'),TRUE))) AND 
            (!is_array(json_decode($this->input->post('parents_list'),TRUE))) AND 
            ($this->input->post('to_admin')!='on')
          )
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('one_recipient')),TRUE));
          }
          
          $this->load->model('messages_actions');
          if (!$this->messages_actions->create_thread())
          {
              exit($this->load->view('layout/error',array('message'=>$this->messages_actions->get_error()),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('message_sent')));
          $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'messages'));
      }
  }
?>