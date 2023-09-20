<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('payments'),'forms'=>TRUE,'tables'=>TRUE,'date_picker'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'school'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  });
</script>
<header>
    <h2><?= $this->lang->line('payments_for')?> <small><?= $fee_name?></small></h2>
    <i><?= sprintf($this->lang->line('all_sum_in'),$this->lang->line('currency_'.$currency))?></i>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('student')?></th>
                    <th><?= $this->lang->line('status')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($payments as $payment){?>
                <tr>
                    <td><?= ($payment['is_paid'])?$payment['transaction_id']:''?></td>
                    <td><?= $payment['name']?> <?= (isset($payment['group_name']))?(' ('.$payment['group_name'].')'):''?></td>
                    <td>
                        <?= ($payment['is_paid'])?
                        ($payment['status'].', '.$this->lang->line('at').($payment['is_paid']?date('d M Y',strtotime($payment['payment_date'])):'')):
                        $this->lang->line('not_paid')?><?= ($payment['is_deleted'])?$this->lang->line('payment_deleted'):''?></td>
                    <td>
                        <a href="fees/view/<?= $fee_id?>/<?= $payment['student_id']?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('view_fee')?>"><i class="icon-zoom-in"></i></a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer')?>