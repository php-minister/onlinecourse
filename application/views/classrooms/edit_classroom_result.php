<?php if (is_numeric($result)) {?>
<div class="alert alert-success"><?= $this->lang->line('saved')?></div>
<script type='text/javascript'>
    $('document').ready(function(){
        $("#classroom_id").val(<?= $result?>);
        row = current_table.fnAddData([<?= $result?>,$("#name").val(),$("#is_shared").is(':checked')?'<?= $this->lang->line('yes')?>':'<?= $this->lang->line('no')?>','<a href="classrooms/edit/<?= $result?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_classroom')?>"><i class="icon-edit"></i></a>&nbsp;<a class="btn btn-mini" title="<?= $this->lang->line('classroom_scheduling')?>" href="classrooms/scheduling/<?= $result?>"><i class="icon-calendar"></i></a>&nbsp;<button class="btn btn-mini" onclick="delete_classroom(<?= $result?>)" title="<?= $this->lang->line('delete_classroom')?>"><i class="icon-remove"></i></button>']);
        oSettings = current_table.fnSettings();
        oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
    })
</script>
<?php }else{?>
<div class="alert alert-success"><?= $this->lang->line('updated')?></div>
<script>
    $('document').ready(function(){
        var row = $('tbody tr[entity_id='+$('#classroom_id').val()+']').get(0);
        current_table.fnUpdate($("#name").val(),row,1);
        current_table.fnUpdate($("#is_shared").is(':checked')?'<?= $this->lang->line('yes')?>':'<?= $this->lang->line('no')?>',row,2);
    })
</script>
<?php }?>