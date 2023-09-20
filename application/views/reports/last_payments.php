<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('payments'),'forms'=>TRUE,'tables'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'reports'))?>
<script>
    var student;
    $('document').ready(function(){
        
        var payments=$('#payments').magicSuggest(magic_suggest_options({data:'fees/find_payment',name:'payment',maxSelection:1}));
        
        $(payments).on('selectionchange', function(event, combo, selection){
            if (selection[0].id)
            {
                $("#payments_area").html('<img src="images/ajax-loader.gif"');
                ajax_query('reports/get_payments/'+selection[0].id,'payments_area');
            }
        });
        
        $(student).on('focus',function(selection){
            selection.currentTarget.clear();
        })
    })
</script>
<header>
    <h2><?= $this->lang->line('payments')?></h2>
</header>
<section>
    <article>
        <label><?= $this->lang->line('select_fee')?></label>
        <input type="text" name="payments" id="payments" class="span4">
        <div id="payments_area" style="margin-top: 15px;">
            <table class="dynamicTable table-bordered table table-condensed table-hover">
                <thead>
                    <tr>
                        <th><?= $this->lang->line('student')?></th>
                        <th><?= $this->lang->line('fee')?></th>
                        <th>Amount</th>
                        <th>Source</th>                                                
                        <th>Date</th>                                                                        
                        <th><?= $this->lang->line('status')?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($payments as $payment){?>
                    <tr>
                        <td><?= $payment['student_name']?></td>
                        <td><?= $payment['fee_name']?></td>
                        <td><?= $currency?> <?= $payment['sum']?></td>
                        <td><?= ucfirst($payment['source'])?><span class="wrapword"><? if($payment['transaction_code']){ echo  ' ('.$payment['transaction_code'].')'; }?></span></td>
                        <td> <?= date('d M Y',strtotime($payment['payment_date']))?></td>
                        <td><?= $payment['status']?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>