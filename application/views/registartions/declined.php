<div class="alert alert-success"><?= $this->lang->line('Declined')?></div>
<script>
    $("document").ready(function(){
        $(".registration_control,form,.btn.btn-small.btn-success").remove();
        var row = $('tbody tr[entity_id=<?= $registration_id?>]').get(0);
        current_table.fnUpdate('<?= $this->lang->line('Declined')?>',row,2);
    })
</script>