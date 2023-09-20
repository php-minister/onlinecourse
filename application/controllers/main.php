<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property users_actions       $users_actions
    */
    
  class Main extends CI_Controller
  {
	  function __construct()
	  {
		  parent::__construct();
	  }
	  
	  function index()
	  {
		  $data['current_pages'] = 'home';
		  $this->load->view('pages/index' , $data);
      }
	  
	  function about_us()
	  {
		  $data['current_pages'] = 'about_us';
		  $this->load->view('pages/about_us' , $data);
	  }
	  
	  function management()
	  {
		  $data['current_pages'] = 'management';
		  $this->load->view('pages/management', $data);
	  }
	  function testimonials()
	  {
		  $data['current_pages'] = 'testimonials';
		  $this->load->view('pages/testimonials' , $data);
	  }
	  
	  function courses()
  	  {
		  $data['current_pages'] = 'courses';		  
		  $this->load->view('pages/courses' , $data);
	  }
	  
	  function students_area()
	  {
		  $data['current_pages'] = 'students';
		  $this->load->view('pages/students' , $data);
	  }
	  
	  function media()
	  {
		  $data['current_pages'] = 'media';
		  $this->load->view('pages/media' , $data);
	  }
	  
	  function contact_us()
	  {
		$this->load->helper('captcha');
		$vals = array(
			'img_path'	 => './captcha/',
			'img_url'	 =>  $this->config->item('base_url').'captcha/',
			'font_path' => $this->config->item('base_url').'fonts/OpenSans-Regular',
			'img_width'	 => '200',
    		'img_height' => 30,
			
			);
		
		$cap = create_captcha($vals);
		
		$data = array(
			'captcha_time'	=> $cap['time'],
			'ip_address'	=> $this->input->ip_address(),
			'word'	 => $cap['word']
			);
		
		$query = $this->db->insert_string('captcha', $data);
		$this->db->query($query);

		$data['captcha'] = $cap['image'];		
		
		   $data['current_pages'] = 'contact_us';
		   $this->load->view('pages/contact_us' , $data);
	  }
	  
	  function register()
	  {
		  
			$this->load->helper('captcha');
			$vals = array(
				'img_path'	 => './captcha/',
				'img_url'	 =>  $this->config->item('base_url').'captcha/',
				'img_width'	 => '230',
				'img_height' => 30,
				
				);
			
			$cap = create_captcha($vals);
			
			$data = array(
				'captcha_time'	=> $cap['time'],
				'ip_address'	=> $this->input->ip_address(),
				'word'	 => $cap['word']
				);
			
			$query = $this->db->insert_string('captcha', $data);
			$this->db->query($query);
	
			$data['captcha'] = $cap['image'];		
					  
		   $data['current_pages'] = 'register';
		   $this->load->view('pages/register' , $data);
	  }
	  
	  function faqs()
	  {
		   $data['current_pages'] = 'faqs';
		   $this->load->view('pages/faqs' , $data);		  
	  }
		
		function newsletter_signup()
		{
			$first_name = $this->input->get('first_name');
			$last_name = $this->input->get('last_name');
			$email_id = $this->input->get('email');
			$newsletter_data = array('first_name' => $first_name , 'last_name' => $last_name , 'email_id' => $email_id);
			
			$this->load->model('Contact');
			$q = $this->Contact->news_letter_singup($newsletter_data);
			if($q)
			{
				$result_array = array('response'=> 'success');
				echo json_encode($result_array);
			}
			
		}		  
  }