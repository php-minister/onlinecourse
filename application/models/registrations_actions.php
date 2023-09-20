<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property settings_actions          $settings_actions
    * @property school_model          $school_model
    */ 
  
  class Registrations_actions extends CI_Model
  {
      private $grade;
      
      private $error;
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_registrations($form_id)
      {
          return $this->db
                      ->select('registration_id,student_name, student_phone, best_time_to_call , country , prefered_language , registation_date,registration_status,last_comment')
                      ->where('form_id',$form_id)
                      ->get('registrations')
                      ->result_array();
      }
      
      function get_registration($registration_id)
      {
         return $this->db
                      ->select('*')
                      ->where('registration_id',$registration_id)
                      ->get('registrations')
                      ->row_array(); 
      }
      
      function add_comment()
      {
          $this->db->query('UPDATE registrations SET last_comment=?,comments=CONCAT(IFNULL(comments,""),?) WHERE registration_id=?',array($this->input->post('comment'),'<li>'.$this->input->post('comment').'<br/> <i><small>'.date('d M Y h:i A').', '.$this->lang->line('by').' '.$this->session->userdata('admin_name').'</small></i></li>',$this->input->post('registration_id')));
      }
      
      function accept_registration($registration_id)
      {
          $student=$this->db
                        ->select('student_name as name, date_of_birth as birth_date , gender , student_phone as home_phone,student_phone as cell_phone,student_email as email')
                        ->where(array('registration_id'=>$registration_id,'registration_status'=>'Open'))
                        ->get('registrations')
                        ->row_array();
          
          if (count($student)==0)
          {
              $this->set_error($this->lang->line('registration_not_active'));
              return FALSE;
          }
          
          if ($this->is_email_used($student['email']))
          {
              $this->set_error($this->lang->line('email_used'));
              return FALSE;
          }
          
          
          $this->load->model('settings_actions');
          $this->grade=$this->settings_actions->get_first_grade();
             
          $student['grade']=$this->grade['grade_id'];
          $student['group']=$this->grade['group_id'];
          
          $this->db->insert('students',$student);
          $student_id=$this->db->insert_id();
          
          $this->load->model('school_model');
          $this->school_model->invite_person('student',$student_id,$student['name'],$student['email']);
          
          $_POST['comment']=$this->lang->line('Accepted');
          $_POST['registration_id']=$registration_id;
          $this->add_comment();
          
          $this->db->update('registrations',array('registration_status'=>'Accepted'),array('registration_id'=>$registration_id));
          
          return TRUE;
      }
      
      function get_used_grade()
      {
          return $this->grade;
      }
      
      function decline_registration($registration_id)
      {
         $_POST['comment']=$this->lang->line('Declined');
         $_POST['registration_id']=$registration_id;
         $this->add_comment();
          
         $this->db->update('registrations',array('registration_status'=>'Declined'),array('registration_id'=>$registration_id)); 
         
         return TRUE;
      }
      
      private function is_email_used($email)
      {
          return $this->db
                      ->select('student_id')
                      ->where('email',$email)
                      ->get('students')
                      ->num_rows()==0?FALSE:TRUE;
      }
      
      function get_error()
      {
          return $this->error;
      }
      
      private function set_error($error)
      {
          $this->error=$error;
      }
      
      function save_registration()
      {
          if ($this->is_email_used($this->input->post('student_email')))
          {
             $this->set_error($this->lang->line('email_used'));
             return FALSE; 
          }
          
          $this->db->insert('registrations',array(
            'form_id'=>$this->input->post('form_id'),
            'student_name'=>$this->input->post('student_name'),
            'student_phone'=>$this->input->post('student_phone'),
            'student_email'=>$this->input->post('student_email'),
            'student_comment'=>$this->input->post('student_comment'),
            'registation_date'=>date('Y-m-d'),
            'last_comment'=>'',
            'comments'=>''
          ));
          
          return TRUE;
      }
	  
	  function save_registration_form($student_data)
	  {

		  $student_email = $student_data["student_email"];
          if ($this->is_email_used($student_email))
          {
             $this->set_error($this->lang->line('email_used'));
             return 'exist'; 
          }          
          if($this->db->insert('registrations',$student_data))
		  {
			  return 'success';
		  }
      	  
	  }
  }
?>