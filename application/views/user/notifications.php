<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('notifications'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<?php $this->load->view($this->session->userdata('person_type').'/menu',array('active_menu'=>'notifications'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  }); 
  
  function delete_notification(notification_id)
  {
      ajax_query('notifications/delete/'+notification_id,'',function(){
            delete_row(notification_id,'<?= $this->lang->line('notification_deleted')?>');
      });
  }
</script>

    <h2><?= $this->lang->line('notifications')?></h2>

<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th><?= $this->lang->line('notification')?></th>
                    <th><?= $this->lang->line('date')?></th>
                    <th><?= $this->lang->line('actions')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($notifications_list as $notification){?>
                <tr entity_id="<?= $notification['notification_id']?>">
                    <td><?= $notification['notification']?></td>
                    <td><?= date('d M Y',strtotime($notification['date']))?></td>
                    <td>
                        <button class="btn btn-mini" onclick="delete_notification(<?= $notification['notification_id']?>)"><i class="icon-remove"></i></button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer_web')?>