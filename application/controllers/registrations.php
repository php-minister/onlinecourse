<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property registrations_actions       $registrations_actions
    */
  
  class Registrations extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__);
          
      }
      
      function index()
      {
          $this->load->model('registrations_actions');
          
          $this->load->view('registartions/view_form',array(
            'form'=>array('form_id'=>1,'form_name'=>$this->lang->line('default')),
            'registrations'=>$this->registrations_actions->get_registrations(1)
          ));
      }
      
      function view($registration_id=0)
      {
          $this->load->model('registrations_actions');
          $this->load->view('registartions/view',array(
            'registration'=>$this->registrations_actions->get_registration($registration_id)
          ));
      }
      
      function add_comment()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'registration_id','rules'=>'required','label'=>'registration_id'),
                array('field'=>'comment','rules'=>'required','label'=>$this->lang->line('comment'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('registrations_actions');
          $this->registrations_actions->add_comment();
          
          $this->load->view('registartions/comment_added',array(
            'comment'=>$this->input->post('comment'),
            'registration'=>$this->registrations_actions->get_registration($this->input->post('registration_id'))
          ));
      }
      
      function accept($registration_id=0)
      {
          $this->load->model('registrations_actions');
          if (!$this->registrations_actions->accept_registration($registration_id))
          {
              exit($this->load->view('layout/error',array('message'=>$this->registrations_actions->get_error()),TRUE));
          }
          
          $this->load->view('registartions/accepted',array(
            'grade'=>$this->registrations_actions->get_used_grade(),
            'registration_id'=>$registration_id
          ));
      }
      
      function decline($registration_id=0)
      {
          $this->load->model('registrations_actions');
          if (!$this->registrations_actions->decline_registration($registration_id))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          $this->load->view('registartions/declined',array(
            'registration_id'=>$registration_id
          ));
      }
  }
?>