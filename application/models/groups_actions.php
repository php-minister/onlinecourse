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
  class Groups_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function get_groups()
      {
          return $this->db
                      ->select('group_id,group_name,name')
                      ->join('grades','grades.grade_id = students_groups.grade_id')
                      ->where('is_deleted',0)
                      ->get('students_groups')
                      ->result_array();
      }
      
      function save_group()
      {
          $data=array(
                'group_name'=>$this->input->post('name'),
                'grade_id'=>$this->input->post('grade')
          );
          
          if ($this->input->post('group_id')=='0')
          {
              $this->db->insert('students_groups',$data);
              return $this->db->insert_id();
          }
          
          $this->db->update('students_groups',$data,array('group_id'=>$this->input->post('group_id')));
          return TRUE;
      }                                              
      
      function get_group($group_id)
      {
          return $this->db
                      ->select('group_id,group_name,grade_id')
                      ->where('group_id',$group_id)
                      ->where('is_deleted',0)
                      ->get('students_groups')
                      ->row_array();
      }
      
      function delete_group($group_id)
      {
          if ($this->db
                   ->select('group') 
                   ->where('group',$group_id)
                   ->get('students')
                   ->num_rows()>0)
          {
              return FALSE;
          }
          
          $this->db->update('students_groups',array('is_deleted'=>1),array('group_id'=>$group_id));
          $this->db->where('student_group>',0,FALSE);
          $this->db->delete('scheduling',array('student_group'=>$group_id));
          return TRUE;
      }
      
      function get_groups_list()
      {
          $temp=$this->db
                     ->select('group_id,group_name,grade_id')
                     ->where('is_deleted',0)
                     ->get('students_groups')
                     ->result_array();
          $groups=array();
          foreach($temp as $group)
          {
              $groups[$group['grade_id']][]=array('name'=>$group['group_name'],'id'=>$group['group_id']);
          }
          
          return $groups;
      }
      
      function get_grades()
      {
          return $this->db
                      ->select('grade_id,name,grade_id as id')
                      ->where('is_active',1)
                      ->get('grades')
                      ->result_array();
      }
      
      function find_groups()
      {
          return $this->db
                      ->select('group_id as id,CONCAT(group_name," (",name,")") as name',FALSE)
                      ->join('grades','grades.grade_id = students_groups.grade_id')
                      ->where('is_deleted',0)
                      ->where('( group_name LIKE "%'.$this->input->post('query').'%" OR name LIKE "%'.$this->input->post('query').'%")',NULL,FALSE)
                      ->order_by('name')
                      ->limit(20)
                      ->get('students_groups')
                      ->result_array();
      }
      
      function get_teachers_groups_list()
      {
          return $this->db
                      ->select('group_id as id,CONCAT(group_name," (",name,")") as name',FALSE)  
                      ->join('grades','grades.grade_id = teacher_subjects.grade_id AND is_active=1','LEFT')
                      ->join('students_groups','students_groups.grade_id = teacher_subjects.grade_id AND is_deleted=0','LEFT')
                      ->where('teacher_id',$this->session->userdata('person_id'))
                      ->where('group_name IS NOT NULL',NULL,FALSE)
                      ->where('( group_name LIKE "%'.$this->input->post('query').'%" OR name LIKE "%'.$this->input->post('query').'%")',NULL,FALSE)
                      ->group_by('teacher_subjects.grade_id')
                      ->order_by('name')
                      ->limit(20)
                      ->get('teacher_subjects')
                      ->result_array();
      }
  }
?>