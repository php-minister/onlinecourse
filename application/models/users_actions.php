<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */ 
  class Users_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function get_staff()
      {
         return $this->db
                     ->select('admin_id,admin_name,admin_login')
                     ->where('admin_id!=',1,FALSE)
                     ->get('admins')
                     ->result_array();
      }
      
      function delete_employee($employee_id)
      {
          $this->db->where('admin_id!=',1,FALSE);
          $this->db->delete('admins',array('admin_id'=>$employee_id));
      }
      
      function is_login_busy()
      {
         return $this->db
                     ->select('admin_id')  
                     ->where('admin_login',$this->input->post('admin_login'))
                     ->where('admin_id!=',$this->input->post('employee_id'),FALSE)
                     ->get('admins')
                     ->num_rows()==0?FALSE:TRUE;
      }
      
      function save_employee()
      {
          $permissions=array();
          $this->load->config('schoolboard');
          $persmissions_template=$this->config->item('permissions_template');
          foreach($persmissions_template as $permission=>$default_value)
          {
              if ($this->input->post($permission)=='on')
              {
                  $permissions[$permission]=TRUE;
              }
          }
          
          $data=array(
            'admin_name'=>$this->input->post('admin_name'),
            'admin_login'=>$this->input->post('admin_login'),
            'admin_permissions'=>serialize($permissions)
          );
          
          if ($this->input->post('admin_password'))
          {
              $this->load->helper('key_generator');
              $password_salt=generate_key();
              
              $data['admin_password']=hash('sha512',$password_salt.$this->input->post('admin_password'));
              $data['admin_salt']=$password_salt;
          }
          
          
          if ($this->input->post('employee_id')=='0')
          {
              $this->db->insert('admins',$data);
              return $this->db->insert_id();
          }
          
          $this->db->where('admin_id!=',1,FALSE);
          $this->db->update('admins',$data,array('admin_id'=>$this->input->post('employee_id')));
          return TRUE;
      }
      
      function get_employee($employee_id)
      {
          return $this->db
                      ->select('admin_id,admin_name,admin_login,admin_permissions')
                      ->where('admin_id!=',1,FALSE)
                      ->where('admin_id',$employee_id)
                      ->get('admins')
                      ->row_array();
      }
  }
?>