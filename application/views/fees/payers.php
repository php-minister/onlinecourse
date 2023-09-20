<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('payers'),'forms'=>TRUE,'tables'=>TRUE,'date_picker'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'school'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  });
  
  function mark_as_completed(student_id)
  {
	  if(confirm('Are you sure you wnat to pay fee'))
	  { 
			  ajax_query('fees/mark_as_completed/<?= $fee_id?>/'+student_id,'waiting_for_response',function(){
				  row=$('tbody tr[entity_id='+student_id+']').get(0);
				  current_table.fnUpdate('<a href="fees/change_until/<?= $fee_id?>/'+student_id+'" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('change_until')?>"><i class="icon-calendar"></i></a>',row,2);
				});								
	  }
  }
  
  function delete_student(student_id)
  {
      if (confirm('<?= $this->lang->line('are_sure_want_delete_this_student_')?>'))
      {
          ajax_query('fees/delete_student/<?= $fee_id?>/'+student_id,'waiting_for_response',function(){
              row=$('tbody tr[entity_id='+student_id+']').get(0);
              current_table.fnUpdate('',row,2);
              current_table.fnUpdate('<?= $this->lang->line('not_paid').$this->lang->line('payment_deleted')?>',row,1);
          })    
      }
  }
  
</script>
<header>
    <h2><?= $this->lang->line('payers_for')?> <small><?= $fee['fee_name']?>, <?= $this->lang->line('due')?> <?= date('d M Y',strtotime($fee['until']))?></small></h2>
    <i><?= sprintf($this->lang->line('all_sum_in'),$this->lang->line('currency_'.$currency))?></i>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th><?= $this->lang->line('student')?></th>
                    <th><?= $this->lang->line('to_pay_by_student')?></th>
                    <th><?= $this->lang->line('to_pay_by_donor')?></th>
                    <th><?= $this->lang->line('status')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($payments as $payment){?>
                <tr entity_id="<?= $payment['student_id']?>">
                    <td><?= $payment['name'] ?> <?= (isset($payment['group_name']))?(' ('.$payment['group_name'].')'):''?></td>
                    <td><?php
					 if($payment['part_of_donation'])
					 {
					 	$donor_amount = ($fee['amount'] * $payment['part_of_donation'])/ 100;
						$student_fees = $fee['amount'] - $donor_amount;						
					 }
					 else
					 {
						 $donor_amount = 0;
						 $student_fees = $fee['amount'];
					 }
					  echo $student_fees;
					  ?>
                      </td>
                      <td><?php echo $donor_amount; ?> </td>
                    <td>
                        <?= ($payment['is_paid'])?
                        ($payment['status'].', '.$this->lang->line('at').($payment['is_paid']?date('d M Y',strtotime($payment['payment_date'])):'')):
                        $this->lang->line('not_paid')?><?= ($payment['is_deleted'])?$this->lang->line('payment_deleted'):''?>
                        <?= ($payment['is_subscribed'])?(', '.$this->lang->line('subscribed')):''?>
                        <span class="due_date"><?= (($payment['is_paid']=='0') AND (!is_null($payment['until'])))?(', '.$this->lang->line('due').date('d M Y',strtotime($payment['until']))):''?></span>
                    </td>
                    <td>
                        <?php if (($payment['is_paid']=='0') AND ($payment['is_deleted']=='0')){?>
                        <a href="fees/change_until/<?= $fee_id?>/<?= $payment['student_id']?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('change_until')?>"><i class="icon-calendar"></i></a>
                        <!--<button class="btn btn-mini" onclick="mark_as_completed(<?= $payment['student_id']?>)" title="<?= $this->lang->line('mark_as_completed')?>"><i class="icon-ok"></i></button>-->
                        <a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Pay Fees" href="fees/pay_fees/<?php echo $fee_id; ?>/<?php echo $payment['student_id']; ?>"><i class="icon-ok"></i></a>                       
                        <button class="btn btn-mini" onclick="delete_student(<?= $payment['student_id']?>)" title="<?= $this->lang->line('delete_student')?>"><i class="icon-remove"></i></button>
                        <?php }
						if($payment['is_paid']=='1' && $payment['donated_ids'] == 0 && 	$payment['part_of_donation'])
						{
						?>                        
                      <a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="Pay Fees" href="fees/pay_fees/<?php echo $fee_id; ?>/<?php echo $payment['student_id']; ?>"><i class="icon-ok"></i></a>                   <?php } ?>
                    </td>
                </tr>
                <?php }
				?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer')?>