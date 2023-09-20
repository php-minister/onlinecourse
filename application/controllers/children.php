<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property parents_actions          $parents_actions
    * @property scheduling_actions          $scheduling_actions
    * @property incidents_actions          $incidents_actions
    * @property gradebook_actions          $gradebook_actions
    * @property attendance_actions          $attendance_actions
    * @property notification_actions          $notification_actions
    * @property pdf_actions          $pdf_actions
    */
  
  class Children extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('parent');
      }
      
      function index()
      {
          $this->load->model('school_model');
          $this->load->model('parents_actions');
          $this->load->model('notification_actions');
          
          $this->load->view('parent/index',array(
                'children'=>$this->parents_actions->get_children(),
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function scheduling($student_id=0)
      {
          $this->load->model('school_model');
          $this->load->model('parents_actions');
          if (!$this->parents_actions->is_child($student_id))
          {
			  header('Location:'.$this->config->item('base_url').'children');
			  
          }
		  $this->load->model('students_actions');	          
		  $student_data = $this->students_actions->get_student($student_id);
		  $student_name = $student_data['name'];		  
		  
          $this->load->model('scheduling_actions');
          $this->load->model('notification_actions');
          $this->load->vars('student_id',$student_id);
          $this->load->vars('scheduling',$this->scheduling_actions->get_student_scheduling($student_id,$this->input->get('month')));
		  $this->load->vars('student_name',$student_name);		  
		            
          if (($this->input->get('pdf')==='') AND ($this->input->get('month')!=''))
          {
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('parent_scheduling');
          }

		            
          $this->load->view('parent/scheduling',array(
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
	  function get_children_schedule_details($student_id,$scheduling_id)
	  {
		  $this->load->model('scheduling_actions');
		  
		  echo  $this->scheduling_actions->get_children_schedule_details($student_id , '' ,$scheduling_id);
	  }
	  

      function incidents($student_id=0)
      {
         $this->load->model('school_model');
         $this->load->model('parents_actions');
         if (!$this->parents_actions->is_child($student_id))
         {
             exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('error')),TRUE));
         }
         
          $this->load->model('students_actions');	          
		  $student_data = $this->students_actions->get_student($student_id);
		  $student_name = $student_data['name'];		  
		  $this->load->vars('student_name',$student_name);
		  
		 $this->load->model('incidents_actions');
         $this->load->model('notification_actions');
         
         $this->load->view('parent/incidents',array(
                'incidents'=>$this->incidents_actions->get_person_incidents('student',$student_id),
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
         ));
      }
      
      function gradebook($student_id=0)
      {
          $this->load->model('school_model');
          $this->load->model('parents_actions');
          if (!$this->parents_actions->is_child($student_id))
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          $this->load->model('gradebook_actions');
          $this->load->model('notification_actions');
          
          if (!$this->input->get('semester_id'))
          {
              $semesters=$this->gradebook_actions->get_student_semesters($student_id);    
              $this->load->vars('semesters',$semesters);
              $semester_id=(isset($semesters[0]['semester_id']))?$semesters[0]['semester_id']:0;
          }
          else
          {
              $semester_id=$this->input->get('semester_id');
          }
          
          $this->load->vars('student_id',$student_id);
          $this->load->vars('semester_id',$semester_id);
          $this->load->vars('gradebook',$this->gradebook_actions->get_student_gradebook($semester_id,$student_id));
          
          if (($this->input->get('pdf')==='') AND ($this->input->get('semester_id')>0))
          {
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('parent_gradebook');
          }
          
          $this->load->view('parent/gradebook',array(
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      
      function get_semester_gradebook($student_id=0,$semester_id=0)
      {
          $this->load->model('school_model');
          $this->load->model('parents_actions');
          if (!$this->parents_actions->is_child($student_id))
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('error')),TRUE));
          }
          
          $this->load->model('gradebook_actions');
          $this->load->view('student/gradebook_data',array(
                'gradebook'=>$this->gradebook_actions->get_student_gradebook($semester_id,$student_id)
          ));
      }
      
      function attendance($student_id=0)
      {
          $this->load->model('school_model');
          $this->load->model('parents_actions');

          if (!$this->parents_actions->is_child($student_id))
          {
              exit($this->load->view('layout/error_page',array('message'=>$this->lang->line('error')),TRUE));
          }
		  $this->load->model('students_actions');	          
		  $student_data = $this->students_actions->get_student($student_id);
		  $student_name = $student_data['name'];


          $this->load->model('attendance_actions');
          $this->load->model('notification_actions');
          $this->load->vars('student_id',$student_id);
		  $this->load->vars('student_name',$student_name);		  
          $this->load->vars('attendance',$this->attendance_actions->get_student_attendance($student_id,$this->input->get('month')));
          
          if (($this->input->get('pdf')==='') AND ($this->input->get('month')!=''))
          {
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('parent_attendance');
          }
          
          $this->load->view('parent/attendance',array(
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
  }
?>