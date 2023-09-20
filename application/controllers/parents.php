<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property parents_actions       $parents_actions
    */
  
    class Parents extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('admin_actions');
            $this->admin_actions->is_loged_in(__CLASS__,'students');
        }
        
        function index()
        {
           $this->load->view('parents/index'); 
        }
        
        function data()
        {
            $this->load->model('parents_actions');
            $parents=$this->parents_actions->get_parents();
           
            echo json_encode(array(
                    "sEcho" => intval($this->input->get('sEcho')),
                    "iTotalRecords" => $parents['count'],
                    "iTotalDisplayRecords" =>$parents['rows'],
                    "aaData" =>$parents['data']
               ));
        }
        
        function new_parent()
        {
            $this->load->view('parents/new_parent');
        }
        
        function save_parent()
        {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                        array('field'=>'parent_id','rules'=>'required|is_numeric','label'=>$this->lang->line('parent_id')),
                        array('field'=>'parent_name','rules'=>'required','label'=>$this->lang->line('parent_name')),
                        array('field'=>'email','rules'=>'required|valid_email','label'=>$this->lang->line('email'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit(json_encode(array('error_message'=>$this->form_validation->error_string())));
          }
          
          if (($this->input->post('birth_date')) AND (!strtotime($this->input->post('birth_date'))) )
          {
              exit(json_encode(array('error_message'=>$this->lang->line('error_wrong_date'))));
          }
          
          $this->load->model('parents_actions');
          
          if (!$this->parents_actions->check_user_email($this->input->post('email'),$this->input->post('parent_id'),'parent'))
          {
              exit (json_encode(array('error_message'=>$this->lang->line('error_email_used'))));
          }
          
          $save_result=$this->parents_actions->save_parent();
          if (!$save_result)
          {
              exit(json_encode(array('error_message'=>$this->parents_actions->get_error())));
          }
          
          echo json_encode($save_result);
        }
        
        function edit($parent_id=0)
        {
            $this->load->model('parents_actions');
            $this->load->view('parents/edit_parent',array('parent'=>$this->parents_actions->get_parent($parent_id)));
        }
		
		function view($parent_id =0)
		{
            $this->load->model('parents_actions');
            $this->load->view('parents/view',array('parent'=>$this->parents_actions->get_parent($parent_id)));			
		}
      
        function resend_invitation($parent_id=0)
        {
            $this->load->model('parents_actions');
            $this->parents_actions->resend_invitation($parent_id,'parent');
            $this->load->view('layout/success',array('message'=>$this->lang->line('invitation_sent')));
        }
      
        function change_status($new_status='',$parent_id=0)
        {
            $this->load->model('parents_actions');
            $result=$this->parents_actions->change_status($new_status,$parent_id);
            if (!$result)
            {
                exit (json_encode(array('error_message'=>$this->parents_actions->get_error())));
            }
            echo json_encode(array('message'=>$this->lang->line('done')));
        }
        
        function find_parent()
        {
            $this->load->model('parents_actions');
            echo json_encode($this->parents_actions->get_parents_list());
        }
    }
?>