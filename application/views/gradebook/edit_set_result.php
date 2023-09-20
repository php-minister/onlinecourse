<?php if (is_numeric($result)){?>
<div class="alert alert-success"><?= $this->lang->line('saved')?></div>
<script>
    $('document').ready(function(){
        $("#assignment_id").prepend('<option value="<?= $result?>" selected="selected"><?= $name.' at '.$date?></option>');
        $("#edit_set_area a").attr('href',$("#edit_set_area a").attr('href').replace(/[0-9]+/gi,'')+'<?= $result?>');
        $('#edit_set_area button').attr('onclick','remove_assigment(<?= $result?>)');
        $("#edit_set_area").removeClass('hide');
    })
</script>
<?php }else{?>
<div class="alert alert-success"><?= $this->lang->line('updated')?></div>
<script>
    $('document').ready(function(){
        $("#assignment_id option[value='<?= $set_id?>']").html('<?= $name.' at '.$date?>');
    })
</script>
<?php }?>