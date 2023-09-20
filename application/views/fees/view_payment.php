<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('view_fee')?></h3>
    </div>
    <div class="modal-body">
         <?php if (!in_array($payment['status'],array('Deposited','Completed'))){?>
         <div id="save_result"></div>
         <form action="fees/mark_as_completed" id="mark_as_completed_form" method="POST">
            <input type="hidden" name="fee_id" value="<?= $fee_id?>">
            <input type="hidden" name="student_id" value="<?= $student_id?>">
         </form>
         <?php }?>
         <label><?= $this->lang->line('source')?>: <?= ucfirst($payment['source'])?></label>
         <label><?= $this->lang->line('status')?>: <?= $payment['status']?></label>
         <label><?= $this->lang->line('transaction_code')?>: <?= $payment['transaction_code']?></label>
         <label><?= $this->lang->line('amount')?>: <?= $currency?> <?= $payment['amount']?></label>
         <label><?= $this->lang->line('paid')?>: <?= $currency?> <?= $payment['sum']?></label>
         <label><?= $this->lang->line('payment_date')?>: <?= (is_null($payment['payment_date']))?'':date('d M Y h:i A',strtotime($payment['payment_date']))?></label>
         <hr/>
         <label><?= $this->lang->line('donors')?>: <?= $payment['donors']?></label>
         <label><?= $this->lang->line('dontaed')?>: <?= $currency?> <?= round($payment['donation'],2)?></label>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <?php if (!in_array($payment['status'],array('Deposited','Completed'))){?>
        <button class="btn btn-info" onclick="submit_form('#mark_as_completed_form')"><?= $this->lang->line('mark_as_completed')?></button> 
        <?php }?>
    </div>
</div>