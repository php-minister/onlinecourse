<?php if (count($rooms)==0){ ?>
<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('all_rooms_are_busy')?></div>
<?php }else{?>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= sprintf($this->lang->line('found___free_rooms'),count($rooms))?></div>
<script>
    <?php 
    $rooms_txt='';
    foreach($rooms as $room){
        $rooms_txt.='<option value="'.$room['room_id'].'" to_delete="1" is_shared="'.$room['is_shared'].'">'.addslashes($room['name']).($room['is_shared']=='1'?(' ('.$this->lang->line('is_shared').')'):'').'</option>';
    }?>
    $("#room option[to_delete=1]").remove();
    $("#room").append('<?= $rooms_txt?>')
</script>
<?php }?>