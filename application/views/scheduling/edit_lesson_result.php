<?php if (is_numeric($result)){?>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('added')?></div>
<?php }else{?>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('updated')?></div>
<?php }?>
<script>
    $('document').ready(function(){
        var event = <?= $event?>;
        <?php if(is_numeric($result)){?>
        $("#lesson_id").val(<?= $result?>);
        <?php }else{?>
        calendar.removeEvent(event.id,false);
        <?php }?>
        calendar.addEvent(event);
        $("#room option[value=<?= $room_id?>][is_shared=0]").remove();
    })
</script>