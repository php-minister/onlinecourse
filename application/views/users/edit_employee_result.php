<?php if (is_numeric($result)){?>
<script>
    $('document').ready(function(){
       $('#employee_id').val(<?= $result?>);
       row = current_table.fnAddData([<?= $result?>,$('#admin_name').val(),$('#admin_login').val(),'<a href="users/staff_edit/<?= $result?>" class="btn btn-mini" data-target="#waiting_for_response" data-toggle="modal" title="<?= $this->lang->line('edit')?>"><i class="icon-edit"></i></a>&nbsp;<button class="btn btn-mini" onclick="delete_staff(<?= $result?>)" title="<?= $this->lang->line('delete')?>"><i class="icon-remove"></i></button>']);
       oSettings = current_table.fnSettings();
       oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>)
    });
</script>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('added')?></div>
<?php }else{?>
<script type="text/javascript">
$('document').ready(function(){
    row = $('tbody tr[entity_id='+$("#employee_id").val()+']').get(0);
    current_table.fnUpdate($('#admin_name').val(),row,1);
    current_table.fnUpdate($('#admin_login').val(),row,2);
});
</script>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('updated')?></div>
<?php }?>