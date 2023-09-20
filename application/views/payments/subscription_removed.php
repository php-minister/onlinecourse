<div class="alert alert-success"><?= $this->lang->line('done')?></div>
<script>
    $('document').ready(function(){
        $('.table tr[entity_id="<?= $subscription_id?>"] .remove_button').html('');
    })
</script>