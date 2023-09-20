<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property settings_actions          $settings_actions
    */
  
  class Gradebook_actions extends CI_Model
  {
      private $error;
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_current_semester()
      {
          return $this->db
                      ->select('semester_id,name,start_date,end_date,year_start,year_end,is_active,is_completed')
                      ->where('CURDATE()>=','start_date',FALSE)
                      ->where('CURDATE()<=','end_date',FALSE)
                      ->limit(1)
                      ->get('semesters')
                      ->row_array();
      }
      
      function get_grades()
      {
          return $this->db
                      ->select('grades.grade_id,name,group_id,group_name')
                      ->join('students_groups','students_groups.grade_id = grades.grade_id AND is_deleted=0','LEFT')
                      ->where('is_active',1)
                      ->order_by('order','ASC')
                      ->get('grades')
                      ->result_array();
      }
      
      function get_teacher_grades()
      {
          return $this->db
                      ->select('grades.grade_id,name,group_id,group_name')  
                      ->join('grades','grades.grade_id = teacher_subjects.grade_id AND is_active=1','LEFT')
                      ->join('students_groups','students_groups.grade_id = grades.grade_id AND is_deleted=0','LEFT')
                      ->where('teacher_id',$this->session->userdata('person_id'))
                      //->where('group_id IS NOT ','NULL',FALSE)
                      ->group_by('grade_id')
                      ->get('teacher_subjects')
                      ->result_array();
      }
      
      function get_subjects($grade_id,$teacher_id=0)
      {
          $grade_id=explode('-',$grade_id);
          if ($teacher_id>0)
          {
              $this->db->where('teacher_id',$teacher_id);
          }
          return $this->db
                      ->select('subjects.subject_id,name')
                      ->join('subjects','teacher_subjects.subject_id = subjects.subject_id','LEFT')
                      ->where('teacher_subjects.grade_id',$grade_id[0])
                      ->group_by('subjects.subject_id')
                      ->get('teacher_subjects')
                      ->result_array();
      }
      
      function get_students($group_id,$page_id,$assignment_id)
      {
          $group_id=explode('-',$group_id);
          $this->db
               ->select('SQL_CALC_FOUND_ROWS students.student_id,name,set_id,score,label,comment,private_comment',FALSE)
               ->where('grade',$group_id[0]);
          
          if ($group_id[1]>0)
          {
              $this->db->where('group',$group_id[1]);
          }
          else
          {
              $this->db
                   ->select('group_name')
                   ->join('students_groups','students_groups.group_id = students.`group` AND is_deleted=0','LEFT');
          }
          
          $this->db->_reserved_identifiers[]=(int)$assignment_id;
          
          $data =$this->db
                      ->join('gradebook_scores','gradebook_scores.set_id = '.(int)$assignment_id.' AND gradebook_scores.student_id = students.student_id','LEFT')  
                      ->where_in('students.`status`',array('Active','Inactive'))
                      ->order_by('name','ASC')
                      ->limit(12,($page_id-1)*12)
                      ->get('students')
                      ->result_array();
          
          $rows=$this->db->query('SELECT FOUND_ROWS() as `rows`')->row_array();
         
          return array('data'=>$data,'rows'=>ceil($rows['rows']/12));
      }
      
      function get_grade_sets($group_id,$subject_id,$teacher_id=0)
      {
          $group_id=explode('-',$group_id);
          
          if ($group_id[1]==0)
          {
              $this->db->where('group_id',0);
          }
          
          if ($teacher_id>0)
          {
              $this->db->where('autor_id',$teacher_id);
          }
          
          return $this->db
                        ->select('set_id,`date`,gradebook_sets.name',FALSE)
                        ->join('semesters','gradebook_sets.date>=semesters.start_date AND gradebook_sets.date<=semesters.end_date','LEFT')
                        ->where(array('grade_id'=>(int)$group_id[0],'subject_id'=>(int)$subject_id,'CURDATE()>='=>'semesters.start_date','CURDATE()<='=>'semesters.end_date'),NULL,FALSE)
                        ->order_by('set_id','DESC')
                        ->get('gradebook_sets')
                        ->result_array();
      }
      
      private function set_error($error)
      {
          $this->error=$error;
      }
      
      function get_error()
      {
          return $this->error;
      }
      
      function save_new_scores($scores)
      {
          $this->load->model('settings_actions');
          $scale=$this->settings_actions->get_settings('scale');
          $scale=unserialize($scale['scale']);
          foreach($scores as $set_id=>$students)
          {
              if ($this->db
                       ->select('set_id')
                       ->join('semesters','semesters.semester_id = gradebook_sets.semester_id','LEFT')
                       ->where('set_id',$set_id)
                       ->where(array('CURDATE()>='=>'start_date','CURDATE()<='=>'end_date'),NULL,FALSE)
                       ->get('gradebook_sets')
                       ->num_rows()==0)
              {
                  $this->set_error($this->lang->line('can_not_change_past_semester'));
                  return FALSE;
              }
              
              foreach($students as $student_id=>$value)
              {
                  if (is_null($value))
                  {
                      $this->db->delete('gradebook_scores',array('set_id'=>$set_id,'student_id'=>$student_id));
                      continue;
                  }
                  
                  $value=round((float)$value,2);
                  if ($value<0)
                  {
                      continue;
                  }
                  
                  $value=min($value,999);
                  
                  if (count($scale)==0)
                  {
                     $this->add_student_score($set_id,$value,'',$student_id); 
                     continue;
                  }
                  
                  $added=FALSE;
                  foreach($scale as $min=>$scale_details)
                  {
                      if (((float)$min<=$value) AND (((float)$scale_details['max']+1)>$value))
                      {
                          $this->add_student_score($set_id,$value,$scale_details['label'],$student_id);
                          $added=TRUE;
                          break;
                      }
                  }
                  
                  //add maximum label
                  if (!$added)
                  {
                      $this->add_student_score($set_id,$value,$scale_details['label'],$student_id);
                  }
              }
          }
          
          return TRUE;
      }
      
      private function add_student_score($set_id,$value,$label,$student_id)
      {
         if (!isset($this->session->userdata['admin_id'])) 
         {
             $this->db->_reserved_identifiers[]=(int)$student_id;
             if ($this->db
                      ->select('student_id')
                      ->join('students','students.student_id = '.(int)$student_id.' AND students.grade = teacher_subjects.grade_id','LEFT')
                      ->where('teacher_id',$this->session->userdata('person_id'))
                      ->where('student_id IS NOT ','NULL',FALSE)
                      ->limit(1)
                      ->get('teacher_subjects')
                      ->num_rows()==0)
             {
                 //this teacher doesn't teach this student
                 return FALSE;
             }
         }
         
         $this->db->query('INSERT INTO gradebook_scores(set_id,student_id,score,label)
                           SELECT ?,student_id,?,?
                           FROM students
                           WHERE student_id=? AND `status` IN ("Active","Inactive")
                           ON DUPLICATE KEY UPDATE score=?,label=?',array($set_id,$value,$label,$student_id,$value,$label));
      }
      
      function delete_set($set_id,$teacher_id=0)
      {
          if ($this->db
                   ->select('set_id')
                   ->join('semesters','semesters.semester_id = gradebook_sets.semester_id','LEFT')
                   ->where('set_id',$set_id)
                   ->where(array('CURDATE()>='=>'start_date','CURDATE()<='=>'end_date'),NULL,FALSE)
                   ->get('gradebook_sets')
                   ->num_rows()==0)
          {
              return FALSE;
          }
          
          if ($teacher_id>0)
          {
              $this->db->where('autor_id',$teacher_id);
          }
          
          $this->db->delete('gradebook_sets',array('set_id'=>$set_id));
          if ($this->db->affected_rows()>0)
          {
              $this->db->delete('gradebook_scores',array('set_id'=>$set_id));    
          }
          
          return TRUE;
      }
      
      function save_set()
      {
          $semester=$this->get_current_semester();
          
          if ((strtotime($this->input->post('date'))<strtotime($semester['start_date'])) OR (strtotime($this->input->post('date'))>strtotime($semester['end_date'])) )
          {
              $this->set_error($this->lang->line('date_is_out_of_range'));
              return FALSE;
          }
          
          $data=array(
                'set_id'=>$this->input->post('set_id'),
                'name'=>$this->input->post('name'),
                'semester_id'=>$semester['semester_id'],
                'date'=>date('Y-m-d',strtotime($this->input->post('date')))
          );
          
          if ($this->input->post('set_id')=='0')
          {
              $group_id=explode('-',$this->input->post('group_id'));
              $data['grade_id']=$group_id[0];
              $data['group_id']=$group_id[1];
              $data['subject_id']=$this->input->post('subject_id');
              $data['autor_id']=(isset($this->session->userdata['admin_id']))?0:$this->session->userdata('person_id');
              
              $this->db->insert('gradebook_sets',$data);
              return $this->db->insert_id();
          }
          
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('autor_id',$this->session->userdata('person_id'));
          }
          
          $this->db->update('gradebook_sets',$data,array('set_id'=>$this->input->post('set_id'),'semester_id'=>$semester['semester_id']));
          
          return TRUE;
      }
      
      function get_set($set_id)
      {
          $this->db->where('set_id',$set_id);
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('autor_id',$this->session->userdata('person_id'));
          }
          return $this->db
                      ->select('*')
                      ->get('gradebook_sets')
                      ->row_array();
      }
      
      function get_student_semesters($person_id=0)
      {
          return $this->db->query('SELECT semesters.*,grades.name as grade_name,grades.grade_id 
                                   FROM (
                                        SELECT set_id
                                        FROM gradebook_scores
                                        WHERE student_id=?
                                        GROUP BY set_id
                                   ) AS T
                                   LEFT JOIN gradebook_sets ON gradebook_sets.set_id = T.set_id
                                   LEFT JOIN semesters ON semesters.semester_id = gradebook_sets.semester_id
                                   LEFT JOIN grades ON grades.grade_id = gradebook_sets.grade_id
                                   WHERE start_date IS NOT NULL AND grades.name IS NOT NULL
                                   GROUP BY semesters.semester_id
                                   ORDER BY start_date DESC',array(($person_id==0)?$this->session->userdata('person_id'):$person_id))
                                   ->result_array();
      }
      
      function get_student_gradebook($semester_id,$person_id=0)
      {
          return $this->db
                      ->select('date,gradebook_sets.name,score,label,subjects.name as subject_name,gradebook_sets.subject_id')
                      ->join('gradebook_scores','gradebook_scores.set_id = gradebook_sets.set_id AND student_id='.($person_id==0?$this->session->userdata('person_id'):$person_id),'LEFT')
                      ->join('subjects','subjects.subject_id = gradebook_sets.subject_id','LEFT')
                      ->where('semester_id',$semester_id)
                      ->where('score IS NOT ','NULL',FALSE)
                      ->order_by('subjects.name','ASC')
                      ->order_by('date','DESC')
                      ->order_by('gradebook_sets.set_id','DESC')
                      ->get('gradebook_sets')
                      ->result_array();
      }
  }
?>