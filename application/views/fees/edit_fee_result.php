<?php if (is_numeric($result)) {?>
<div class="alert alert-success"><?= $this->lang->line('saved')?></div>
<script type='text/javascript'>
    $('document').ready(function(){
        $("#fee_id").val(<?= $result?>);
        row = current_table.fnAddData([<?= $result?>,$("#fee_name").val(),'<?= $amount?>','<a href="fees/edit/<?= $result?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_fee')?>"><i class="icon-edit"></i></a>&nbsp;<a href="fees/payments/<?= $result?>" class="btn btn-mini" title="<?= $this->lang->line('view_payments')?>"><i class="icon-signal"></i></a>&nbsp;<button class="btn btn-mini" onclick="delete_fee(<?= $result?>)" title="<?= $this->lang->line('delete_fee')?>"><i class="icon-remove"></i></button>']);
        oSettings = current_table.fnSettings();
        oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
    });
</script>        
<?php }else{?>
<div class="alert alert-success"><?= $this->lang->line('updated')?></div>
<script>
    $('document').ready(function(){
        row = $('tbody tr[entity_id='+$('#fee_id').val()+']').get(0);
        current_table.fnUpdate($("#fee_name").val(),row,1);
        current_table.fnUpdate('<?= $amount?>',row,2);
    });
</script>
<?php }?>