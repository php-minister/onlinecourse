<div class="alert alert-success"><?= $this->lang->line('comment_added')?></div>
<script>
    $('document').ready(function(){
        $("#comments_area").append('<li><?= $comment.'<br/> <i><small>'.date('d M Y h:i A').', '.$this->lang->line('by').' '.$this->session->userdata['admin_name']?></small></i></li>');
        var row = $('tbody tr[entity_id=<?= $registration['registration_id']?>]').get(0);
        current_table.fnUpdate('<?= $registration['student_name']?>, <?= $this->lang->line('at')?> <?= date('d M Y',strtotime($registration['registation_date']))?>, <?= $registration['last_comment']?>',row,1);
        $('#comment').val('');
    })
</script>