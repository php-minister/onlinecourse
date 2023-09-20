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
	
	class Contact extends CI_Controller{
		
		function __construct()
		{
			parent::__construct();
		}
		
		
		function contact_admin()
		{

			$data['name'] = $this->input->get('name');
			$data['email'] = $this->input->get('email');
			$data['subject'] = $this->input->get('subject');
			$data['message'] = $this->input->get('message');
							
			$html_email = $this->load->view('contact/contact_us_email_template', $data, true);
			$config = Array(
				'mailtype'  => 'html', 
				'charset' => 'utf-8',		  
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
				exit;
			}


			$this->load->library('email', $config);
			

			$this->email->from($this->input->get('email'));
			$this->email->to('mohsinshah89@gmail.com');
			$this->email->subject('Contact form');
			$this->email->message($html_email);
			

			if($this->email->send())
			{
				$response = 'success';
				$arr = array('response' => $response);
				echo json_encode($arr);
			}
			else
			{
				return false;
			}			
			
		}

	}	