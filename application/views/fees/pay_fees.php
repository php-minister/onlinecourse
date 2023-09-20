
<div class="modal show">
  
  <script>

  function mark_as_completed(student_id)
  {
	  if(confirm('Are you sure you want to pay fee?'))
	  {
	      $.ajax({
			url:'fees/mark_as_completed/<?= $fee_id?>/'+student_id,
			type: 'POST',
			success:function(html){
			alert('Completed.');
			},
			error:function(response){
				show_error_message(response.responseText)
				}
   			});
	  }
  }  
  
  
  function deduct_from_donor(student_id, donor_amount)
  {
	  if(confirm('Are you sure you want to pay fee?'))
	  {
			  ajax_query('fees/deduct_from_donor/<?= $fee_id?>/'+student_id+'/'+donor_amount,'waiting_for_response',function(){				  
				  row=$('tbody tr[entity_id='+student_id+']').get(0);				 
				  current_table.fnUpdate('<a href="fees/change_until/<?= $fee_id?>/'+student_id+'" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('change_until')?>"><i class="icon-calendar"></i></a>',row,2);
				});		  
	  }
  }
</script>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Pay Fees</h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="" method="POST" id="">
            <input type="hidden" id="student_id" name="student_id" value="<?= $student_id; ?>">            
            <ul class="nav nav-tabs">
              <li class=""><a href="#main_tab" data-toggle="tab"><?= $this->lang->line('main')?></a></li>	
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="main_tab">

			<?php
		
					 if($payments[0]['part_of_donation'])
					 {
					 	$donor_amount = ($fee['amount'] * $payments[0]['part_of_donation'])/ 100;
						$student_fees = $fee['amount'] - $donor_amount;						
					 }
					 else
					 {
						 $donor_amount = 0;
						 $student_fees = $fee['amount'];
					 }				
			?>

           <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student Amount</th>
                   <?php if($payments[0]['part_of_donation']):?>
                    <th>Donor Amount</th>  
                   <?php endif; ?>                  
                </tr>
            </thead>
            <tbody>
            <tr>
            	<td> Mohsin</td>
                <td><?php echo $student_fees; ?> &nbsp; &nbsp; &nbsp; &nbsp; <?php if($payments[0]['is_paid'] == 0){?><button class="btn btn-mini" onclick="mark_as_completed(<?= $payments[0]['student_id']?>)" title="<?= $this->lang->line('mark_as_completed')?>"><i class="icon-ok"></i></button><?php } else{ echo "Paid";  }?> 			
                </td>           
           
           		<td>
                   <div>
                   <?php echo $donor_amount; ?>  &nbsp; &nbsp; &nbsp; &nbsp; 
    	               <?php if($payments[0]['part_of_donation'] && !$payments[0]['donated_ids']):?>
	                   <button class="btn btn-mini" onclick="deduct_from_donor(<?= $payments[0]['student_id']?> , <?= $donor_amount ?>)" title="<?= $this->lang->line('mark_as_completed')?>"><i class="icon-ok"></i></button>
				   <?php else: 
				   			echo "Paid"; 
				   endif; 
				   ?>
                   </div>
				</td>

             </tr>  
			</tbody>           
           </table> 
                </div>                
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
    </div>
</div>