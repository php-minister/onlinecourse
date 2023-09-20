<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('payments'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<?php $this->load->view($this->session->userdata('person_type').'/menu',array('active_menu'=>'payments'))?>
<script type="text/javascript">
  $('document').ready(function(){
      current_table=$('.dynamicTable').dataTable({
          "sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>
      });
  })
</script>
<!--<header>
    <h2><?= $this->lang->line('payments')?></h2>
</header>-->
<section>
    <article>
        <?php if (isset($payment_error)){?>
        <div class="alert alert-error"><?= $payment_error?></div>
        <?php }?>
        <?php if (isset($payment_success)){?>
        <div class="alert alert-info"><?= $payment_success?></div>
        <?php }?>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('fee_name')?></th>
                    <th><?= $this->lang->line('fee_amount')?></th>
                    <th><?= $this->lang->line('status')?></th>
                    <?php if (isset($payments[0]['name'])){?>
                    <th><?= $this->lang->line('child')?></th>
                    <?php }?>
                    <th><?= $this->lang->line('date')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($payments as $payment){?>
                <tr>
                    <td><?= $payment['is_paid']?$payment['transaction_id']:'-'?></td>
                    <td><?= $payment['fee_name']?></td>
                    <td><?= $currency?> <?= $payment['amount']?><?= $payment['part_of_donation']>0?sprintf($this->lang->line('with_percent_donation'),$payment['part_of_donation']):''?></td>
                    <td><? 
						if((!$payment['is_paid']) && $payment['part_of_donation'] < 100)
						{
							echo '<a href="payments/pay/'.$payment['fee_id'].'">'.$this->lang->line('pay').'</a>';
						}
						else if($payment['part_of_donation'] == 100 && (!$payment['is_paid']))
						{
							echo "Pending";
						}
						else if($payment['part_of_donation'] == 100 && $payment['is_paid'])
						{
							$payment['status'];
						}
							 ?>
                    </td>
                    <?php if (isset($payment['name'])){?>
                    <td><?= $payment['name']?></td>
                    <?php }?>
                    <td><?= $payment['is_paid']?date('d M Y h:i:s A',strtotime($payment['payment_date'])):'Not paid yet'?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer_web') ?>