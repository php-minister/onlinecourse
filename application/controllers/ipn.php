<?php
    
  class Ipn extends CI_Controller
  {
      function __construct()
      {
          parent::__construct();
      }
      
      function proccess($payment_method='')
      {
           $this->load->model('payment_actions');
           $this->payment_actions->change_status($payment_method);
      }
  }
?>