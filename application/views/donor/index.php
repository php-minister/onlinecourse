<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('dashboards'), 'page_name' => 'Donor' ,'forms'=>TRUE,'tables'=>TRUE)); ?>


<?php $this->load->view('donor/menu',array('active_menu'=>'students'))?>
<script type="text/javascript">
    $('document').ready(function(){
       $('.dynamicTable').dataTable({"sPaginationType": "full_numbers",  "iDisplayLength" : 35 , "bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>});	   	
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('#reservationtime').daterangepicker(
  { 
  	format: 'YYYY-MM-DD' 
  },  
  function(start, end) {
	 var starting = start.format('YYYY-MM-DD');
	 var ending = end.format('YYYY-MM-DD');			
	 window.location = 'donor/getdated/'+starting+'/'+ending;	
  });
});
</script>
<!--<header>
    <h2><?= $this->lang->line('dashboards')?></h2>
</header>-->
<?php
		$paid = 0;
		$outstanding=0;
		$total_paid = 0;
		$payment_made =0;	
		$num_of_students =0;
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
?>


<section>
    <article>
        <div class="span3" >
        	<div class="donor_icon"><img src="<?= $this->config->item('base_url')?>images/total_students.png" /></div>
            <div class="donor_desc">
                <h4><?= $this->lang->line('assinged_students')?></h4>
                <span> <?= $num_of_students ?></span>
            </div>
        </div>

        <div class="span3">
        		<div class="donor_icon"><img src="<?= $this->config->item('base_url')?>images/donated_to_students.png" /></div>
            	<div class="donor_desc">        
                    <h4><?= $this->lang->line('donated')?></h4>
                    <span><?= $currency?> <?= $monies['total_donated']?></span>
				</div>        
        </div>
        <div class="span3">
           		<div class="donor_icon"><img src="<?= $this->config->item('base_url')?>images/money_donated.png" /></div>
            	<div class="donor_desc">        
                    <h4><?= $this->lang->line('donated_to_student')?></h4>
                    <span><?= $currency?> <?= $monies['total_used']?></span>
				</div>
        </div>        
        <div class="span3">
	        	<div class="donor_icon"><img src="<?= $this->config->item('base_url')?>images/remaining_money.png" /></div>
            	<div class="donor_desc">                
                    <h4><?= $this->lang->line('remaining')?></h4>
                    <span><?= $currency?> <?= $monies['current_balance']?></span>
				</div>
        </div>
        <div class="clearfix"></div> 
        <div class="span3" style="margin-left:0;">
	        	<div class="donor_icon"><img src="<?= $this->config->item('base_url')?>images/remaining_money.png" /></div>
            	<div class="donor_desc">                
                    <h4>Total Fees</h4>
                    <span><?= $currency?> <?= $paid ; ?></span>
				</div>
        </div>

        <div class="span3">
	        	<div class="donor_icon"><img src="<?= $this->config->item('base_url')?>images/remaining_money.png" /></div>
            	<div class="donor_desc">                
                    <h4>Fees Paid</h4>
                    <span><?= $currency?> <?= $payment_made?></span>
				</div>
        </div>
        <div class="span3">
	        	<div class="donor_icon"><img src="<?= $this->config->item('base_url')?>images/remaining_money.png" /></div>
            	<div class="donor_desc">                
                    <h4>Pending Fees</h4>
                    <span><?= $currency?> <?= $outstanding; ?></span>
				</div>
        </div>                        
        <div class="clearfix"></div>
        <?php
			$date = '';
        	if(isset($start) || isset($end))
			{
				$date = $start . " - " . $end;
			}
		?>
        
<form class="form-horizontal" action="" id="form-horiz">
  <fieldset>
    <div class="control-group">
      <label class="control-label" for="reservationtime">Select Date:</label>
      <div class="controls">
        <div class="input-prepend">
          <span class="add-on" style="float:left"><i class="icon-calendar"></i></span><input type="text" name="reservation" id="reservationtime" value="<?php echo $date; ?>" style="float:left" />
          <span style="float:left;"> <a href="<?php if(!empty($date)){?>donor/getdated/<?php echo $start; ?>/<?php echo $end; ?>?pdf<?php }else{?>donor/?pdf<?php } ?>" target="_blank" id="download_pdf" title="<?= $this->lang->line('download_pdf')?>"><img src="images/pdf.png"></a></span>
        </div>
      </div>

      <div class="controls">
        <div class="input-prepend">
     
        </div>
      </div>
    </div>
  </fieldset>
</form>        
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('student')?></th>
                    <th><?= $this->lang->line('amount')?></th>
                    <th><?= $this->lang->line('fee')?></th>
                    <th>Student Status</th>
                    <th><?= $this->lang->line('status')?></th>
                </tr>
            </thead>
            <tbody>

            <?php 
			$paid = 0;
			$outstanding = 0;
			$payment_made = 0;
			$i=0;
			foreach($students as $student){
				$i++;
				?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $student['name']?></td>
                    <td><?= $currency?> <?= $student['paid']?><? // echo $this->lang->line('of')?><? //echo  $student['amount']?></td>
                    <td>
                        <?= $student['fee_name']?><? if($student['date'] != "-"){ echo $this->lang->line('at')?><?  echo date('d M Y',strtotime($student['date'])); }?>
                        <i class="hidden-phone">
                            <br/>
                            <?= $student['fee_description']?>
                        </i>
                    </td>
                    <td><? if($student['is_current']>0){
						 ?><img src="<?php echo $this->config->item('base_url')?>images/active_student.png" alt="Active">
						 <?php } else{
						 	?>
							<img src="<?php echo $this->config->item('base_url')?>images/inactive_student.png" alt="Inactive">
						 <?php }
						 ?> </td>
                    <td><?php if($student['donate_id']){ echo "Paid"; } else{ echo "Not Paid";}?> </td>
                </tr>
            <?php
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
			?>
            </tbody>
        </table>
        
        <div id="total_donor_container">
        <table class="table-bordered  table-condensed table-hover total_table">
        	<tr> 
            	<td> <b>Total Fees  </b><br />
				 	<?php echo "USD ".$paid; ?></td>
                <td><b> Fees Paid  </b><br />
					<?php echo "USD ". $payment_made;?></td>
                <td><b>Pending Fees </b><br />
					<?php echo "USD ".$outstanding; if($outstanding >= $monies['current_balance']){ ?> &nbsp;&nbsp;&nbsp; 
                    <form action="donor/donate" method="post" id="donation_remaining" style="margin:0;">
                    	<input type="hidden" name="amount" value="<?php echo $outstanding; ?>" />
						<a href="javascript:void(0)" onclick="$('#donation_remaining').submit()">Pay Now</a>
                    </form><?php }?> </td>
        	</tr>
         </table>
        </div>
    </article>
</section>
<?php $this->load->view('layout/footer_web')?>