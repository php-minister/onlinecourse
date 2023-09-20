<?php if (count($reminders)>0){?>
<script>
    $("document").ready(function(){
        $(".complete_reminder").click(function(){
           var reminder_id=$(this).parent().parent().attr('reminder_id');
           $("#save_result").html('<img src="images/ajax-loader.gif" />');
           $.ajax({
               url:'teacher/complete_reminder/'+reminder_id,
               success:function(){
                   $('ul.unstyled li[reminder_id='+reminder_id+']').remove();
                   $("#save_result").html('<div class="alert alert-success"><?= $this->lang->line('done')?></div>');
               }
           });
        })
    })
</script>
<?php }?>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('view_reminders')?></h3>
    </div>
    <div class="modal-body">
      <?php if (count($reminders)==0){?>  
      <div class="alert alert-info"><?= $this->lang->line('no_reminders')?></div>
      <?php }else{?>
      <div id="save_result"></div>  
      <ul class="unstyled">
        <?php foreach($reminders as $reminder){?>
        <li reminder_id="<?= $reminder['remind_id']?>">
            <label>
                <input type="checkbox" class="complete_reminder"><?= $reminder['remind_text']?>
            </label>
        </li>
        <?php }?>
      </ul>
      <?php }?>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
    </div>
</div>