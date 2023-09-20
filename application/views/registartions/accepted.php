<div class="alert alert-success"><?= $this->lang->line('Accepted')?><?= sprintf($this->lang->line('student_moved'),$grade['name'],$grade['group_name'])?></div>
<script>
    $("document").ready(function(){
        $(".registration_control,form,.btn.btn-small.btn-success").remove();
        var row = $('tbody tr[entity_id=<?= $registration_id?>]').get(0);
        current_table.fnUpdate('<?= $this->lang->line('Accepted')?>',row,6);
    })
</script>