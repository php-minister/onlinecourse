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
            <th><?= $this->lang->line('student')?></th>
            <th><?= $this->lang->line('feedback')?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($feedbacks as $feedback){?>
        <tr>
            <td>
                <span style="display: none;"><?= strtotime($feedback['date'].' '.$feedback['start_time'])?></span>
                <?= $feedback['student_name']?>
                <?= (!is_null($feedback['grade_name'])?('('.$feedback['grade_name'].')'):'')?>
                <?= $this->lang->line('for')?> <?= $feedback['subject_name']?> (<?= date('d M Y',strtotime($feedback['date'].' '.$feedback['start_time']))?>)
            </td>
            <td>
                <span class="rating rate_<?= $feedback['rating']?>"></span>
                <?= $feedback['comment']?>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>