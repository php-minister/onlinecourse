<?php
   /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property email_actions           $email_actions
    */ 
  class Classrooms_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function get_classrooms()
      {
          return $this->db
                      ->select('room_id,name,is_shared')
                      ->where('is_deleted',0)
                      ->order_by('name','ASC')
                      ->get('classrooms')
                      ->result_array();
      }
      
      function save_classroom()
      {
          $data=array(
                'name'=>$this->input->post('name'),
                'is_shared'=>$this->input->post('is_shared')=='on'?1:0
          );
          
          if ($this->input->post('classroom_id')=='0')
          {
              $this->db->insert('classrooms',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('classrooms',$data,array('room_id'=>$this->input->post('classroom_id')));
          return TRUE;
      }
      
      function get_classroom($classroom_id)
      {
         return $this->db
                      ->select('room_id,name,is_shared')
                      ->where('room_id',$classroom_id)
                      ->where('is_deleted',0)
                      ->get('classrooms')
                      ->row_array(); 
      }
      
      function delete_classroom($classroom_id)
      {
         if ($this->db
                  ->select('scheduling_id')
                  ->where(array('room_id'=>$this->db->escape($classroom_id),'`date`>='=>'CURDATE()'),NULL,FALSE)
                  ->limit(1)
                  ->get('scheduling')
                  ->num_rows()>0)
         {
             return FALSE;
         }
          
         $this->db->update('classrooms',array('is_deleted'=>1),array('room_id'=>$classroom_id));
         
         return TRUE;
      }
  }
?>