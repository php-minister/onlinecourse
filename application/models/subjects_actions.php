<?php
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property teachers_actions           $teachers_actions
    */  
  class Subjects_actions  extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function get_subjects()
      {
          return $this->db
                      ->select('subjects.subject_id,subjects.name,GROUP_CONCAT(DISTINCT teachers.name SEPARATOR ", ") as `teachers`',FALSE)  
                      ->join('teacher_subjects','teacher_subjects.subject_id = subjects.subject_id','LEFT')
                      ->join('teachers','teachers.teacher_id = teacher_subjects.teacher_id','LEFT')
                      ->group_by('subjects.subject_id')
                      ->get('subjects')
                      ->result_array();
      }
      
      function get_subject($subject_id)
      {
          $result['subject']=$this->db
                                  ->select('subject_id,name')
                                  ->where('subject_id',$subject_id)
                                  ->get('subjects')
                                  ->row_array();
          
          $result['grades']=$this->db
                                 ->select('grades.grade_id as id,grades.name',FALSE) 
                                 ->join('grades','grades.grade_id = teacher_subjects.grade_id  AND grades.is_active=1','LEFT')
                                 ->where('subject_id',$subject_id)
                                 ->where('grades.grade_id IS NOT ','NULL',FALSE)
                                 ->group_by('teacher_subjects.grade_id')
                                 ->get('teacher_subjects')
                                 ->result_array();
          
          $result['teachers']=$this->db
                                   ->select('teachers.teacher_id as id, CONCAT(name,"<span class=\'person_details\'> (",ssn,")</span>") as name',FALSE) 
                                   ->join('teachers','teachers.teacher_id = teacher_subjects.teacher_id','LEFT')
                                   ->where('subject_id',$subject_id)
                                   ->group_by('teacher_subjects.teacher_id')
                                   ->get('teacher_subjects')
                                   ->result_array();
          
          return $result;
      }
      
      private function assing_subject($subject_id,$teachers,$grades)
      {
          $this->db->delete('teacher_subjects',array('subject_id'=>$subject_id));
          $assigment=array();
          foreach($teachers as $teacher_id)
          {
              foreach($grades as $grade_id)
              {
                  $assigment[]=array('subject_id'=>$subject_id,'teacher_id'=>$teacher_id,'grade_id'=>$grade_id);
              }
          }
          $this->db->insert_batch('teacher_subjects',$assigment);
      }
      
      function save_subject()
      {
          $data=array('name'=>$this->input->post('name'));
          if ($this->input->post('subject_id')=='0')
          {
              $this->db->insert('subjects',$data);
              $subject_id=$result=$this->db->insert_id();
          }
          else
          {
              $this->db->update('subjects',$data,array('subject_id'=>$this->input->post('subject_id')));    
              $subject_id=$this->input->post('subject_id');
              $result=TRUE;
          }
          
          $this->assing_subject($subject_id,json_decode($this->input->post('teachers_list'),TRUE),json_decode($this->input->post('grades_list'),TRUE));
          
          return $result;
      }
      
      function delete_subject($subject_id)
      {
         $this->db->delete('teacher_subjects',array('subject_id'=>$subject_id));
         $this->db->delete('subjects',array('subject_id'=>$subject_id));
      }
  }
?>