<?php if (is_numeric($result)){?>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('added')?></div>
<script>
    $('document').ready(function(){
       $('#incident_id').val(<?= $result?>);
       row = current_table.fnAddData([<?= $result?>,'<?= $date?>',$("#details").val().substring(0,50),'<a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_incident')?>" href="teacher/edit_incident/<?= $result?>"><i class="icon-edit"></i></a>&nbsp;<button onclick="delete_incident(<?= $result?>)" title="<?= $this->lang->line('delete_incident')?>" class="btn btn-mini"><i class="icon-remove"></i></button>']);
        oSettings = current_table.fnSettings();
        oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
    });
</script>
<?php }else{?>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('updated')?></div>
<script>
    $('document').ready(function(){
       var row = $('tbody tr[entity_id='+$('#incident_id').val()+']').get(0);
       current_table.fnUpdate('<?= $date?>',row,1);
       current_table.fnUpdate($("#details").val().substring(0,50),row,2);
    });
</script>
<?php }?>