<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property admin_actions       $admin_actions
    * @property donors_actions       $donors_actions
    * @property settings_actions       $settings_actions
    */
  class Donors extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('admin_actions');
          $this->admin_actions->is_loged_in(__CLASS__,'students');
      }
      
      function index()
      {
          $this->load->view('donors/index'); 
      }
      
      function data()
      {
            $this->load->model('donors_actions');
            $donors=$this->donors_actions->get_donors();
           
            echo json_encode(array(
                    "sEcho" => intval($this->input->get('sEcho')),
                    "iTotalRecords" => $donors['count'],
                    "iTotalDisplayRecords" =>$donors['rows'],
                    "aaData" =>$donors['data']
               ));
      }
      
      function data_report()
      {
            $this->load->model('donors_actions');
            $donors=$this->donors_actions->get_donors_reports();
           
            echo json_encode(array(
                    "sEcho" => intval($this->input->get('sEcho')),
                    "iTotalRecords" => $donors['count'],
                    "iTotalDisplayRecords" =>$donors['rows'],
                    "aaData" =>$donors['data']
               ));
      }	  
	  
	  
      function donor_pdf_report($donor_id)
      {
          $this->load->model('donors_actions');
          $this->load->model('settings_actions');
          $this->load->vars('monies',$this->donors_actions->get_monies_for_reports($donor_id));
          $this->load->vars('currency',$this->settings_actions->get_setting('current_currency'));
          $this->load->vars('students',$this->donors_actions->get_donated_report($donor_id));
              
          
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('donor_donated');
          
                
      }	  
	  
	  
	  function donate_reports($donor_id)
      {
          $this->load->model('payment_actions');
 
          $this->load->model('donors_actions');
         $this->load->model('notification_actions');
          $this->load->model('settings_actions');
		  $this->load->vars('currency',$this->settings_actions->get_setting('current_currency'));
          $this->load->vars('donations',$this->donors_actions->get_donations_report($donor_id));
          
          
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('donor_donations');
        
          
      }
	  
      function new_donor()
      {
          $this->load->view('donors/new_donor');
      }
      
      function save_donor()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                        array('field'=>'donor_id','rules'=>'required|is_numeric','label'=>$this->lang->line('donor_id')),
                        array('field'=>'donor_name','rules'=>'required','label'=>$this->lang->line('donor_name')),
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
          
          $this->load->model('donors_actions');
          
          if (!$this->donors_actions->check_user_email($this->input->post('email'),$this->input->post('donor_id'),'donor'))
          {
              exit (json_encode(array('error_message'=>$this->lang->line('error_email_used'))));
          }
          
          $save_result=$this->donors_actions->save_donor();
          if (!$save_result)
          {
              exit(json_encode(array('error_message'=>$this->donors_actions->get_error())));
          }
          
          echo json_encode($save_result);
      }
         
      function edit($donor_id=0)
      {
          $this->load->model('donors_actions');
          $this->load->view('donors/edit_donor',array('donor'=>$this->donors_actions->get_donor($donor_id)));
      }
 
       function view($donor_id=0)
      {
          $this->load->model('donors_actions');
          $this->load->view('donors/view_donor',array('donor'=>$this->donors_actions->get_donor($donor_id)));
      }
	       
      function resend_invitation($donor_id=0)
      {
          $this->load->model('donors_actions');
          $this->donors_actions->resend_invitation($donor_id,'donor');
          $this->load->view('layout/success',array('message'=>$this->lang->line('invitation_sent')));
      }
      
      function change_status($new_status='',$donor_id=0)
      {
          $this->load->model('donors_actions');
          $result=$this->donors_actions->change_status($new_status,$donor_id);
          if (!$result)
          {
              exit (json_encode(array('error_message'=>$this->donors_actions->get_error())));
          }
          echo json_encode(array('message'=>$this->lang->line('done')));
      }
        
      function find_donor()
      {
          $this->load->model('donors_actions');
          echo json_encode($this->donors_actions->get_donors_list());
      }
      
      function donate($donor_id=0)
      {
          $this->load->model('donors_actions');
          $this->load->model('settings_actions');
          
          $this->load->view('donors/make_donation',array(
            'donor'=>$this->donors_actions->get_donor($donor_id),
            'currency'=>$this->settings_actions->get_setting('current_currency')
          ));
      }
      
      function complete_donation()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'donation','rules'=>'required|is_numeric','label'=>$this->lang->line('donation')),
                array('field'=>'donor_id','rules'=>'required','label'=>'donor_id'),
                array('field'=>'comment','rules'=>'max_length[300]','label'=>$this->lang->line('comment'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('donors_actions');
          $this->donors_actions->make_donation();
          $this->load->view('layout/success',array('message'=>$this->lang->line('donation_made')));
      }
  }
?>
