<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property students_actions       $students_actions
    * @property groups_actions       $groups_actions
    * @property scheduling_actions       $scheduling_actions
    */
  class Students extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__);
      }
      
      function index()
      {
          $this->load->view('students/index');
      }
      
      function data()
      {
          $this->load->model('students_actions');
          $students=$this->students_actions->get_students();
           
          echo json_encode(array(
                    "sEcho" => intval($this->input->get('sEcho')),
                    "iTotalRecords" => $students['count'],
                    "iTotalDisplayRecords" =>$students['rows'],
                    "aaData" =>$students['data']
               ));
      }
	  
      
      function new_student()
      {
          $this->load->model('groups_actions');
          $this->load->view('students/new_student',array(
                        'grades'=>$this->groups_actions->get_grades(),
                        'groups'=>$this->groups_actions->get_groups_list()
          ));
      }
      
      function save_student()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                        array('field'=>'student_id','rules'=>'required|is_numeric','label'=>$this->lang->line('student_id')),
                        array('field'=>'student_name','rules'=>'required','label'=>$this->lang->line('student_name')),
                        array('field'=>'email','rules'=>'required|valid_email','label'=>$this->lang->line('email')),
                        array('field'=>'grade','rules'=>'required','label'=>$this->lang->line('grade')),
                        array('field'=>'part_of_donation','rules'=>'greater_than[-1]|less_than[100.1]','label'=>$this->lang->line('part_of_donation'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit(json_encode(array('error_message'=>$this->form_validation->error_string())));
          }
          
          if (($this->input->post('birth_date')) AND (!strtotime($this->input->post('birth_date'))) )
          {
              exit(json_encode(array('error_message'=>$this->lang->line('error_wrong_date'))));
          }
          
          $this->load->model('students_actions');
          
          if (!$this->students_actions->check_user_email($this->input->post('email'),$this->input->post('student_id'),'student'))
          {
              exit (json_encode(array('error_message'=>$this->lang->line('error_email_used'))));
          }
          
           $save_result=$this->students_actions->save_student();
		
		  if($this->input->post('fee_name') != '' && $this->input->post('amount') != '')
		  {

				  if ($this->input->post('subscription_payment')=='on')
				  {
					  $this->form_validation->set_rules(array(
							array('field'=>'time_period','rules'=>'required','label'=>$this->lang->line('time_period'))
					  ));
				  }
				  
				  if ($this->form_validation->run()==FALSE)
				  {
					  exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
				  }
				  
				  
				  
				  if (!in_array($this->input->post('time_period'),array('1_M')))
				  {
					  exit($this->load->view('layout/error',array('message'=>$this->lang->line('wrong_time_period')),TRUE));
				  }
				  
				  $this->load->model('fee_actions');
				 if ($this->input->post('student_id')=='0')
        		 {
				  	$this->fee_actions->save_fee($save_result['result']);
				 }
				 else
				 {
					 $this->fee_actions->save_fee($this->input->post('student_id'));
				 }						 
		  }
          
          if (!$save_result)
          {
              exit(json_encode(array('error_message'=>$this->scheduling_actions->get_error())));
          }
          
          echo json_encode($save_result);
      }
      
      function edit($student_id=0)
      {
          $this->load->model('students_actions');
          $this->load->model('groups_actions');
          $this->load->view('students/edit_student',array(
                        'student'=>$this->students_actions->get_student($student_id),
                        'grades'=>$this->groups_actions->get_grades(),
                        'groups'=>$this->groups_actions->get_groups_list()
          ));
      }
      
      function resend_invitation($student_id=0)
      {
          $this->load->model('students_actions');
          $this->students_actions->resend_invitation($student_id,'student');
          $this->load->view('layout/success',array('message'=>$this->lang->line('invitation_sent')));
      }
      
      function change_status($new_status='',$student_id=0)
      {
          $this->load->model('students_actions');
          $result=$this->students_actions->change_status($new_status,$student_id);
          if (!$result)
          {
              exit (json_encode(array('error_message'=>$this->students_actions->get_error())));
          }
          echo json_encode(array('message'=>$this->lang->line('done')));
      }
      
      function find_student()
      {
          $this->load->model('students_actions');
          echo json_encode($this->students_actions->get_students_list());
      }
	  
	  
      function scheduling($student_id=0)
      {
          $this->load->model('school_model');
          $this->load->model('parents_actions');
          
          $this->load->model('scheduling_actions');
          $this->load->model('notification_actions');
          $this->load->vars('student_id',$student_id);
          $this->load->vars('scheduling',$this->scheduling_actions->get_student_scheduling($student_id,$this->input->get('month')));
          
          if (($this->input->get('pdf')==='') AND ($this->input->get('month')!=''))
          {
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('parent_scheduling');
          }
          
          $this->load->view('students/scheduling',array(
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
      	  
      function attendance($student_id=0)
      {
          $this->load->model('school_model');
          $this->load->model('parents_actions');
      
          
          $this->load->model('attendance_actions');
          $this->load->model('notification_actions');
          $this->load->vars('student_id',$student_id);
          $this->load->vars('attendance',$this->attendance_actions->get_student_attendance($student_id,$this->input->get('month')));
          
          if (($this->input->get('pdf')==='') AND ($this->input->get('month')!=''))
          {
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('parent_attendance');
          }
          
          $this->load->view('students/attendance',array(
                'notifications'=>$this->notification_actions->get_new_notifications(),
                'messages'=>$this->notification_actions->get_new_messages()
          ));
      }		  
	  
	  function payment_history($student_id = 0)
	  {
			  $this->load->model('students_actions');
			  $this->load->model('groups_actions');
			  $this->load->view('students/edit_student',array(
							'student'=>$this->students_actions->get_student($student_id),
							'grades'=>$this->groups_actions->get_grades(),
							'groups'=>$this->groups_actions->get_groups_list()
			  ));
	  }
	  
	  function edit_class_url($student_id = 0)
	  {
          $this->load->model('students_actions');          
          $this->load->view('students/edit_student_url',array(
                        'student'=>$this->students_actions->get_student($student_id),                        
          ));		  
	  }
	  
	  function save_student_url()
	  {
		  $this->load->model('students_actions');
		 $save_result =  $this->students_actions->save_student_url();
		  echo json_encode($save_result);
	  }
  }
?>