<script>
    var teachers_list = new Array();
    $('document').ready(function(){
        temp=teachers.getSelectedItems();
        for(var index in temp)
        {
            teachers_list.push(temp[index].name.replace(/<span.*?$/g,''));
        }
        teachers_list=teachers_list.join(',');
    })
</script>
<?php if (is_numeric($result)){?>
<script>
    $('document').ready(function(){
       $('#subject_id').val(<?= $result?>);
       row = current_table.fnAddData([<?= $result?>,$('#name').val(),teachers_list,'<a href="subjects/edit/<?= $result?>" class="btn btn-mini" data-target="#waiting_for_response" data-toggle="modal" title="<?= $this->lang->line('edit')?>"><i class="icon-edit"></i></a>&nbsp;<button class="btn btn-mini" onclick="delete_subject(<?= $result?>)" title="<?= $this->lang->line('delete')?>"><i class="icon-remove"></i></button>']);
       oSettings = current_table.fnSettings();
       oSettings.aoData[ row[0] ].nTr.setAttribute('entity_id',<?= $result?>)
    });
</script>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('added')?></div>
<?php }else{ ?>
<script type="text/javascript">
$('document').ready(function(){
    row = $('tbody tr[entity_id='+$("#subject_id").val()+']').get(0);
    current_table.fnUpdate($('#name').val(),row,1);
    current_table.fnUpdate(teachers_list,row,2);
});
</script>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('updated')?></div>
<?php }?>