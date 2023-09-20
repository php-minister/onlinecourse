<script>
    function remove_subscription(subscription_id)
    {
        $("#save_result").html('<img src="images/ajax-loader.gif" />');
        $.ajax({
            url:'payments/remove_subscription/'+subscription_id,
            success:function(html)
            {
                $("#save_result").html(html);
            }
        })
    }
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('subscriptions')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th><?= $this->lang->line('name')?></th>
                    <th><?= $this->lang->line('amount')?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($subscriptions as $subscription){?>    
                    <tr entity_id="<?= $subscription['subscription_id']?>">
                        <td><?= $subscription['subscription_name']?></td>
                        <td><?= $currency?><?= $subscription['subscription_value']?></td>
                        <td class="remove_button">
                            <?php if ($subscription['is_active']=='1'){?>
                            <button class="btn btn-mini" title="<?= $this->lang->line('remove_subscription')?>" onclick="remove_subscription(<?= $subscription['subscription_id']?>)">
                                <i class="icon-remove"></i>
                            </button>
                            <?php }?>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
    </div>
</div>