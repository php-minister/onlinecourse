<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property reports_actions       $reports_actions
    * @property teachers_actions       $teachers_actions
    * @property settings_actions       $settings_actions
    */
  class Reports extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__);
      }
      
      function index()
      {
          
      }
      
      function payments()
      {
          $this->load->model('reports_actions');
          $this->load->model('settings_actions');
          
          $this->load->view('reports/last_payments',array(
            'payments'=>$this->reports_actions->get_last_payments(),
            'currency'=>$this->settings_actions->get_setting('current_currency')
          ));
      }
      
      function get_payments($fee_id=0)
      {
          $this->load->model('reports_actions');
          $this->load->model('settings_actions');
          
          $this->load->view('reports/payments',array(
            'payments'=>$this->reports_actions->get_payments($fee_id),
            'currency'=>$this->settings_actions->get_setting('current_currency')
          ));
      }
      
      function teachers_feedback()
      {
          $this->load->model('reports_actions');
          $this->load->view('reports/last_teacher_feedbacks',array('feedbacks'=>$this->reports_actions->get_last_teacher_comments()));
      }
      
      function get_teacher_feedbacks($teacher_id=0)
      {
          $this->load->model('reports_actions');
          
          $this->load->view('reports/teacher_feedbacks',array(
            'feedbacks'=>$this->reports_actions->get_teacher_feedbacks($teacher_id)
          ));
      }
      
      function students_attendance()
      {
          $this->load->model('reports_actions');
          $this->load->view('reports/last_students_attendance',array('attendance'=>$this->reports_actions->get_last_student_attendance()));
      }
      
      function get_student_attendance($student_id=0)
      {
          $this->load->model('reports_actions');
          $this->load->view('reports/student_attendance',array('attendance'=>$this->reports_actions->get_student_attendance($student_id)));
      }
      
      function donations()
      {
          $this->load->model('reports_actions');
          $this->load->model('settings_actions');
          
          $this->load->view('reports/donations',array(
            'donations'=>$this->reports_actions->get_donations(),
            'currency'=>$this->settings_actions->get_setting('current_currency')
          ));
      }
      
      function donated()
      {
          $this->load->model('reports_actions');
          $this->load->model('settings_actions');
          
          $this->load->view('reports/donated',array(
            'donated'=>$this->reports_actions->get_donated(),
            'currency'=>$this->settings_actions->get_setting('current_currency')
          ));
      }
	  
	  function donors_report()
	  {
		$this->load->view('reports/donors');  
	  }
  }
?>