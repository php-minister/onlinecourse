<?php if (is_numeric($result)) {?>
<div class="alert alert-success"><?= $this->lang->line('saved')?></div>
<script type='text/javascript'>
    $('document').ready(function(){
        $("#semester_id").val(<?= $result?>);
        <?php if ($is_current){?>
        $(".current_semester").remove();
        <?php }?>
        row = current_table.fnAddData([<?= $result?>,$("#name").val(),'<?= date('d M Y',$start_date)?>','<?= date('d M Y',$end_date)?>',$('#year_start').val()+'/'+$("#year_end").val(),
        <?php if ($is_current){?>
        '<a href="semesters/close" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini current_semester" title="<?= $this->lang->line('make_as_completed_and_calculate_final_scores')?>"><i class="icon-ok-sign"></i></a>&nbsp;'+
        <?php }?>
        '<a href="semesters/edit/<?= $result?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_semester')?>"><i class="icon-edit"></i></a>'+
        '&nbsp;<button class="btn btn-mini" onclick="delete_semester(<?= $result?>)" title="<?= $this->lang->line('delete_semester')?>"><i class="icon-remove"></i></button>']);
        oSettings = current_table.fnSettings();
        oSettings.aoData[row[0]].nTr.setAttribute('entity_id',<?= $result?>);
    })
</script>
<?php }else{?>
<div class="alert alert-success"><?= $this->lang->line('updated')?></div>
<script>
    $('document').ready(function(){
        var row = $('tbody tr[entity_id='+$('#semester_id').val()+']').get(0);
        current_table.fnUpdate($("#name").val(),row,1);
        <?php if ($start_date){?>
        current_table.fnUpdate('<?= date('d M Y',$start_date)?>',row,2);
        <?php }?>
        <?php if ($end_date){?>
        current_table.fnUpdate('<?= date('d M Y',$end_date)?>',row,3);
        <?php }?>
        current_table.fnUpdate($('#year_start').val()+'/'+$("#year_end").val(),row,4);
    })
</script>
<?php }?>