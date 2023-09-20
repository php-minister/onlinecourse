<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property registrations_actions       $registrations_actions
    * @property settings_actions       $settings_actions
    */
  class Registration extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->language('common');
          $this->load->language('registration');
      }
      
      function index($form_id=1)
      {
          $this->load->model('settings_actions');
          
          $this->load->view('registartions/new_registration',array(
            'form_id'=>$form_id,
            'school'=>$this->settings_actions->get_school_info()
          ));
      }
      
      function save_form()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'form_id','rules'=>'required','label'=>'form_id'),
                array('field'=>'student_name','rules'=>'required|max_length[100]','label'=>$this->lang->line('name')),
                array('field'=>'student_phone','rules'=>'required|max_length[50]','label'=>$this->lang->line('phone')),
                array('field'=>'student_email','rules'=>'required|max_length[60]','label'=>$this->lang->line('email'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('registrations_actions');
          
          if (!$this->registrations_actions->save_registration())
          {
              exit($this->load->view('layout/error',array('message'=>$this->registrations_actions->get_error()),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('saved')));
          $this->load->view('layout/clear_form');
      }
	  
	  function save_registration_form()
	  {
	  	  
          $this->load->model('registrations_actions');
			
			$dob = explode("/" , $this->input->get('birth_date'));
			$birth_date = $dob[2].'-'.$dob[0].'-'.$dob[1];
			
            $student_data = array('form_id'=>1,
            'student_name'=>$this->input->get('name'),
			'date_of_birth' => $birth_date,
			'gender' => $this->input->get('gender'),
            'student_phone'=>$this->input->get('phone'),
            'student_email'=>$this->input->get('email'),
			'prefered_language' =>$this->input->get('lang'),
			'country' =>$this->input->get('country'),	
			'best_time_to_call' =>$this->input->get('call_time'),						
            'student_comment'=>$this->input->get('message'),
            'registation_date'=>date('Y-m-d'),
            'last_comment'=>'',
            'comments'=>''
			);
			
			$expiration = time()-7200; // Two hour limit
			$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);	
			
			// Then see if a captcha exists:
			$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
			$binds = array($this->input->get('captcha'), $this->input->ip_address(), $expiration);
			$query = $this->db->query($sql, $binds);
			$row = $query->row();
			
			if ($row->count == 0)
			{
				$response = 'captcha';
				$arr = array('response' => $response);
				echo json_encode($arr);
				return;
			}			
						  	  		  
	  	  $is_inserted = $this->registrations_actions->save_registration_form($student_data);		 
		  if($is_inserted == 'success')
		  {
				$response = 'success';
				$arr = array('response' => $response);
				echo json_encode($arr);			  
		  }
		  if($is_inserted == 'exist')
		  {
				$response = 'exist';
				$arr = array('response' => $response);
				echo json_encode($arr);			  
		  }
          
	  }	  
  }
  
?>