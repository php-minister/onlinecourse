<?php
   /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    */ 
  class Settings_actions extends CI_Model
  {
      private $error;
      
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
      
      private function load_settings($setting_group)
      {
          return   $this->db
                        ->select('setting_key,setting_value')  
                        ->where('setting_group',$setting_group)
                        ->get('settings')
                        ->result_array();
      }
      
      function get_settings($setting_group)
      {
           foreach($this->load_settings($setting_group) as $setting)
           {
               $new_settings[$setting['setting_key']]=$setting['setting_value'];
           }
           
           return $new_settings;
      }
      
      function get_setting($setting_key)
      {
          $result=$this->db
                       ->select('setting_value')  
                       ->where('setting_key',$setting_key)
                       ->get('settings')
                       ->row_array();
          return $result['setting_value'];
      }
      
      function save_settings($setting_group)
      {
          foreach($this->load_settings($setting_group) as $setting)
          {
              if (in_array($setting,array('payment_settings','active_payments')))
              {
                  $this->db->update('settings',array('setting_value'=>$this->input->post($setting['setting_key'])),array('setting_key'=>$setting['setting_key']));    
              }
              
          }
          
          $active_payments=$payment_settings=array();
          foreach($this->input->post('methods') as $method_name=>$details)
          {
              if (!isset($details['is_active']))
              {
                  continue;
              }
              
              if ($details['is_active']=='on')
              {
                  $active_payments[]=$method_name;
              }
              
              unset($details['is_active']);
              $payment_settings[$method_name]=$details;
          }
          
          $this->db->update('settings',array('setting_value'=>serialize($payment_settings)),array('setting_key'=>'payment_settings'));
          
          $this->db->update('settings',array('setting_value'=>implode(',',$active_payments)),array('setting_key'=>'active_payments'));
          
          return TRUE;
      }
      
      function get_email_templates()
      {
          return $this->db
                      ->select('template_name,template_id')
                      ->get('email_templates')
                      ->result_array();
      }
      
      function get_email_template($template_id)
      {
          return $this->db
                      ->select('template_name,template_id,template_content,template_fields')
                      ->where('template_id',$template_id)
                      ->get('email_templates')
                      ->row_array();
      }
      
      function update_email_template()
      {
          $this->db->update('email_templates',array('template_content'=>trim($this->input->post('template_content'))),array('template_id'=>$this->input->post('template_id')));
      }
      
      function get_school_info()
      {
          return $this->db
                      ->select('*')
                      ->get('school_info')
                      ->row_array();
      }
      
      function save_school_info()
      {
          $this->db->update('school_info',array(
                        'name'=>$this->input->post('name'),
                        'address'=>$this->input->post('address'),
                        'city'=>$this->input->post('city'),
                        'state'=>$this->input->post('state'),
                        'zip'=>$this->input->post('zip_code'),
                        'phone'=>$this->input->post('phone'),
                        'email'=>$this->input->post('email'),
                        'principal'=>$this->input->post('principal')
          ));
      }
      
      function save_scale()
      {
          $scales=array();
          if (isset($_POST['min_value']))
          {
              $labels=$this->input->post('label');
              foreach($_POST['min_value'] as $index=>$min_value)
              {
                  $min_value=number_format((float)$min_value,2);
                  if (isset($scales[(string)$min_value]))
                  {
                      $this->set_error(sprintf($this->lang->line('found_duplicate'),$labels[$index]));
                      return FALSE;
                  }
                  
                  if ((is_numeric($_POST['max_value'][$index])) AND ((float)$_POST['max_value'][$index]<=$min_value))
                  {
                      $this->set_error(sprintf($this->lang->line('min_value_can_not_be_greater',$labels[$index])));
                      return FALSE;
                  }
                  $scales[(string)$min_value]=array('max'=>is_numeric($_POST['max_value'][$index])?number_format((float)$_POST['max_value'][$index],2):'','label'=>$labels[$index]);
              }
              
              ksort($scales);
          }
          
          $previous_scale=array();
          foreach($scales as $min=>$data)
          {
              if ((isset($previous_scale['max'])) AND (is_numeric($previous_scale['max'])) AND (($previous_scale['max']+1)!=$min))
              {
                  
                  $this->set_error(
                    (($previous_scale['max']+1)>$min)?
                    sprintf($this->lang->line('min_value_in_grade_must_be_greater'),$data['label'],$previous_scale['label']):
                    sprintf($this->lang->line('missed_points'),($min-$previous_scale['max']-1),$previous_scale['label'])
                  );
                  
                  return FALSE;
              }
              $previous_scale=$data;
          }
          
          $this->db->update('settings',array('setting_value'=>serialize($scales)),array('setting_key'=>'scale'));
          
          return TRUE;
      }
      
      function get_all_grades()
      {
          return $this->db
                      ->select('grade_id,name,is_active')
                      ->order_by('order')
                      ->get('grades')
                      ->result_array();
      }
      
      function get_first_grade()
      {
          return $this->db
                      ->select('grades.grade_id,group_id,name,group_name')
                      ->join('students_groups','students_groups.grade_id = grades.grade_id AND is_deleted=0','LEFT')
                      ->where('is_active',1)
                      ->order_by('order')
                      ->limit(1)
                      ->get('grades')
                      ->row_array();
      }
      
      function save_grades()
      {
          $used_grades=$this->db
                        ->select('grade')
                        ->group_by('grade')
                        ->where_in('status',array('Active','Inactive'))
                        ->where('grade IS NOT ',' NULL ',FALSE)
                        ->get('students')
                        ->result_array();
          
          $grades=$this->input->post('grade');
          
          foreach($used_grades as $grade)
          {
              if (!isset($grades[$grade['grade']]))
              {
                  $missed_grade=$this->db
                                     ->select('name') 
                                     ->where('grade_id',$grade['grade'])
                                     ->get('grades')
                                     ->row_array();
                  $this->set_error(sprintf($this->lang->line('missed_grade'),$missed_grade['name']));
                  return FALSE;
              }
          }
          
          $this->db->update('grades',array('order'=>-1));
          $index=0;
          foreach($grades as $grade_id=>$grade_name)
          {
              $this->db->query('INSERT INTO grades(grade_id,name,is_active,`order`) 
                                VALUES(?,?,1,?)
                                ON DUPLICATE KEY UPDATE `order`=?,name=?',array($grade_id,$grade_name,$index,$index,$grade_name));
              $index++;
          }
          
          $this->db->delete('grades',array('order'=>-1));
          
          return TRUE;
      }
      
      function get_languages()
      {
           $languages=array();
           if ($langue_folder=opendir(BASEPATH.'../'.APPPATH.'language'))
           {
               while (FALSE!==($language=readdir($langue_folder))) 
               {
                   if (($language=='.') OR ($language=='..'))
                   {
                       continue;
                   }
                   $languages[]=$language;
               }
           }
           
           return $languages;
      }
  }
?>