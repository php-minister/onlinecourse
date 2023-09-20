<?php if($this->session->userdata('person_type') == 'teacher'){?>
<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('new_message'),'forms'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php } else {?>
<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('new_message'),'forms'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php } ?>
<?php $this->load->view($this->session->userdata('person_type').'/menu',array('active_menu'=>'messages'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "oLanguage":<?= $this->lang->line('datatables')?>,
         "oLanguage":{"sInfo":""},
         "aaSorting":[[0,"asc"]],
     });
     current_table.fnPageChange('last');
  }); 
</script>
<style>
    .table td{padding: 4px;}
    .table{margin-bottom: 10px;}
</style>
    <h2><?= $thread['thread_subject']?></h2>

<section>
    <article>
        <table class="table table-striped dynamicTable">
            <thead style="display: none;">
                <tr>
                    <th>1</th>
                    <th>1</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($thread['messages'] as $message){?>
                <tr>
                    <td width="220">
                        <span style="display: none;"><?= strtotime($message['message_date'])?></span>
                        <img src="<?= ($message['sender_person']!='admin')?$thread[$message['sender_person']][$message['message_sender']]['avatar']:DEFAULT_PHOTO?>" style="height: 45px;" class="hidden-phone pull-left margin_right_10">
                        <div class="pull-left">
                            <?= ($message['sender_person']!='admin')?$thread[$message['sender_person']][$message['message_sender']]['name']:'Admin'?><br/>
                            <small title="<?= date('d M Y h:i:s A',strtotime($message['message_date']))?>"><i><?= date('M d h:i:s A',strtotime($message['message_date']))?></i></small>
                        </div>
                    </td>
                    <td>
                        <p><?= $message['message_body']?></p>
                    </td>
                </tr>
            <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">
                        <div id="save_result"></div>
                        <form action="messages/reply/<?= $thread['thread_id']?>" method="post" id="new_message_form">
                            <div class="control-group span10 margin_right_10">
                                <label for="new_message"><?= $this->lang->line('new_message')?><sup class="mandatory">*</sup></label>
                                <textarea rows="2" name="new_message" id="new_message" class="required span12" maxlength="2000"></textarea>
                            </div>
                            <div>
                                <label>&nbsp;</label>
                                <button type="button" class="btn btn-info btn-large" onclick="submit_form('#new_message_form')"><?= $this->lang->line('send')?></button>
                            </div>
                        </form>
                    </th>
                </tr>
            </tfoot>
        </table>
    </article>
</section>
<?php if($this->session->userdata('person_type') == 'teacher'){?>
<?php $this->load->view('layout/footer') ?>
<?php } else{
	$this->load->view('layout/footer_web');
	}?>