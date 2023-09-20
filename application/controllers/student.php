<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property scheduling_actions          $scheduling_actions
    * @property incidents_actions          $incidents_actions
    * @property gradebook_actions          $gradebook_actions
    * @property notification_actions          $notification_actions
    * @property feedback_actions          $feedback_actions
    * @property students_actions          $students_actions
    * @property content_actions          $content_actions
    */ 
  class Student extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('student');
      }
      
      function index()
      {
           $this->load->model('scheduling_actions');
           $this->load->model('notification_actions');
           $this->load->view('student/index',array(
                'scheduling'=>$this->scheduling_actions->get_student_scheduling(),
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
           ));
      }
      
	  function get_schedule()
	  {
	          $this->load->model('scheduling_actions');		  
			  $this->load->vars('scheduling',$this->scheduling_actions->get_student_scheduling());              
			  
			  $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('student_schedule');		  
	  }
	  
	  function get_particular_schedule($scheduling_id)
	  {
		  $this->load->model('scheduling_actions');
		  
		  echo  $this->scheduling_actions->get_schedule_details(0 , '' ,$scheduling_id);
	  }
	  
      function left_comment($lesson_id=0)
      {
          $this->load->model('school_model');
          $this->load->model('students_actions');
          if (!$this->students_actions->is_student_involved($lesson_id))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('not_involved')),TRUE));
          }
          
          $this->load->model('attendance_actions');
          if (!$this->attendance_actions->is_student_presented($lesson_id))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('was_absent')),TRUE));
          }
          
          $this->load->model('scheduling_actions');
          $this->load->model('feedback_actions');
          
          $this->load->view('student/lesson_comment',array(
            'lesson'=>$this->scheduling_actions->get_lesson_details($lesson_id),
            'is_comment_added'=>$this->feedback_actions->is_comment_added($lesson_id)
          ));
      }
      
      function save_comment()
      {
          if (!$this->input->post('scheduling_id'))
          {
              exit($this->load->view('layout/error',array('message'=>'scheduling_id'),TRUE));
          }
          
          if (!$this->input->post('score') AND !$this->input->post('comment'))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('nothing_to_add')),TRUE));
          }
          
          $this->load->model('school_model');
          $this->load->model('students_actions');
          if (!$this->students_actions->is_student_involved($this->input->post('scheduling_id')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('not_involved')),TRUE));
          }
          
          $this->load->model('attendance_actions');
          if (!$this->attendance_actions->is_student_presented($this->input->post('scheduling_id')))
          {
              exit($this->load->view('layout/error',array('message'=>$this->lang->line('was_absent')),TRUE));
          }
          
          $this->load->model('feedback_actions');
          if ($lesson=$this->feedback_actions->add_comment())
          {
              $this->load->view('student/feedback_added',array('lesson'=>$lesson));
          }
      }
      
      function incidents()
      {
          $this->load->model('school_model');
          $this->load->model('incidents_actions');
          $this->load->model('notification_actions');
          
          $this->load->view('student/incidents',array(
            'incidents'=>$this->incidents_actions->get_person_incidents('student'),
            'notifications'=>$this->notification_actions->get_new_notifications(),
            'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function gradebook()
      {
          $this->load->model('gradebook_actions');
          $semesters=$this->gradebook_actions->get_student_semesters();
          $this->load->model('notification_actions');
          
          $this->load->view('student/gradebook',array(
                'semesters'=>$semesters,
                'gradebook'=>$this->gradebook_actions->get_student_gradebook(isset($semesters[0]['semester_id'])?$semesters[0]['semester_id']:0),
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function get_semester_gradebook($semester_id=0)
      {
         $this->load->model('gradebook_actions');
         $this->load->view('student/gradebook_data',array(
            'gradebook'=>$this->gradebook_actions->get_student_gradebook($semester_id)
         ));
      }
      
      function library()
      {
          $this->load->model('content_actions');
          $this->load->model('notification_actions');
          
          $this->load->view('student/library',array(
            'library'=>$this->content_actions->get_student_library(),
            'notifications'=>$this->notification_actions->get_new_notifications(),
            'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function download($item_id=0)
      {
          $this->load->model('content_actions');
          $this->content_actions->download_library_item($item_id);
      }
  }
?>