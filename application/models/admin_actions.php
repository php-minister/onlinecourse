<?php
   /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property language_actions          $language_actions
    */ 
  class Admin_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function is_loged_in($language='',$permisssion='')    
      {
          if ($permisssion=='')
          {
              $permisssion=strtolower($language);
          }
          
          if ((!isset($this->session->userdata['admin_id'])) OR (!isset($this->session->userdata['permissions'][$permisssion]) AND !isset($this->session->userdata['permissions']['global_admin'])))
          {
              if ($this->input->is_ajax_request())
              {
                  echo $this->load->view('layout/redirect',array('url'=>$this->config->item('base_url').'admin_login'),TRUE);
              }
              else
              {
                  header('Location:'.$this->config->item('base_url').'admin_login');
              }
              exit;
          }
          
          
          if (!$this->language_actions->get_current_language('admin_common'))
          {
              $this->load->vars('language_error',TRUE);
          }
          
          $this->load->language('common');
          $this->load->language('admin_common');
          if ($language!='')
          {
              $this->load->language(strtolower($language));    
          }
      }
      
      function check_admin($admin_login,$password)
      {
          $result=$this->db
                       ->select('admin_id,admin_name,admin_password,admin_salt,admin_permissions') 
                       ->where('admin_login',$admin_login)
                       ->limit(1)
                       ->get('admins')
                       ->row_array();
          
          if (count($result)==0)
          {
              return FALSE;
          }
          
          if (hash('sha512',$result['admin_salt'].$password)!=$result['admin_password'])
          {
              return FALSE;
          }
          
          $result['permissions']=unserialize($result['admin_permissions']);
          
          unset($result['admin_salt'],$result['admin_password'],$this->session->userdata['user_id'],$result['admin_permissions']);
          
          $this->session->set_userdata($result);
          return TRUE;
      }
      
      function logout()
      {
          $this->session->sess_destroy();
      }
      
      function change_password($current_password,$new_password)
      {
          $current_password_data=$this->db
                                      ->select('admin_password,admin_salt')
                                      ->where('admin_id',$this->session->userdata('admin_id'))
                                      ->get('admins')
                                      ->row_array();
          
          if ($current_password_data['admin_password']!=hash('sha512',$current_password_data['admin_salt'].$current_password))
          {
              return FALSE;
          }
          
          $this->db->update('admins',array('admin_password'=>hash('sha512',$current_password_data['admin_salt'].$new_password)),array('admin_id'=>$this->session->userdata('admin_id')));
          
          return TRUE;
      }
      
      function is_allowed($permission)
      {
          return isset($this->session->userdata['permissions'][$permission]) OR (isset($this->session->userdata['permissions']['global_admin']));
      }
      
      function get_url()
      {
          if (($this->is_allowed('admin')) OR ($this->is_allowed('teachers')))
          {
              return 'teachers';
          }
          
          if (($this->is_allowed('import')))
          {
              return 'import';
          }
          
          if (($this->is_allowed('messages_center')))
          {
              return 'messages_center';
          }
          
          if (($this->is_allowed('fees')))
          {
              return 'fees';
          }
          
          if ($this->is_allowed('registrations'))
          {
              return 'registrations';
          }
          
          if ($this->is_allowed('students'))
          {
              return 'students';
          }
          
          if ($this->is_allowed('users'))
          {
              return 'users/staff';
          }
          
          return 'admin_login';
      }
  }
?>