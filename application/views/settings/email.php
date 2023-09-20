<script>
    $('document').ready(function(){
        $("#email_method").change(function(){
            if ($('#email_method option:selected').val()=='smtp')
            {
               $('#smtp_options').show('fade');
               $("#smtp_server,#smtp_password,#smtp_user_name").addClass('required');
            }
            else
            {
                $('#smtp_options').hide('fade');
                $("#smtp_server,#smtp_password,#smtp_user_name").removeClass('required').val('');
            }
        })
        
        $("#send_test_message").click(function(){
            $("#save_result").html('<img src="images/ajax-loader.gif" />');
            $("#test_email").addClass('required email');
            change_validation_position('#settings_form');
            
            $("#settings_form").ajaxSubmit({
                beforeSubmit:function(arr,$form){
                    if ($($form).valid()==true)
                    {
                        return true;
                    }
                    $("#save_result").html('');
                    return false;
                },
                url:'settings/test_email',
                target:'#save_result'
            })
            return false;
        })
        
        $('.popover_details').popover({trigger:'hover',placement:'bottom'});
    })
</script>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('email_settings')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        <form action="settings/save_email_settings" method="POST" id="settings_form">
            <div class="control-group pull-left margin_right_10">
                <label for="email_method"><?= $this->lang->line('how_to_send_emails')?><sup class="mandatory">*</sup></label>
                <select id="email_method" name="email_method" class="required">
                    <option value="mail" <?= ($settings['email_method']=='mail'?'selected="selected"':'') ?>><?= $this->lang->line('with_mail_function')?></option>
                    <option value="smtp" <?= ($settings['email_method']=='smtp'?'selected="selected"':'')?>><?= $this->lang->line('via_smtp_server')?></option>
                </select>
            </div>
            
            <div class="pull-left">
                <label><?= $this->lang->line('send_type')?><sup class="mandatory">*</sup></label>
                <input type="hidden" name="send_type" id="send_type" value="<?= $settings['send_type']?>">
                <div class="btn-group" data-toggle="buttons-radio">
                    <button type="button" class="btn popover_details <?= ($settings['send_type']=='immediately')?'active':''?>" data-content="<?= $this->lang->line('send_immediately')?>" onclick="$('#send_type').val('immediately');$('.lazy_sending_details').hide();"><?= $this->lang->line('immediately')?></button>
                    <button type="button" class="btn popover_details <?= ($settings['send_type']=='lazy')?'active':''?>" data-content="<?= $this->lang->line('grouped_then_send')?>" onclick="$('#send_type').val('lazy');$('.lazy_sending_details').show();">"<?= $this->lang->line('lazy')?>"</button>
                </div>
                <br/>
                    <a target="_blank" href="http://school.zilorent.com/docs/lazy-email-sending" class="lazy_sending_details" class="<?= ($settings['send_type']=='immediately')?'hide':'show'?>"><?= $this->lang->line('how_to_install__lazy__sending')?></a>
            </div>
            <div class="clearfix"></div>
            <div class="alert alert-info lazy_sending_details" style="font-size: 13px;overflow: auto;<?= ($settings['send_type']=='lazy')?'':'display: none'?>"><?= $this->lang->line('file_to_add_to_cron_task')?>: <?=  (strpos($this->config->item('base_url'),'zilorent.com')?$this->lang->line('path_your_server'):realpath('application/controllers')).'/cron_tasks run_cron'?></div> 
            <div class="clearfix"></div>
            <div id="smtp_options"  class="<?= ($settings['email_method']=='smtp'?'show':'hide')?>">
                <div class="pull-left margin_right_10">
                    <div class="control-group">
                        <label for="smtp_server"><?= $this->lang->line('smtp_server')?><sup class="mandatory">*</sup></label>
                        <input type="text" name="smtp_server" id="smtp_server" maxlength="100" value="<?= $settings['smtp_server']?>" placeholder="server:port">
                    </div>
                    <div class="control-group">
                        <label for="smtp_password"><?= $this->lang->line('smtp_password')?><sup class="mandatory">*</sup></label>
                        <input type="password" name="smtp_password" id="smtp_password" maxlength="100" value="<?= $settings['smtp_password']?>">
                    </div>
                </div>
                <div class="pull-left control-group margin_right_10">
                    <label for="smtp_user_name"><?= $this->lang->line('smtp_user')?><sup class="mandatory">*</sup></label>
                    <input type="text" name="smtp_user_name" id="smtp_user_name" maxlength="100" value="<?= $settings['smtp_user_name']?>">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="pull-left control-group margin_right_10">
                <label for="message_from"><?= $this->lang->line('send_messages_from')?></label>
                <input type="text" name="message_from" id="message_from" maxlength="100" value="<?= $settings['message_from']?>">
            </div>
            <div class="pull-left control-group">
                <label for="from_email"><?= $this->lang->line('send_messages_from_email')?></label>
                <input type="text" name="from_email" id="from_email" value="<?= $settings['from_email']?>" maxlength="100" class="email">
            </div>
            <div class="clearfix"></div>
            <label for="test_email"><?= $this->lang->line('send_test_message_to')?>:</label>
            <div class="clearfix"></div>
            <div class="control-group pull-left margin_right_10">
                <input type="text" id="test_email" name="test_email">
            </div>
            <div class="pull-left">
                <button type="button" class="btn btn-success" id="send_test_message"><?= $this->lang->line('send_test_message')?></button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="$('#test_email').removeClass('required email');submit_form('#settings_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>