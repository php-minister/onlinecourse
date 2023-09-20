<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('donate'), 'page_name' => 'Donor', 'forms'=>TRUE,'tables'=>TRUE)); ?>
<?php $this->load->view('donor/menu',array('active_menu'=>'donate'))?>
<script type="text/javascript">
    $('document').ready(function(){
       $('.dynamicTable').dataTable({"sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>});
    });
</script>
<!--<header>
    <h2><?= $this->lang->line('donate')?></h2>
</header>-->
<section>
    <article>
        <?php if (isset($payment_error)){?>
        <div class="alert alert-error"><?= $payment_error?></div>
        <?php }?>
        <?php if (isset($payment_success)){?>
        <div class="alert alert-info"><?= $payment_success?></div>
        <?php }?>
        <form action="donor/make_donation" method="POST" id="make_donation_form">
            <div id="save_result"></div>
            <div class="clearfix"></div>
            <div class="pull-left margin_right_10">
                <label for="amount"><?= $this->lang->line('amount')?><sup class="mandatory">*</sup></label>
                <div class="input-prepend control-group">
                  <span class="add-on"><?= $currency?></span>
                  <input type="text" name="amount" id="amount" class="required digits" value="<?php echo trim($amount_pay); ?>" />
                </div>
            </div>
            <div class="control-group pull-left margin_right_10">
                <label for="payment_method"><?= $this->lang->line('payment_method')?><sup class="mandatory">*</sup></label>
                <select id="payment_method" name="payment_method" class="required">
                <?php
                     $active_payments=explode(',',$active_payments);
                 ?>
                    <?php foreach($active_payments as $method){?>
                    <option value="<?= $method?>"><?= ucfirst($method)?></option>
                    <?php }?>
                </select>
            </div>
            <div class="pull-left">
                <label class="hidden-phone hidden-tablet">&nbsp;</label>
                <button class="btn btn-info" type="button" onclick="submit_form('#make_donation_form')"><?= $this->lang->line('donate')?></button>
            </div>
            <div class="clearfix"></div>
        </form>
        <div class="clearfix" style="margin-bottom: 10px;"></div>
        
     <div id="donation_container">   
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('donation')?></th>
                    <th><?= $this->lang->line('donation_date')?></th>
                    <th><?= $this->lang->line('source')?></th>
                    <th><?= $this->lang->line('status')?></th>
                    <th>Transaction Code</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($donations as $donation){?>
                <tr>
                    <td><?= $donation['donation_id']?></td>
                    <td><?= $currency?> <?= $donation['donation']?></td>
                    <td><?= date('d M Y',strtotime($donation['donation_date']))?></td>
                    <td>
                        <?php if (is_null($donation['source'])){?>
                        <?= $this->lang->line('manual')?> 
                        <?php }else{?>
                        <?= ucfirst($donation['source'])?>
                        <?php }?>
                    </td>
                    <td>
                    <?php if (is_null($donation['source'])){?>
                        <?= $this->lang->line('paid')?> <?= $donation['comment']?>
                        <?php }else{ ?>
                       <?php echo   $donation['status'];
						}
					   ?>
                    </td>
                    <td><span class="wrapword"> <? if($donation['transaction_code']){ echo $donation['transaction_code']; }else{ echo "-";}?></span>                    </td>                    
                </tr>
            <?php }?>
            </tbody>
        </table>
      </div>          
    </article>
</section>

<?php $this->load->view('layout/footer_web')?>