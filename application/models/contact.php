<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property fpdf2           $fpdf2
    * @property fpdf           $fpdf
    * @property students_actions           $students_actions
    * @property semesters_actions           $semesters_actions
    */
  
  	
		class Contact extends CI_Model
		{
			function __construct()
			{
				parent::__construct();
			}			
			
			function send_email()
			{
				$name = $this->input->post('name');
				$email = $this->input->post('email');
				$subject = $this->input->post('subject');
				$message = $this->input->post('message');
			}
			
			function news_letter_singup($newsletter_data)
			{
				$q = $this->db->insert('newsletter_signup' , $newsletter_data);
				if($q)
				{
					return "success";
				}
			}
			
		}
		  
  
  ?>