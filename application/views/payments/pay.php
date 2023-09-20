<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('pay_fee'),'forms'=>TRUE)) ?>
<?php $this->load->view($this->session->userdata('person_type').'/menu',array('active_menu'=>'payments'))?>
<header>
    <h2><?= $this->lang->line('pay_fee')?></h2>
</header>
<section>
    <article>
        <?php if (count($fee)>0){?>
        <div id="save_result"></div>
        <form action="payments/process_payment/" id="process_payment" method="POST">
            <input type="hidden" id="fee_id" name="fee_id" value="<?= $fee_id?>">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td><?= $this->lang->line('fee_name')?>:</td>
                        <td><?= $fee[0]['fee_name']?></td>
                    </tr>
                    <?php if ($fee[0]['fee_description']){?>
                    <tr>
                        <td><?= $this->lang->line('fee_description')?>:</td>
                        <td><?= $fee[0]['fee_description']?></td>
                    </tr>
                    <?php }?>
                    
                    <?php if ($this->session->userdata('person_type')=='student'){?>
                    <tr>
                        <td><?= $this->lang->line('fee_amount')?>:</td>
                        <td><?= $currency?> <?= $fee[0]['amount']?><?php if ($fee[0]['part_of_donation']>0){ echo sprintf($this->lang->line('with_percent_donation'),$fee[0]['part_of_donation']);}?></td>
                    </tr>
                    <?php }?>
                    
                    
                    <?php if ($this->session->userdata('person_type')=='parent'){?>
                    <tr>
                        <td><?= $this->lang->line('children')?>:</td>
                        <td>
                            <?php 
                            $total=0;
                            foreach($fee as $student){?>
                            <label>
                                <input type="checkbox" name="student[<?= $student['student_id']?>]" checked="checked"><?= $student['name']?> &nbsp;&nbsp; <?= $currency?>
                                <?= $student['amount']?>
                                <?php if ($student['part_of_donation']>0){ echo sprintf($this->lang->line('with_percent_donation'),$student['part_of_donation']);}?>
                            </label>
                            <?php 
                            $total+=$student['amount'];
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= $this->lang->line('fee_sum')?>:</td>
                        <td><?= $currency?> <?= $total?></td>
                    </tr>
                    <?php }?>
                    
                    <tr>
                        <td><?= $this->lang->line('until')?>:</td>
                        <td><?= date('d M Y',strtotime($fee[0]['until']))?></td>
                    </tr>
                    <tr>
                        <td><label for="payment_method"><?= $this->lang->line('payment_method')?><sup class="mandatory">*</sup></label></td>
                        <td>
                        <select id="payment_method" name="payment_method" class="required">
                        <?php
                             $active_payments=explode(',',$active_payments);
                         ?>
                            <?php foreach($active_payments as $method){?>
                            <option value="<?= $method?>"><?= ucfirst($method)?></option>
                            <?php }?>
                        </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php if ($fee[0]['is_subscription']=='1'){?>
            <input type="hidden" id="is_subscription" name="is_subscription" value="off">
            <?php }?>
        </form>
        <button class="btn <?= ($fee[0]['is_subscription']=='0'?'btn-info':'')?>" type="button" onclick="submit_form('#process_payment')"><?= $this->lang->line('pay')?></button>
        <?php if ($fee[0]['is_subscription']=='1'){?>
        <button class="btn btn-info" type="button" onclick="$('#is_subscription').val('on');submit_form('#process_payment')"><?= $this->lang->line('pay_and_subscribe')?></button>
        <?php }?>
        <?php }else{?>
        <div class="alert alert-info"><?= $this->lang->line('fee_not_found')?></div>
        <?php }?>
    </article>
</section>
<?php $this->load->view('layout/footer_web') ?>