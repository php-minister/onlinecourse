<script type="text/javascript">
    $('document').ready(function(){
      current_table=$('.dynamicTable').dataTable({
          "sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>,"aaSorting":[[0,"desc"]],
      });
    })
</script>
<table class="dynamicTable table-bordered table table-condensed table-hover">
    <thead>
        <tr>
            <th><?= $this->lang->line('lesson')?></th>
            <th><?= $this->lang->line('status')?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($attendance as $status){?>
            <tr>
                <td>
                    <span style="display: none;"><?= strtotime($status['date'].' '.$status['start_time'])?></span>
                    <?= $status['subject_name']?><?= $this->lang->line('at')?><?= date('d M Y h:i A',strtotime($status['date'].' '.$status['start_time']))?><?= $this->lang->line('by')?><?= $status['teacher_name']?>
                </td>
                <td>
                    <?= $status['attendance_status']?>
                    <?= (!is_null($status['private_comment']))?(', '.$this->lang->line('with_comment').$status['private_comment']):''?>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>