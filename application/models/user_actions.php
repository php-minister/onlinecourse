<?php
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property language_actions          $language_actions
    */
  class User_actions  extends CI_Model
  {
      private $error;
      
      function __construct()
      {
          parent::__construct();
      }
      
      function is_loged_in($person_type='',$redirect=TRUE)
      {
          if ($person_type=='')
          {
              $person_type=$this->session->userdata('person_type');
          }
          
          if ((isset($this->session->userdata['user_id'])) AND ($this->session->userdata['person_type']==$person_type))
          {
              if (!$this->language_actions->get_current_language(strtolower($person_type)))
              {
                  $this->load->vars('language_error',TRUE);
              }
              
              $this->load->language('common');
              $this->load->language(strtolower($person_type));
              return TRUE;
          }
          
          if (!$redirect)
          {
              return FALSE;
          }
          
          if ($this->input->is_ajax_request())
          {
              exit($this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'start'),TRUE));
          }
          
          header('Location:'.$this->config->item('base_url').'start');
          exit;
      }
      
      function check_user($user_email,$password)
      {
          $result=$this->db
                       ->select('user_id,user_password,password_salt,person_type,person_id,name')
                       ->where(array('user_email'=>$user_email,'is_active'=>1))
                       ->get('users')
                       ->row_array();
          
          if (count($result)==0)
          {
              return FALSE;
          }
          
          if (hash('sha512',$result['password_salt'].$password)!=$result['user_password'])
          {
              return FALSE;
          }
          
          $this->db->select('avatar');
          switch($result['person_type'])
          {
              case 'student':
              {
                  $result['avatar']=$this->db
                                         ->where('student_id',$result['person_id']) 
                                         ->get('students');
                  break;
              }
              case 'teacher':
              {
                  $result['avatar']=$this->db
                                         ->where('teacher_id',$result['person_id'])
                                         ->get('teachers');
                  break;
              }
              case 'parent':
              {
                  $result['avatar']=$this->db
                                         ->where('parent_id',$result['person_id']) 
                                         ->get('parents');
                  break;
              }
              case 'donor':
              {
                 $result['avatar']=$this->db
                                         ->where('donor_id',$result['person_id']) 
                                         ->get('donors');
                  break; 
              }
          }
          
          $result['avatar']=$result['avatar']->row_array();
          $result['avatar']=$result['avatar']['avatar'];
          
          $this->load->helper('extract_first_name');
          $result['full_name']=$result['name'];
          $result['name']=extract_first_name($result['name']);
          unset($result['password_salt'],$result['user_password']);
          
          $this->session->unset_userdata('admin_id');
          $this->session->set_userdata($result);
          $this->db->update('users',array('last_login'=>date('Y-m-d H:i:s'),'last_logout'=>NULL),array('user_id'=>$result['user_id']));
          return TRUE;
      }
      
      function logout()
      {
          $this->db->update('users',array('last_logout'=>date('Y-m-d H:i:s')),array('user_id'=>$this->session->userdata('user_id')));
          $this->session->sess_destroy();
      }
      
      function add_invitation_code($user_data,$code_type='confirm')
      {
         $code=md5(rand().time().rand());
         
         $this->db->insert('activation_codes',array('code'=>$code,'type'=>$code_type,'user_data'=>serialize($user_data)));
         
         return $code;
      }
      
      function check_code($code,$code_type)
      {
          return $this->db
                      ->select('type')
                      ->where(array('code'=>$code,'type'=>$code_type))
                      ->get('activation_codes')
                      ->num_rows()==0?FALSE:TRUE;
      }
      
      function add_user($password,$activation_code)
      {
          $code=$this->db
                     ->select('user_data')
                     ->where('code',$activation_code)
                     ->get('activation_codes')
                     ->row_array();
          
          $code['user_data']=unserialize($code['user_data']);
          $user_type = '';
          $this->db->select('email,name');
          switch($code['user_data']['type'])
          {
              case 'teacher':
              {
					$user_type = 'teachers';   
                  $this->db
                       ->where('teacher_id',$code['user_data']['id'])
                       ->from('teachers');

                  break;
              }
              case 'student':
              {
				  $user_type = 'students';
                  $this->db
                       ->where('student_id',$code['user_data']['id'])
                       ->from('students');
					   
                  break;
              }
              case 'parent':
              {
				  $user_type = 'parents';
                  $this->db
                       ->where('parent_id',$code['user_data']['id'])
                       ->from('parents');
                  break;
              }
              case 'donor':
              {
				  $user_type = 'donors';
                  $this->db
                       ->where('donor_id',$code['user_data']['id'])
                       ->from('donors');
                  break;
              }
          }
          
          $person=$this->db->get()->row_array();
          
          if ($this->db
                   ->select('user_id')
                   ->where('user_email',$person['email'])
                   ->get('users')
                   ->num_rows()>0)
          {
              $this->set_error('Email already in use. Please ask administrator to change your email');
              return FALSE;
          }
          
          $this->load->helper('key_generator_helper');
          $key=generate_key();
          
          $this->db->insert('users',array('user_password'=>hash('sha512',$key.$password),'password_salt'=>$key,'user_email'=>$person['email'],'is_active'=>1,'person_type'=>$code['user_data']['type'],'person_id'=>$code['user_data']['id'],'name'=>$person['name']));
		  
          $this->db->update( $user_type , array('status'=>'Active'),array('email'=>$person['email']));
          $this->db->delete('activation_codes',array('code'=>$activation_code));
          
          return TRUE;
      }
      
      function set_error($error)
      {
          $this->error=$error;
      }
      
      function get_error()
      {
          return $this->error;
      }
      
      function get_person_dashboard()
      {
          return ($this->session->userdata('person_type')=='parent')?'children':$this->session->userdata('person_type');
      }
      
      function get_person_type()
      {
          return $this->session->userdata('person_type');
      }
      
      function change_password($current_password,$new_password)
      {
          $current_password_data=$this->db
                                      ->select('user_password,password_salt')  
                                      ->where('user_id',$this->session->userdata('user_id'))
                                      ->get('users')
                                      ->row_array();
          
          if ($current_password_data['user_password']!=hash('sha512',$current_password_data['password_salt'].$current_password))
          {
              return FALSE;
          }
          
          $this->db->update('users',array('user_password'=>hash('sha512',$current_password_data['password_salt'].$new_password)),array('user_id'=>$this->session->userdata('user_id')));
          
          return TRUE;
      }
  }
?>