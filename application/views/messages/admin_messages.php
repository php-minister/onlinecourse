<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('messages_center'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'messages'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "aaSorting":[[2,"desc"]],
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  }); 
</script>
<header>
    <h2><?= $this->lang->line('messages_center')?>&nbsp;&nbsp;<a href="messages_center/new_message" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('new_message')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('subject')?></th>
                    <th><?= $this->lang->line('last_message')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($messages as $message){?>
                <tr entity_id="<?= $message['thread_id']?>">
                    <td><?= $message['thread_id']?></td>
                    <td>
                        <a href="messages_center/thread/<?= $message['thread_id']?>"><?= $message['thread_subject']?></a> <?= ($message['new_messages']>0)?sprintf($this->lang->line('new_messages'),'+'.$message['new_messages']):''?>
                    </td>
                    <td>
                        <span style="display: none;"><?= strtotime($message['last_message_at'])?></span>
                        <?= $message['last_message']?>, <?= $this->lang->line('by')?>: <?= $message['last_message_by']?> <?= $this->lang->line('at')?> <?= date('d M Y h:i:s A',strtotime($message['last_message_at']))?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>