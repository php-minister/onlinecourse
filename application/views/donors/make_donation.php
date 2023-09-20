<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('make_donation')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="donors/complete_donation" method="POST" id="complete_donation_form">
            <input type="hidden" name="donor_id" id="donor_id" value="<?= $donor['donor_id']?>">
            <label><?= $this->lang->line('donor_name')?>: <?= $donor['name']?></label>
            <div class="control-group">
                <label for="donation"><?= $this->lang->line('donation')?><sup class="mandatory">*</sup></label>
                <div class="control-group input-prepend">
                    <span class="add-on"><?= $currency?></span>
                    <input type="text" name="donation" id="donation" class="required digits">
                </div>
            </div>
            <div class="control-group">
                <label for="comment"><?= $this->lang->line('comment')?></label>
                <textarea rows="2" class="span12" id="comment" name="comment" maxlength="300"></textarea>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#complete_donation_form')" class="btn btn-info"><?= $this->lang->line('donate')?></button>
    </div>
</div>