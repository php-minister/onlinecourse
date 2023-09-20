<script>
    $('document').ready(function(){
        nicEditors.allTextAreas({iconsPath:'<?= $this->config->item('base_url')?>images/nicEditorIcons.gif',buttonList:['save','bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFormat','indent','outdent','forecolor']});
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $template['template_name']?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="settings/save_email_template" method="POST" id="email_template_form">
            <input type="hidden" name="template_id" value="<?= $template['template_id']?>">
            <label for="template_content"><?= $this->lang->line('template')?><sup class="mandatory">*</sup></label>
            <textarea class="input-xxlarge required" rows="10" name="template_content" id="template_content">
                <?= nl2br($template['template_content'])?>
            </textarea>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="$('#template_content').val(nicEditors.findEditor('template_content').getContent());submit_form('#email_template_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>