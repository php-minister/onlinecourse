<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property email_actions           $email_actions
    * @property settings_actions           $settings_actions
    */
  class Semesters_actions extends CI_Model
  {
      private $error;
      
      private $final_score_method;
      
      private $max_label='';
      
      private $is_current=FALSE;
      
      function __construct()
      {
          parent::__construct();
      }
      
      function get_semesters()
      {
          return $this->db
                      ->select('*')
                      ->get('semesters')
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
      
      function save_semester()
      {
          $start_date=strtotime($this->input->post('start_date'));
          $end_date=strtotime($this->input->post('end_date'));
          
          $semester=$this->get_semester($this->input->post('semester_id'));
          
          if (count($semester)==0)
          {
              if ((!$start_date) OR (!$end_date))
              {
                  $this->set_error($this->lang->line('start_or_end_date_wrong'));
                  return FALSE;
              }    
          }
          else
          {
               if ((!$start_date) OR (strtotime($semester['start_date'])<mktime(0,0,0)))
               {
                   $start_date=strtotime($semester['start_date']);
               }
               
               if ((!$end_date) OR (strtotime($semester['end_date'])<mktime(0,0,0)))
               {
                   $end_date=strtotime($semester['end_date']);
               }
               else
               {
                   if ($this->db
                            ->select('set_id')
                            ->where('semester_id',$this->input->post('semester_id'))
                            ->where('`date`>','"'.date('Y-m-d',$end_date).'"',FALSE)
                            ->get('gradebook_sets')
                            ->num_rows()>0)
                   {
                       $this->set_error($this->lang->line('can_not_change_end_date'));
                       return FALSE;
                   }
               }
          }
          
          if ($start_date>$end_date)
          {
              $this->set_error($this->lang->line('end_date_is_lower'));
              return FALSE;
          }
          
          if ((strtotime($this->input->post('start_date'))) AND ($start_date<mktime(0,0,0)))
          {
             $this->set_error($this->lang->line('start_date_passed'));
             return FALSE; 
          }
          
          if ($end_date<mktime(0,0,0))
          {
              $this->set_error($this->lang->line('end_date_passed'));
              return FALSE;
          }
          
          if ($this->db
                   ->select('semester_id')
                   ->where('semester_id!=',(int)$this->input->post('semester_id'),FALSE)
                   ->where('end_date>=','"'.date('Y-m-d',$start_date).'"',FALSE)
                   ->where('start_date<','"'.date('Y-m-d',$end_date).'"',FALSE)
                   ->get('semesters')
                   ->num_rows()>0)
          {
              $this->set_error($this->lang->line('this_time_is_busy'));
              return FALSE;
          }
          
          $data=array(
                'name'=>$this->input->post('name'),
                'start_date'=>date('Y-m-d',$start_date),
                'end_date'=>date('Y-m-d',$end_date),
                'year_start'=>$this->input->post('year_start'),
                'year_end'=>$this->input->post('year_end')
          );
          
          if ($this->input->post('semester_id')=='0')
          {
              $this->db->insert('semesters',$data);
              $semester_id=$this->db->insert_id();
              $this->mark_as_current($semester_id);
              return $semester_id;
          }
          
          
          $this->db->update('semesters',$data,array('semester_id'=>$this->input->post('semester_id')));
          $this->mark_as_current($this->input->post('semester_id'));
          return TRUE;
      }
      
      function delete_semester($semester_id)
      {
          $this->db
               ->where(array('semester_id'=>(int)$semester_id,'start_date>'=>'CURDATE()'),null,FALSE) 
               ->delete('semesters');
          return ($this->db->affected_rows()>0)?TRUE:FALSE;
      }
      
      function get_semester($semester_id)
      {
          return $this->db
                      ->select('*')  
                      ->where('semester_id',$semester_id)
                      ->get('semesters')
                      ->row_array();
      }
      
      function get_active_semester()
      {
          return $this->db
                      ->select('name,start_date,end_date,semester_id')  
                      ->where('is_active',1)
                      ->get('semesters')
                      ->row_array();
      }
      
      function complete_semester()
      {
          $current_semester=$this->get_active_semester();
          
          $next_semester=$this->db
                              ->select('semester_id')
                              ->where('is_active',0)
                              ->where('is_completed',0)
                              ->where('start_date>=','"'.$current_semester['end_date'].'"',FALSE)
                              ->get('semesters')
                              ->row_array();
          
          if (count($next_semester)==0)
          {
              $this->set_error($this->lang->line('create_next_semester'));
              return FALSE;
          }
          
          $sets=$this->db
                     ->select('GROUP_CONCAT(set_id) as sets_ids,subject_id,grade_id',FALSE)
                     ->where('semester_id',$current_semester['semester_id'])
                     ->group_by('grade_id,subject_id')
                     ->get('gradebook_sets')
                     ->result_array();
          
          $this->load_scale();
          
          foreach($sets as $set)
          {
              $this->db->insert('gradebook_sets',array('grade_id'=>$set['grade_id'],'subject_id'=>$set['subject_id'],'category_id'=>5,'date'=>$current_semester['end_date'],'name'=>'Final grade','semester_id'=>$current_semester['semester_id']));
              $set_id=$this->db->insert_id();
              
              $this->db->query('INSERT INTO gradebook_scores(set_id,student_id,score,label)
                                SELECT ?,student_id,score,IFNULL(label,?)
                                    FROM (
                                        SELECT student_id,'.(($this->final_score_method=='avg')?'AVG(score)':'SUM(score)').' as score
                                        FROM gradebook_scores
                                        WHERE set_id IN ('.$set['sets_ids'].')
                                        GROUP BY student_id
                                    ) AS T
                                LEFT JOIN scale ON T.score BETWEEN scale.min AND scale.max',array($set_id,$this->max_label));
          }
          
          
          $this->db->update('semesters',array('is_active'=>1),array('semester_id'=>$next_semester['semester_id']));
          
          $this->db->update('semesters',array('is_active'=>0,'is_completed'=>1),array('semester_id'=>$current_semester['semester_id']));
          
          if ($this->input->post('to_next_grade')=='on')
          {
              $last_grade=$this->db
                               ->select('grade_id')
                               ->where('is_active',1)
                               ->limit(1)
                               ->order_by('order','DESC')
                               ->get('grades')
                               ->row_array();
              
              $this->db->update('students',array('grade'=>NULL,'group'=>NULL,'old_group'=>NULL,'status'=>'Graduated'),array('grade'=>$last_grade['grade_id']));
              
              
              $this->db->query('INSERT INTO students (student_id,old_group)
                                SELECT student_id,group_name
                                FROM students
                                LEFT JOIN students_groups ON students_groups.group_id = students.group
                                WHERE `status` IN ("Active","Inactive")
                                ON DUPLICATE KEY UPDATE old_group=group_name');
              
              $this->db->query('UPDATE students SET grade=grade+1,`group`=0 WHERE status IN ("Active","Inactive")');
          }
          
          return TRUE;
      }
      
      private function load_scale()
      {
          $this->load->model('settings_actions');
          $scale=$this->settings_actions->get_settings('scale');
          $scale=unserialize($scale['scale']);
          $this->db->query('DROP TEMPORARY TABLE IF EXISTS scale');
          $this->db->query('CREATE TEMPORARY TABLE IF NOT EXISTS scale(min int,max int,label varchar(30))');
          $scale_data=array();
          foreach($scale as $min=>$data)
          {
              $scale_data[]=array('min'=>$min,'max'=>$data['max'],'label'=>$data['label']);
          }
          
          if (count($scale_data)>0)
          {
              $this->db->insert_batch('scale',$scale_data);    
              $this->max_label=$data['label'];
          }

          $score_method=$this->settings_actions->get_settings('global');
          $this->final_score_method=$score_method['final_score_method'];
      }
      
      private function mark_as_current($semester_id)
      {
          if ($semester_id==1)
          {
              $this->db->update('semesters',array('is_active'=>1),array('semester_id'=>$semester_id));
              $this->is_current=TRUE;
          }
          elseif ($this->db
                       ->select('semester_id')
                       ->where('is_active',1)
                       ->where('end_date<','"'.date('Y-m-d',strtotime($this->input->post('start_date'))).'"',FALSE)
                       ->get('semesters')
                       ->num_rows()==0)
          {
            $this->db->update('semesters',array('is_active'=>0));
            $this->db->update('semesters',array('is_active'=>1),array('semester_id'=>$semester_id));
            $this->is_current=TRUE;
          }
      }
      
      function is_current()
      {
          return $this->is_current;
      }
  } 
?>