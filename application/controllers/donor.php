<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property user_actions          $user_actions
    * @property donors_actions          $donors_actions
    * @property settings_actions          $settings_actions
    * @property pdf_actions          $pdf_actions
    * @property payment_actions          $payment_actions
    */ 

  class Donor extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('user_actions');
          $this->user_actions->is_loged_in('donor');
          $this->load->model('school_model');
      }
      
      function index()
      {
          $this->load->model('donors_actions');
          $this->load->model('notification_actions');
          $this->load->model('settings_actions');
          $this->load->vars('monies',$this->donors_actions->get_monies());
          $this->load->vars('currency',$this->settings_actions->get_setting('current_currency'));
          $this->load->vars('students',$this->donors_actions->get_donated());
              
          if ($this->input->get('pdf')==='')
          {
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('donor_donated');
          }
          
          $this->load->view('donor/index',array(
            'notifications'=>$this->notification_actions->get_new_notifications(),
            'messages'=>$this->notification_actions->get_new_messages()
          ));
      }
	  
      function download()
      {
          $this->load->model('donors_actions');
          $this->load->model('notification_actions');
          $this->load->model('settings_actions');
          $this->load->vars('monies',$this->donors_actions->get_monies());
          $this->load->vars('currency',$this->settings_actions->get_setting('current_currency'));
          $this->load->vars('students',$this->donors_actions->get_donated());
              
          if ($this->input->get('pdf')==='')
          {
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('donor_donated');
          }
		  
          
          $this->load->view('donor/downloads',array(
            'notifications'=>$this->notification_actions->get_new_notifications(),
            'messages'=>$this->notification_actions->get_new_messages()
          ));
      }	  
	  
      
	  function getdated($start , $end)
	  {
          $this->load->model('donors_actions');
          $this->load->model('notification_actions');
          $this->load->model('settings_actions');
          $this->load->vars('monies',$this->donors_actions->get_monies());
          $this->load->vars('currency',$this->settings_actions->get_setting('current_currency'));
          $this->load->vars('students',$this->donors_actions->get_donated_date($start , $end));
              
          if ($this->input->get('pdf')==='')
          {
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('donor_donated');
          }
          
          $this->load->view('donor/index',array(
            'notifications'=>$this->notification_actions->get_new_notifications(),
            'messages'=>$this->notification_actions->get_new_messages(),
			'start' => $start,
			'end' => $end
          ));		  
	  }
	  
      function donate($payment_method='')
      {
          $this->load->model('payment_actions');
          if ($payment_method!='')
          {
              $this->payment_actions->checkout($payment_method);
          }
          
          $this->load->model('donors_actions');
		  if(isset($_POST['amount']))
		  {
			  $amount_pay = $_POST['amount'];
		  }
		  else
		  {
			  $amount_pay = ' ';
		  }
          $this->load->model('notification_actions');
          $this->load->model('settings_actions');
          $this->load->vars('amount_pay', $amount_pay);
		  $this->load->vars('currency',$this->settings_actions->get_setting('current_currency'));
          $this->load->vars('donations',$this->donors_actions->get_donations());
          
          if ($this->input->get('pdf')==='')
          {
              $this->load->model('pdf_actions');
              $this->pdf_actions->get_pdf('donor_donations');
          }
          
          $this->load->view('donor/donations',array(
            'notifications'=>$this->notification_actions->get_new_notifications(),
            'messages'=>$this->notification_actions->get_new_messages(),
            'active_payments'=>$this->settings_actions->get_setting('active_payments')
          ));
      }
      
      function make_donation()
      {
          $this->load->library('form_validation');
          $this->form_validation->set_rules(array(
                array('field'=>'amount','rules'=>'required|is_numeric','label'=>$this->lang->line('amount')),
                array('field'=>'payment_method','rules'=>'required','label'=>$this->lang->line('payment_method'))
          ));
          
          if ($this->form_validation->run()==FALSE)
          {
              exit($this->load->view('layout/error',array('message'=>$this->form_validation->error_string()),TRUE));
          }
          
          $this->load->model('payment_actions');
          $redirect_url=$this->payment_actions->prepare_donation();
          if (!$redirect_url)
          {
              exit ($this->load->view('layout/error',array('message'=>$this->payment_actions->get_error()),TRUE));
          }
           
          $this->load->view('layout/success',array('message'=>$this->lang->line('redirecting_to_payment_system')));
          $this->load->view('layout/redirect',array('url'=>$redirect_url));
      }
  }
?>