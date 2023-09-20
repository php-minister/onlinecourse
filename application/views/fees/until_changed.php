<script>
    $('document').ready(function(){
        row=$('tbody tr[entity_id=<?= $student_id?>]').get(0);
        status=current_table.fnGetData(row,1);
        status=status.replace(/<span.*?$/gi,'');
        <?php if ($until){?>
        status+='<span class="due_date">, <?= $this->lang->line('due').date('d M Y',strtotime($until))?></span>';
        <?php }?>
        current_table.fnUpdate(status,row,1);
    })
</script>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('done')?></div>