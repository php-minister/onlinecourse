<?php if (is_numeric($result)) {?>
<div class="alert alert-success"><?= $this->lang->line('saved')?></div>
<script type='text/javascript'>
    $('document').ready(function(){
        $("#group_id").val(<?= $result?>);
        row = current_table.fnAddData([<?= $result?>,$("#name").val()+' ('+$("#grade option:selected").text()+')','<a href="students_groups/edit/<?= $result?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_group')?>"><i class="icon-edit"></i></a>&nbsp;<a  class="btn btn-mini" title="<?= $this->lang->line('group_scheduling')?>" href="students_groups/scheduling/<?= $result?>"><i class="icon-calendar"></i></a>&nbsp;<button class="btn btn-mini" onclick="delete_group(<?= $result?>)" title="<?= $this->lang->line('delete_group')?>"><i class="icon-remove"></i></button>']);
        oSettings = current_table.fnSettings();
        oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
    })
</script>
<?php }else{?>
<div class="alert alert-success"><?= $this->lang->line('updated')?></div>
<script>
    $('document').ready(function(){
        var row = $('tbody tr[entity_id='+$('#group_id').val()+']').get(0);
        current_table.fnUpdate($("#name").val()+' ('+$("#grade option:selected").text()+')',row,1);
    })
</script>
<?php }?>