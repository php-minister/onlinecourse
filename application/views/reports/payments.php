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
            <th><?= $this->lang->line('details')?></th>
            <th><?= $this->lang->line('status')?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($payments as $payment){?>
        <tr>
            <td><?= $payment['student_name']?></td>
            <td>
            <?php if ($payment['is_paid']=='1'){?>
            <?= $currency?> <?= $payment['sum']?>, <?= ucfirst($payment['source'])?>, #<span class="wrapword"><?= $payment['transaction_code']?></span>, <?= date('d M Y',strtotime($payment['payment_date']))?>
            <?php }elseif($payment['is_deleted']=='1'){?>
            <?= $this->lang->line('deleted')?>
            <?php }else{?>
            <?= $this->lang->line('not_paid_yet')?>
            <?php }?>
            </td>
            <td><?= $payment['status']?></td>
        </tr>
        <?php }?>
    </tbody>
</table>