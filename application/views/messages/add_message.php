<script type="text/javascript">
    $('document').ready(function(){
        current_table.fnAddData(['<span style="display: none;"><?= time()?></span><img src="<?= $avatar?>" style="height: 45px;" class="hidden-phone pull-left margin_right_10"><div class="pull-left"><?= $autor?><br/><small title="<?= date('d M Y h:i:s A')?>"><i><?= date('M d h:i:s A')?></i></small></div>','<p><?= $message?></p>']);
        current_table.fnPageChange('last');
        $("#new_message").val('');
    })
</script>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('message_sent')?></div>