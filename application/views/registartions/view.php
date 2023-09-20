<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('registration_details')?></h3>
    </div>
    <div class="modal-body">
        <div id="save_result"></div>
        
        <?php if ($registration['registration_status']=='Open'){?>
        <form action="registrations/accept/<?= $registration['registration_id']?>" id="accept_form" method="POST"></form>
        <form action="registrations/decline/<?= $registration['registration_id']?>" id="decline_form" method="POST"></form>
        <?php }?>
        
        <div class="pull-left span6" style="margin-left: 0;">
           <b> <?= $this->lang->line('student')?>:</b> <br/>
           <b> <?= $this->lang->line('phone')?>:</b> <br/>
           <b> <?= $this->lang->line('email')?>: </b><br/>
           <b> <?= $this->lang->line('comment')?>: </b>
        </div>
         <div class="pull-left span6">
           <?= $registration['student_name']?><br/>
           <?= $registration['student_phone']?><br/>
           <?= $registration['student_email']?> <br/>
           <?= $registration['student_comment']?>
         </div>
        <div class="pull-left span6 comment_registration" >
            <ul id="comments_area" class="unstyled" style="max-height: 250px;overflow: auto;">
                <?= $registration['comments']?>
            </ul>
            <?php if ($registration['registration_status']=='Open'){?>
            <form action="registrations/add_comment" id="add_comment_form" method="POST">
                <input type="hidden" name="registration_id" value="<?= $registration['registration_id']?>">
                <div class="control-group">
                    <label for="comment"><?= $this->lang->line('comment')?><sup class="mandatory">*</sup></label>
                    <textarea class="span12 required" id="comment" name="comment"></textarea>
                </div>
            </form>
            <button class="btn btn-small btn-success" onclick="submit_form('#add_comment_form')"><?= $this->lang->line('add_comment')?></button>
            <?php }?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="modal-footer">
        <?php if ($registration['registration_status']=='Open'){?>
        <button onclick="submit_form('#decline_form')" class="btn pull-left btn-danger registration_control"><?= $this->lang->line('decline')?></button>
        <?php }?>
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <?php if ($registration['registration_status']=='Open'){?>
        <button onclick="submit_form('#accept_form')" class="btn btn-info registration_control"><?= $this->lang->line('accept')?></button>
        <?php }?>
    </div>
</div>