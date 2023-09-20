<script>
    $('document').ready(function(){
       <?php if (is_numeric($result)){?>     
       $('#incident_id').val(<?= $result?>);
       <?php }?>
       current_table.fnDraw();
    });
</script>
<?php if (is_numeric($result)){?>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('added')?></div>
<?php }else{?>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('updated')?></div>
<?php }?>