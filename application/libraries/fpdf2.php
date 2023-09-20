<?php
  include(BASEPATH.'../'.APPPATH.'libraries/fpdf.php');
  
  class Fpdf2 extends Fpdf
  {
      public $school_info;
      
      function Header()
      {
/*          $this->SetFontSize(20);
		  $this->Image('http://www.alqurannow.com/images/logo.gif',78,5,70,0,'GIF');*/
         // $this->Write(4,$this->school_info['name']);
      }
      
      function Footer()
      {
          $this->SetFont('Helvetica','',13);
          $this->SetY(-10);
          $this->Write(7,$this->school_info['address'].', '.$this->school_info['city'].', '.$this->school_info['state'].' '.$this->school_info['zip'].'  Tel: '.$this->school_info['phone'].'  Email: '.$this->school_info['email']);
          //$this->SetFont('Helvetica','',12);
          //$this->SetY(-20);
          //$this->Cell(0,10,$this->options[4]['option_value'],0,0,'C');
      }
  }
?>