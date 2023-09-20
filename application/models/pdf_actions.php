<?php
    /**
    * @property CI_Loader           $load
    * @property CI_Form_validation  $form_validation
    * @property CI_Input            $input
    * @property CI_DB_active_record $db
    * @property CI_Session          $session
    * @property CI_Upload           $upload
    * @property fpdf2           $fpdf2
    * @property fpdf           $fpdf
    * @property students_actions           $students_actions
    * @property semesters_actions           $semesters_actions
    */
  
  class Pdf_actions extends CI_Model
  {
      function __construct()
      {
          parent::__construct();
          $this->load->model('settings_actions');
          $this->load->library('fpdf2');
          $this->fpdf2->school_info=$this->settings_actions->get_school_info();
          $this->fpdf2->AddPage();
      }
      
      function get_pdf($pdf_name)
      {
          call_user_func(array('Pdf_actions',$pdf_name));
          $this->fpdf2->Output();
          exit();
      }
      
      private function parent_gradebook()
      {
          $this->load->model('students_actions');
          $student=$this->students_actions->get_student($this->load->get_var('student_id'),TRUE);
          $this->fpdf2->SetFontSize(20);

		   $this->fpdf2->Cell( 0, 9, $this->fpdf2->Image('http://www.alqurannow.com/beta/img/logo.jpg',10,7,70,0,'JPG'), 0, 1, 'C' );  	
		   
		   $this->fpdf2->Ln(8);
          
		  $this->fpdf2->SetFont('Helvetica','',17);
          $this->fpdf2->Write(10,$this->lang->line('gradebook').$this->lang->line('for').$student['name']);
          unset($student);
          $this->fpdf2->Ln();
          
          $this->load->model('semesters_actions');
          $semester=$this->semesters_actions->get_semester($this->load->get_var('semester_id'));
          $semester_name=($semester['name'])?($semester['name']):'';
          $semester_name.=($semester['name']?' (':'');
          $semester_name.=(date('d M Y',strtotime($semester['start_date'])).' - '.date('d M Y',strtotime($semester['end_date'])));
          $semester_name.=($semester['name']?')':'');
          
          $this->fpdf2->SetFont('Helvetica','',14);
          $this->fpdf2->Write(10,$this->lang->line('selected_semester').': '.$semester_name);
          $this->fpdf2->Ln(8);
           
          $current_subject=0;
          foreach($this->load->get_var('gradebook') as $index=>$item){
                if ($current_subject!=$item['subject_id'])
                {
                    if ($current_subject>0)
                    {
                        $this->fpdf2->Ln(0);
                    }
                    
                    $this->fpdf2->SetFont('Helvetica','B',14);
                    $this->fpdf2->Write(20,$item['subject_name']);
                    $this->fpdf2->SetFont('Helvetica','',14);
                    $this->fpdf2->Ln();
                    $current_subject=$item['subject_id'];
                }
                
                $this->fpdf2->Write(0,'      '.$item['name'].$this->lang->line('at').date('d M Y',strtotime($item['date'])).': '.(($item['score']==(int)$item['score'])?(int)$item['score']:$item['score'].' '.$item['label']));
                $this->fpdf2->Ln(10);
          }
      }
      
      function parent_scheduling()
      {
          $this->load->model('students_actions');
          $student=$this->students_actions->get_student($this->load->get_var('student_id'),TRUE);
          $scheduling=json_decode($this->load->get_var('scheduling'),TRUE);
          if (count($scheduling)==0)
          {
              return ;
          }
          $right_date=explode('-',$scheduling[0]['date']);
          
			$name = $student['name'];
		 	$monthNum = $right_date[0];
			$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));

          
		  
          //$this->fpdf2->SetFont('Helvetica','',17);
          //$this->fpdf2->Write(10,$this->lang->line('scheduling').$this->lang->line('for').$student['name'].$this->lang->line('for').date('M Y',strtotime($right_date[2].'-'.$right_date[0].'-'.$right_date[1].' '.$scheduling[0]['start_time'])));
          unset($student);
          $this->fpdf2->Ln();
          
		  $this->fpdf2->SetFont('Helvetica','',14);
		  $this->fpdf2->Cell( 0, 9, $this->fpdf2->Image('http://www.alqurannow.com/beta/img/logo.jpg',10,7,70,0,'JPG'), 0, 1 , 'C' , false);  	
		   
		   $this->fpdf2->Ln(8);	      
		   $this->fpdf2->SetFont('Helvetica','',17);
		   $this->fpdf2->Cell(180,10, 'Monthly Schedule for '.$monthName.' '.$right_date[1] ,0,0,'C');
			//Line break		  
			$this->fpdf2->Ln(10);		  
			$this->fpdf2->Cell(180,10, $name ,0,0,'C');
			$this->fpdf2->Ln(15);		  
				$this->fpdf2->SetFont('Helvetica','',13);
				
			  $this->fpdf2->Cell(15, 8, '#', 1);
			  $this->fpdf2->Cell(45, 8, 'Class', 1);
			  $this->fpdf2->Cell(45, 8, 'Teacher', 1);
			  $this->fpdf2->Cell(25, 8, 'Date', 1);
			  $this->fpdf2->Cell(30, 8, 'Start Time', 1);
			  $this->fpdf2->Cell(30, 8, 'End Time', 1);
			  $this->fpdf2->Ln();
		  		  
          $this->fpdf2->SetFont('Helvetica','',12);
		  $i=0;
          foreach($scheduling as $schedule)
          {
			  $i++;
      	  $this->fpdf2->SetFont('Helvetica','',10);
    		  
			  $class_name_pos = strpos($schedule['title'] , '{');
			  $class_name = substr($schedule['title'] , 0 , $class_name_pos);
		  	
				//$teacher_name = substr();		
				
				$start = 'by';
				$end = 'in';

			  $string = " ".$schedule['title'];
				$ini = strpos($string,$start);
				if ($ini == 0) return "";
				$ini += strlen($start);
				$len = strpos($string,$end,$ini) - $ini;
				$teacher_name = substr($string,$ini,$len);				
				$date_array = explode("-" , $schedule['date']);
				$date = $date_array[2]."-".$date_array[0]."-".$date_array[1];
				
				
			  $month_schedule = date('m' , strtotime($date));
			  $year_schedule = date('Y' , strtotime($date));
			  
				  $this->fpdf2->Cell(15, 8, $i, 1);
				  $this->fpdf2->Cell(45, 8, $class_name, 1);
				  $this->fpdf2->Cell(45, 8, $teacher_name, 1);
				  $this->fpdf2->Cell(25, 8, $schedule['date'], 1);
				  $this->fpdf2->Cell(30, 8, $schedule['start_time'], 1);
				  $this->fpdf2->Cell(30, 8, $schedule['end_time'], 1);
				  $this->fpdf2->Ln();
			  
          }
      }
      
      function parent_attendance()
      {
          $this->load->model('students_actions');
          $student=$this->students_actions->get_student($this->load->get_var('student_id'),TRUE);
          
          $attendance=json_decode($this->load->get_var('attendance'),TRUE);
            
          if (count($attendance)==0)
          {
              return ;
          }
          $right_date=explode('-',$attendance[0]['date']);
    
			$name = $student['name'];
		 	$monthNum = $right_date[0];
			$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));		  
			unset($student);
          
		  $this->fpdf2->SetFont('Helvetica','',14);
		  $this->fpdf2->Cell( 0, 9, $this->fpdf2->Image('http://www.alqurannow.com/beta/img/logo.jpg',10,7,70,0,'JPG'), 0, 1 , 'C' , false);  	
		   
		   $this->fpdf2->Ln(8);	      
		   $this->fpdf2->SetFont('Helvetica','',17);
		   $this->fpdf2->Cell(180,10, 'Monthly Attendance for '.$monthName.' '. date('Y') ,0,0,'C');
		   $this->fpdf2->Ln(10);		  		   
		   $this->fpdf2->Cell(180,10, $name ,0,0,'C');
			//Line break
			  $this->fpdf2->Ln(15);		  
			  $this->fpdf2->SetFont('Helvetica','',14);
		      $this->fpdf2->Cell(50, 9 , 'Class' , 1);
		      $this->fpdf2->Cell(30, 9 , 'Date' , 1);
			  $this->fpdf2->Cell(30, 9 , 'Start Time' , 1);
			  $this->fpdf2->Cell(30, 9 , 'End Time' , 1);
			  $this->fpdf2->Cell(50, 9 , 'Status' , 1);
              $this->fpdf2->Ln();
			  			  		  
          $this->fpdf2->SetFont('Helvetica','',12);
          foreach($attendance as $item)
          {
              $right_date=explode('-',$item['date']);
              $right_date=$right_date[2].'-'.$right_date[0].'-'.$right_date[1];
          	  
			  $class_data = explode('during',$attendance[0]['title']);

		      $this->fpdf2->Cell(50, 9 , $class_data[1] , 1);
		      $this->fpdf2->Cell(30, 9 , date('dS D',strtotime($right_date)) , 1);
			  $this->fpdf2->Cell(30, 9 , date('h:i A',strtotime($right_date.$item['start_time'])) , 1);
			  $this->fpdf2->Cell(30, 9 , date('h:i A',strtotime($right_date.$item['end_time'])) , 1);
			  $this->fpdf2->Cell(50, 9 , $class_data[0] , 1);
			  $this->fpdf2->Ln();
          }
      }
	  
	  	function teacher_schedule()
		{
			$scheduling = json_decode($this->load->get_var('scheduling'));
			$teacher_data = $this->load->get_var('teacher_data');
			$teacher_name = $teacher_data['name'];
		  	
			//Header Logo
		  $this->fpdf2->SetFontSize(20);
		  $this->fpdf2->Cell( 0, 9, $this->fpdf2->Image('http://www.alqurannow.com/beta/img/logo.jpg',10,7,70,0,'JPG'), 0, 1, 'C' );  	
		  $this->fpdf2->Ln(8);
		  
			$this->fpdf2->Cell(80,10, 'Monthly Schedule  ('.date('M').' '. date('Y').')' ,0,0,'C');
			
			$this->fpdf2->Ln(8);		  
		  

		  $this->fpdf2->SetFont('Helvetica','',17);
		  $this->fpdf2->Cell(173 , 10, $teacher_name ,0,0,'C');
		  $this->fpdf2->Ln(20);
			
			$i=0;
			$same_date = 0;
		  	foreach($scheduling as $schedule)
			{
				
          	  $this->fpdf2->SetFont('Helvetica','',10);
          	  $i++;
			  
			  
			  
			  $class_name_pos = strpos($schedule->title , '{');
			  $class_name = substr($schedule->title , 0 , $class_name_pos);
			  
			 $first_pos = strpos($schedule->title, ',');
			 $substr = substr($schedule->title , $first_pos+1);
			 $pos = strpos($substr, ',');
			 $start_position = $pos + $first_pos+1;
			 $end_pos = strpos($schedule->title , 'in' );
			 
			 $num_of_chars = $end_pos - $start_position-1;
			 $students = substr($substr , $pos+1 , $num_of_chars);

		
				$date_array = explode("-" , $schedule->date);
				$date = $date_array[2]."-".$date_array[0]."-".$date_array[1];
				
				$tempDate = $date;
				$day_of_week=  date('l', strtotime( $tempDate));
				$month_name=  date('F', strtotime( $tempDate));				
				
			  $month_schedule = date('m' , strtotime($date));
			  $year_schedule = date('Y' , strtotime($date));
			  
			  $current_month = date('m');
			  $current_year = date('Y');
			  
			  if($current_month == $month_schedule && $current_year == $year_schedule)
			  {

					if($same_date == $date_array[1])
					{
						  $this->fpdf2->SetFont('Helvetica','',12);
						  $this->fpdf2->Cell(20, 10, $i, 1);
						  $this->fpdf2->Cell(60, 10, $class_name, 1);
						  $y = $this->fpdf2->GetY();
						  $x = $this->fpdf2->GetX(); 				  

						  $this->fpdf2->Cell(50, 10, date("g:i a", strtotime($schedule->start_time." UTC")), 1);
						  $this->fpdf2->Cell(50, 10, date("g:i a", strtotime($schedule->end_time." UTC")), 1);
						  $this->fpdf2->Ln();
							continue;
					}
					else
					{
						$same_date = $date_array[1];
					}
				  $this->fpdf2->SetFont('Helvetica','',17);
				  $this->fpdf2->Cell(173 , 10, $day_of_week.' , '.$date_array[2].' '.$month_name ,0,0,'L');
				  $this->fpdf2->Ln();
				  				  
				  $this->fpdf2->SetFont('Helvetica','',12);
			  
				  $this->fpdf2->Cell(20, 8, '#', 1);
				  $this->fpdf2->Cell(60, 8, 'Class', 1);
				  $this->fpdf2->Cell(50, 8, 'Start Time', 1);
				  $this->fpdf2->Cell(50, 8, 'End Time', 1);
				  $this->fpdf2->Ln();


				  $this->fpdf2->Cell(20, 10, $i, 1);
				  $this->fpdf2->Cell(60, 10, $class_name, 1);
				  $y = $this->fpdf2->GetY();
				  $x = $this->fpdf2->GetX(); 				  

				  $this->fpdf2->Cell(50, 10, date("g:i a", strtotime($schedule->start_time." UTC")), 1);
				  $this->fpdf2->Cell(50, 10, date("g:i a", strtotime($schedule->end_time." UTC")), 1);
				  $this->fpdf2->Ln();
			  }
			  else
			  {
				  continue;
			  }
			}

		}
      
		function student_schedule()
		{
			$scheduling = json_decode($this->load->get_var('scheduling'));
          
			//Header Logo
		  $this->fpdf2->SetFontSize(20);
		  $this->fpdf2->Cell( 0, 9, $this->fpdf2->Image('http://www.alqurannow.com/beta/img/logo.jpg',10,7,70,0,'JPG'), 0, 1, 'C' );  	
		  $this->fpdf2->Ln(8);
		  
			$this->fpdf2->Cell(80,10, 'Monthly Schedule for '.date('M').' '. date('Y') ,0,0,'C');
			//Line break
			$this->fpdf2->Ln(8);		  
		  

		  $this->fpdf2->SetFont('Helvetica','',17);
		  $this->fpdf2->Cell(173 , 10, $scheduling[0]->name ,0,0,'C');
		  $this->fpdf2->Ln(20);
		  // Row Headings
		  
          	  $this->fpdf2->SetFont('Helvetica','',12);
          
			  $this->fpdf2->Cell(15, 8, '#', 1);
			  $this->fpdf2->Cell(45, 8, 'Class', 1);
			  $this->fpdf2->Cell(45, 8, 'Teacher', 1);
			  $this->fpdf2->Cell(25, 8, 'Date', 1);
			  $this->fpdf2->Cell(30, 8, 'Start Time', 1);
			  $this->fpdf2->Cell(30, 8, 'End Time', 1);
			  $this->fpdf2->Ln();
		  
          // Schedule
		 
 		    $i=0;
			
		  	foreach($scheduling as $schedule)
			{
				
          	  $this->fpdf2->SetFont('Helvetica','',10);
          	  $i++;
			  
			  $class_name_pos = strpos($schedule->title , '{');
			  $class_name = substr($schedule->title , 0 , $class_name_pos);
		  	
				//$teacher_name = substr();		
				
				$start = 'by';
				$end = 'in';

			  $string = " ".$schedule->title;
				$ini = strpos($string,$start);
				if ($ini == 0) return "";
				$ini += strlen($start);
				$len = strpos($string,$end,$ini) - $ini;
				$teacher_name = substr($string,$ini,$len);				
				$date_array = explode("-" , $schedule->date);
				$date = $date_array[2]."-".$date_array[0]."-".$date_array[1];
				
				
			  $month_schedule = date('m' , strtotime($date));
			  $year_schedule = date('Y' , strtotime($date));
			  
			  $current_month = date('m');
			  $current_year = date('Y');
			  
			  if($current_month == $month_schedule && $current_year == $year_schedule)
			  {
				  $this->fpdf2->Cell(15, 8, $i, 1);
				  $this->fpdf2->Cell(45, 8, $class_name, 1);
				  $this->fpdf2->Cell(45, 8, $teacher_name, 1);
				  $this->fpdf2->Cell(25, 8, $schedule->date, 1);
				  $this->fpdf2->Cell(30, 8, $schedule->start_time, 1);
				  $this->fpdf2->Cell(30, 8, $schedule->end_time, 1);
				  $this->fpdf2->Ln();
			  }
			  else
			  {
				  continue;
			  }
			}
			
			//print_r($scheduling);
	    }	  
	  
      function donor_donated()
      {
          $this->fpdf2->SetFont('Helvetica','',20);
          //$this->fpdf2->Write(10,$this->lang->line('donated_money'));
			$this->fpdf2->Cell( 0, 9, $this->fpdf2->Image('http://www.alqurannow.com/beta/img/logo.jpg',10,7,70,0,'JPG'), 0, 1, 'C' );  
			$this->fpdf2->Ln(8);					  

			$paid = 0;
			$outstanding = 0;
			$payment_made = 0;
			$total_paid = 0;
			$num_of_students = 0;

/*          $this->fpdf2->SetFontSize(20);

		  $this->fpdf2->Cell( 0, 9, $this->fpdf2->Image('http://www.alqurannow.com/beta/img/logo.jpg',10,7,70,0,'JPG'), 0, 1, 'C' );  	
		     	
		  $this->fpdf2->Ln(8);
          
			          */
		  $this->fpdf2->Cell( 0, 9, 'Report showing amount donated to students', 0, 1, 'C' );  	
		     	
		  $this->fpdf2->Ln(8);					  

		  					  
		  foreach($this->load->get_var('students') as $student)
          {
			  
				$students_ids[] = $student['student_id']; 
				$num_of_students = count(array_unique($students_ids));			  
				$paid += $student['paid'];
	
				if($student['donate_id'] == 0)
				{
					$outstanding +=$student['paid'];
				}
				else
				{
					$payment_made +=$student['paid'];
				}
		  }
			$total_paid = $paid;

//logo of pdf


          
          $this->fpdf2->SetFont('Helvetica','',15);
          $monies=$this->load->get_var('monies');

			  $this->fpdf2->Cell(95, 10, $this->lang->line('donor_name'). ' : '.$monies['donor_name'], 0);
			  $this->fpdf2->Cell(95, 10, $this->lang->line('donated'). ' : '.$this->load->get_var('currency').' '.$monies['total_donated'], 0);
			  $this->fpdf2->Ln();
			  

			  $this->fpdf2->Cell(95, 10, 'Total Donated to students  : '.$this->load->get_var('currency').' '.$payment_made, 0);
			  $this->fpdf2->Cell(95, 10, 'Current Balance : '.$this->load->get_var('currency').' '.$monies['current_balance'], 0);			  
          	  $this->fpdf2->Ln();
                

			  $this->fpdf2->Cell(95, 10, ' To Pay : '.$this->load->get_var('currency').'  '.$outstanding, 0);
			  $this->fpdf2->Cell(95, 10, 'Total Students : '.$this->load->get_var('total_students').' '.$num_of_students, 0);
		  	  $this->fpdf2->Ln();
		  
          	  $this->fpdf2->SetFont('Helvetica','',16);
          
			  $this->fpdf2->Cell(20, 8, '#', 1);
			  $this->fpdf2->Cell(50, 8, 'Student Name', 1);
			  $this->fpdf2->Cell(40, 8, 'Amount', 1);
			  $this->fpdf2->Cell(80, 8, 'Fees Name', 1);
			   $this->fpdf2->Ln();
			  $this->fpdf2->SetFont('Helvetica','',12);
			  
			  $student_array = array();
			  

			  $loop = 0;
          foreach($this->load->get_var('students') as $student)
          {

			  if($student['date'] != "-"){ $date =  $this->lang->line('at') ." ". date('d M Y',strtotime($student['date'])); }
			  else{ $date = '';}			  $loop++;
			  $this->fpdf2->Cell(20, 6, $loop, 1);
			  $this->fpdf2->Cell(50, 6, substr($student['name'] , 0 ,17), 1);
			  $this->fpdf2->Cell(40, 6, $this->load->get_var('currency').' '.$student['paid'].$this->lang->line('of').$student['amount'], 1);
			  $this->fpdf2->Cell(80, 6, $student['fee_name'], 1);
			  
              //$this->fpdf2->Write(10,'#'.$student['donate_id'].' '.$student['name'].', '.$this->load->get_var('currency').' '.$student['paid'].$this->lang->line('of').$student['amount'].', '.$student['fee_name'].$this->lang->line('at').date('d M Y',strtotime($student['date'])));
              $this->fpdf2->Ln();
          }
		  
		  
		 
      }
      
      function donor_donations()
      {

		    $this->fpdf2->SetFont('Helvetica','',15);			
			$this->fpdf2->Cell( 0, 9, $this->fpdf2->Image('http://www.alqurannow.com/beta/img/logo.jpg',10,7,70,0,'JPG'), 0, 1, 'C' );  	
		 	$this->fpdf2->Ln(8);

		    $this->fpdf2->SetFont('Helvetica','',15);			
			$this->fpdf2->Cell( 0, 9, 'Report showing total donations', 0, 1, 'C' );  	
		 	$this->fpdf2->Ln(8);
			
		    $this->fpdf2->SetFont('Helvetica','',12);
			$this->fpdf2->Cell(12, 8, '#', 1);
		    $this->fpdf2->Cell(25, 8, 'Donation', 1);
		    $this->fpdf2->Cell(25, 8, 'Date', 1);
			$this->fpdf2->Cell(45, 8, 'Source', 1);
			$this->fpdf2->Cell(80, 8, $this->lang->line('status'), 1);
			
			$this->fpdf2->Ln();
          	

          
		  $donations = $this->load->get_var('donations');
		  
				  if(!empty($donations)):				  
					  foreach($donations as $donation)
					  {			
						$this->fpdf2->SetFont('Helvetica','',11);
						$this->fpdf2->Cell(12, 8, $donation['donation_id'], 1);
						$this->fpdf2->Cell(25, 8, $this->load->get_var('currency').' '.$donation['donation'], 1);
						$this->fpdf2->Cell(25, 8, date('d M Y',strtotime($donation['donation_date'])), 1);
						$this->fpdf2->Cell(45, 8,(is_null($donation['source']))?'Manual':ucfirst($donation['source']) , 1);
						
						$this->fpdf2->Cell(80, 8,  (is_null($donation['transaction_code']))? 'Paid' : $donation['status']. ', ' .$donation['transaction_code'], 1);
			
						$this->fpdf2->Ln();			  
						  
					  }
				  endif;
      }
  }
?>