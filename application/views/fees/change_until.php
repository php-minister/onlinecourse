<script>
    $('document').ready(function(){
        $("#until").datepicker();
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('change_until')?></h3>
    </div>
    <div class="modal-body">
         <div id="save_result"></div>
         <form action="fees/save_until" id="save_until_form" method="POST">
            <input type="hidden" name="fee_id" value="<?= $fee_id?>">
            <input type="hidden" name="student_id" value="<?= $student_id?>">
            <div class="control-group">
                <label for="until"><?= $this->lang->line('due_date')?></label>
                <input type="text" name="until" id="until" value="<?= (is_null($payment_dates['until']))?'':date('m/d/Y',strtotime($payment_dates['until']))?>">
                <br/><small><i><?= $this->lang->line('default_date')?> <?= date('d M Y',strtotime($payment_dates['default_until']))?>, <?= $this->lang->line('leave_blank_for_default')?></i></small>
            </div>
         </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#save_until_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>