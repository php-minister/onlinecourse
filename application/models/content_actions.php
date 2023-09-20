<?php
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    */   
  
  class Content_actions extends CI_Model
  {
      protected $error='';
      
      function __construct()
      {
          parent::__construct();
      }
      
      private function set_error($error)
      {
          $this->error=$error;
      }
      
      function get_error()
      {
          return $this->error;
      }
      
      function get_library()
      {
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db
                   ->where('item_autor',$this->session->userdata('person_id'));
          }
          
           return $this->db
                       ->select('library.*,IFNULL(teachers.name,"'.$this->lang->line('admin').'") as teacher_name',FALSE)
                       ->join('teachers','teachers.teacher_id = library.item_autor','LEFT')
                       ->get('library')
                       ->result_array();
      }
      
      function delete_library_item($item_id)
      {
          $this->db->where('item_id',$item_id);
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('item_autor',$this->session->userdata('person_id'));
          }
          
          $location=$this->db
                         ->select('item_location')
                         ->get('library')
                         ->row_array();
          
          if (count($location)==0)
          {
              return FALSE;
          }
          
          $this->db->delete('library',array('item_id'=>$item_id));
          $this->db->delete('library_permissions',array('item_id'=>$item_id));
          
          if (!file_exists(BASEPATH.'../library-data/'.$location['item_location']))
          {
              return FALSE;
          }
          
          unlink(BASEPATH.'../library-data/'.$location['item_location']);
          
          return TRUE;
      }
      
      function upload_library_item()
      {
          $data=array();
          if (isset($_FILES['file_name'])  AND ($_FILES['file_name']['error']==0))
          {
              $this->load->config('schoolboard');
              $this->load->library('upload',array('upload_path'=>BASEPATH.'../library-data/','allowed_types'=>implode('|',$this->config->item('allowed_files')),'max_size'=>str_replace('M','000',$this->config->item('max_file_size')),'encrypt_name'=>TRUE));
              
             if (!$this->upload->do_upload('file_name'))
             {
                 $this->set_error($this->upload->display_errors());
                 return FALSE;
             }
             
             if ($this->input->post('item_id')!='0')
             {
                 $old_file=$this->db
                                ->select('item_location')
                                ->where('item_id',$this->input->post('item_id'))
                                ->get('library')
                                ->row_array();
                 if ((count($old_file)>0) AND (file_exists(BASEPATH.'../library-data/'.$old_file['item_location'])))
                 {
                     @unlink(BASEPATH.'../library-data/'.$old_file['item_location']);
                 }
             }
             
             $data=array(
                'item_type'=>$this->upload->file_type,
                'item_extenstion'=>str_replace('.','',$this->upload->file_ext),
                'item_file'=>$this->upload->orig_name,
                'item_location'=>$this->upload->file_name,
                'uploaded'=>date('Y-m-d H:i:s')
             );
          }
          
          $data['item_description']=$this->input->post('description');
          $data['access_type']=($this->input->post('is_public')=='on')?NULL:$this->input->post('access_type');
          
          
          if ($this->input->post('item_id')=='0')
          {
              $data['item_autor']=(isset($this->session->userdata['admin_id']))?0:$this->session->userdata('person_id');
              $this->db->insert('library',$data);
              $item_id=$this->db->insert_id();
          }
          else
          {
              if (!isset($this->session->userdata['admin_id']))
              {
                  $this->db->where('item_autor',$this->session->userdata('person_id'));
              }
              $this->db->update('library',$data,array('item_id'=>$this->input->post('item_id')));    
              $item_id=$this->input->post('item_id');
          }
          
          $this->db->delete('library_permissions',array('item_id'=>$item_id));
          if ($this->input->post('is_public')=='on')
          {
              $this->db->insert('library_permissions',array('item_id'=>$item_id,'type'=>'all','value'=>'*'));
          }
          elseif ($this->input->post('access_type')=='groups')
          {
              foreach(json_decode($this->input->post('groups_list'),TRUE) as $group_id)
              {
                  $this->db->insert('library_permissions',array('item_id'=>$item_id,'type'=>'group','value'=>$group_id));
              }
          }
          else
          {
              $clean_students=array();
              foreach(json_decode($this->input->post('students_list'),TRUE) as $student_id)
              {
                  $clean_students[]=(int)$student_id;
              }
              
              $this->db->query('INSERT INTO library_permissions(item_id,type,value)
                                SELECT ?,"student",student_id
                                FROM students
                                WHERE student_id IN ('.implode(',',$clean_students).') AND status IN ("Active","Inactive")',array($item_id));
          }
          
          include (BASEPATH.'../'.APPPATH.'/views/'.(isset($this->session->userdata['admin_id'])?'content/item_templates.php':'teacher/file_templates.php'));
          
          if ($this->input->post('item_id')=='0')
          {
              $result=array(
                    'result'=>$item_id,
                    'item_name'=>sprintf($template['item_name'],$data['item_extenstion'],$data['item_file'],$data['item_description']),
                    'uploaded'=>date('d M Y h:i A',strtotime($data['uploaded'])).' '.$this->lang->line('by').' '.$this->lang->line('admin'),
                    'actions'=>sprintf($template['item_actions'],$item_id,$this->lang->line('edit_item'),$item_id,$this->lang->line('delete_item')),
                    'file_name'=>$data['item_file']
              );
          }
          else
          {
              $result=$this->get_library_item($item_id,TRUE,TRUE);
              $result=array(
                'item_name'=>sprintf($template['item_name'],$result['item_extenstion'],$result['item_file'],$result['item_description']),
                'uploaded'=>date('d M Y h:i A',strtotime($result['uploaded'])).' '.$this->lang->line('by').' '.$result['owner']['name'],
                'file_name'=>$result['item_file']
              );
          }
          
          return $result;
      }
      
      function get_library_item($item_id,$is_brief=FALSE,$get_owner=FALSE)
      {
          $this->db->where('item_id',$item_id);
          
          if (!isset($this->session->userdata['admin_id']))
          {
              $this->db->where('item_autor',$this->session->userdata('person_id'));
          }
          
          $result=$this->db
                       ->select('*')
                       ->get('library')
                       ->row_array();
          
          if ((!$is_brief) AND (!is_null($result['access_type'])))
          {
              if ($result['access_type']=='groups')
              {
                  $this->db
                       ->select('value as id,CONCAT(group_name," (",name,")") as name',FALSE)
                       ->join('students_groups','students_groups.group_id = library_permissions.value','LEFT')
                       ->join('grades','grades.grade_id = students_groups.grade_id','LEFT');
              }
              else
              {
                  $this->db
                       ->select('value as id,CONCAT(students.name,"<span class=\'person_details\'> (",IFNULL(grades.name,"-"),", ",ssn,")</span>") as name',FALSE)
                       ->join('students','students.student_id = library_permissions.value','LEFT')
                       ->join('grades','grades.grade_id = students.grade','LEFT');
              }
              
              $result['access']=json_encode($this->db
                                                 ->where('item_id',$item_id)
                                                 ->get('library_permissions')
                                                 ->result_array());
          }
          
          if ($get_owner)
          {
              if ($result['item_autor']==0)
              {
                  $result['owner']['name']=$this->lang->line('admin');
              }
              else
              {
                  $result['owner']=$this->db
                                        ->select('name')
                                        ->where('teacher_id',$result['item_autor'])
                                        ->get('teachers')
                                        ->row_array();    
              }
          }
                               
          return $result;
      }
      
      function get_student_library()
      {
          $group_id=$this->db
                         ->select('group')
                         ->where('student_id',$this->session->userdata('person_id'))
                         ->get('students')
                         ->row_array();
          
          return $this->db
                      ->select('library.item_id,library_permissions.value , item_file,item_extenstion,item_description,uploaded,IFNULL(teachers.name,"'.$this->lang->line('admin').'") as autor_name',FALSE)
                      ->join('library','library.item_id = library_permissions.item_id','LEFT')
                      ->join('teachers','teachers.teacher_id = library.item_autor','LEFT')
                      ->where('(`type`="all" AND value="*") OR (`type`="student" AND value="'.$this->session->userdata('person_id').'") OR (`type`="group" AND value="'.$group_id['group'].'")',NULL,FALSE)
                      ->get('library_permissions')
                      ->result_array();
      }
      
      function download_library_item($item_id)
      {
         $group_id=$this->db
                         ->select('group')
                         ->where('student_id',$this->session->userdata('person_id'))
                         ->get('students')
                         ->row_array();
         
         $item=$this->db
                    ->select('item_file,item_location,item_type')
                    ->join('library','library.item_id = library_permissions.item_id','LEFT')
                    ->where('library_permissions.item_id',$item_id)
                    ->where('((`type`="all" AND value="*") OR (`type`="student" AND value="'.$this->session->userdata('person_id').'") OR (`type`="group" AND value="'.$group_id['group'].'"))',NULL,FALSE)
                    ->get('library_permissions')
                    ->row_array();
         if (count($item)==0)
         {
             show_404();
         }
         
         if (!file_exists(BASEPATH.'../library-data/'.$item['item_location']))
         {
             show_404();
         }
         
         header('Content-Description: File Transfer');
         header('Content-Type: '.$item['item_type']);
         header('Content-Disposition: attachment; filename='.$item['item_file']);
         header('Content-Transfer-Encoding: binary');
         header('Expires: 0');
         header('Cache-Control: must-revalidate');
         header('Pragma: public');
         readfile(BASEPATH.'../library-data/'.$item['item_location']);
      }
  }
?>