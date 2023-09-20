<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions     $admin_actions
    * @property settings_actions     $settings_actions
    * @property email_actions     $email_actions
    * @property teachers_actions     $teachers_actions
    */
    
  class Settings extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__);
      }
      
      function email()
      {
          $this->load->model('settings_actions');
          $this->load->view('settings/email',array('settings'=>$this->settings_actions->get_settings('email')));
      }
      
      private function prepare_validation()
      {
         $this->load->library('form_validation');
         $this->form_validation->set_rules(array(
                            array('field'=>'email_method','rules'=>'required','label'=>$this->lang->line('how_to_send_emails')),
                            array('field'=>'from_email','rules'=>'valid_email','label'=>$this->lang->line('send_messages_from_email'))
         ));
         
         if ($this->input->post('email_method')=='smtp')
         {
             $this->form_validation->set_rules(array(
                                            array('field'=>'smtp_server','rules'=>'required','label'=>$this->lang->line('smtp_server')),
                                            array('field'=>'smtp_password','rules'=>'required','label'=>$this->lang->line('smtp_password')),
                                            array('field'=>'smtp_user_name','rules'=>'required','label'=>$this->lang->line('smtp_user'))
             ));
         }
      }
      
      function save_email_settings()
      {
         $this->prepare_validation();
         
         if ($this->form_validation->run()==FALSE)
         {
             exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
         }
          
         $this->load->model('settings_actions');
         if (!$this->settings_actions->save_settings('email'))
         {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('not_saved'))));
         }
         
         $this->load->view('layout/success',array('message'=>$this->lang->line('saved')));
      }
      
      function test_email()
      {
          $this->prepare_validation();
          $this->form_validation->set_rules(array(
                                array('field'=>'test_email','rules'=>'required|valid_email','label'=>$this->lang->line('test_email'))
          ));
          
         if ($this->form_validation->run()==FALSE)
         {
             exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
         }
         
         $this->load->model('email_actions');
         if (!$this->email_actions->send_test_message())
         {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('test_email_not_sent').$this->email_actions->error),TRUE));
         }
         
         $this->load->view('layout/success',array('message'=>$this->lang->line('test_email_sent')));
      }
      
      function email_templates()
      {
          $this->load->model('settings_actions');
          $this->load->view('settings/email_templates',array('templates'=>$this->settings_actions->get_email_templates()));
      }
      
      function edit_email_template($template_id=0)
      {
          $this->load->model('settings_actions');
          $this->load->view('settings/edit_template',array('template'=>$this->settings_actions->get_email_template($template_id)));
      }
      
      function save_email_template()
      {
          $this->load->library('form_validation');
          
          $this->form_validation->set_rules(array(
                                array('field'=>'template_id','rules'=>'required','label'=>$this->lang->line('template_id')),
                                array('field'=>'template_content','rules'=>'required|min_length[6]','label'=>$this->lang->line('template'))
          ));
          
          if ($this->form_validation->run()===FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('settings_actions');
          $this->settings_actions->update_email_template();
          $this->load->view('layout/success',array('message'=>$this->lang->line('updated')));
      }
      
      function school_info()
      {
          $this->load->model('settings_actions');
          $this->load->model('teachers_actions');
          $this->load->view('settings/school_info',array(
                                                    'school'=>$this->settings_actions->get_school_info(),
                                                    'teachers'=>$this->teachers_actions->get_teachers_list()
          ));
      }
      
      function save_school_info()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                        array('field'=>'name','rules'=>'required','label'=>$this->lang->line('school_name')),
                        array('field'=>'principal','rules'=>'required|is_numeric','label'=>$this->lang->line('principal')),
                        array('field'=>'email','rules'=>'required|valid_email','label'=>$this->lang->line('email')),
                        array('field'=>'phone','rules'=>'required','label'=>$this->lang->line('phone'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit ($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('settings_actions');
          $this->settings_actions->save_school_info();
          $this->load->view('layout/success',array('message'=>$this->lang->line('updated')));
      }
      
      function global_settings()
      {
          $this->load->config('schoolboard');
          $this->load->model('settings_actions');
          $this->load->view('settings/global_settings',array(
                    'settings'=>$this->settings_actions->get_settings('global'),
                    'languages'=>$this->settings_actions->get_languages(),
                    'payment_methods'=>$this->config->item('payment_methods')
          ));
      }
      
      function save_global_settings()
      {
         $this->load->model('settings_actions');
         if (!$this->settings_actions->save_settings('global'))
         {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('settings_not_saved')),TRUE));
         }
         
         $this->load->view('layout/success',array('message'=>$this->lang->line('saved')));
      }
      
      function scale()
      {
          $this->load->model('settings_actions');
          $scale=$this->settings_actions->get_settings('scale');
          $this->load->view('settings/scale',array('scale'=>unserialize($scale['scale'])));
      }
      
      function save_scale()
      {
          if (isset($_POST['min_value']))
          {
              $this->load->library('form_validation');
              foreach($_POST['min_value'] as $index=>$min_value)
              {
                  $this->form_validation->set_rules(array(
                            array('field'=>'min_value['.$index.']','rules'=>'requried|is_numeric|less_than[999]'),
                            array('field'=>'label['.$index.']','rules'=>'max_length[20]')
                  ));
              }
              
              if ($this->form_validation->run()==FALSE)
              {
                  exit ($this->load->view('layout/error',array('message'=>$this->lang->line('check_scales_values')),TRUE));
              }
          }
          
          $this->load->model('settings_actions');
          $result=$this->settings_actions->save_scale();
          if (!$result)
          {
              exit ($this->load->view('layout/error',array('message'=>$result),TRUE));
          }
          
          $this->load->view('layout/success',array('message'=>$this->lang->line('updated')));
      }
      
      function grades()
      {
          $this->load->model('settings_actions');
          $this->load->view('settings/grades',array('grades'=>$this->settings_actions->get_all_grades()));
      }
      
      function save_grades()
      {
         $this->load->model('settings_actions');
         
         if ((!isset($_POST['grade'])) OR (count($_POST['grade'])==0))
         {
             exit($this->load->view('layout/error',array('message'=>$this->lang->line('one_grade_must_be_selected')),TRUE));
         }
         
         $result=$this->settings_actions->save_grades();
         if (!$result)
         {
             exit($this->load->view('layout/error',array('message'=>$this->settings_actions->get_error()),TRUE));
         }
         
         $this->load->view('layout/success',array('message'=>$this->lang->line('updated')));
      }
  }
?>