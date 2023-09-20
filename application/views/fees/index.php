<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('fees'),'forms'=>TRUE,'tables'=>TRUE,'date_picker'=>TRUE,'magic_suggest'=>TRUE)) ?>
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
  
  function delete_fee(fee_id)
  {
      if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_fee_')?>'))
      {
        ajax_query('fees/delete/'+fee_id,'',function(){
            delete_row(fee_id,'<?= $this->lang->line('fee_deleted')?>');
        });
     }
  }
</script>
<header>
    <h2><?= $this->lang->line('fees')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="fees/new_fee" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_fee')?></a></h2>
    <i><?= sprintf($this->lang->line('all_sum_in'),$this->lang->line('currency_'.$currency))?></i>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('name')?></th>
                    <th><?= $this->lang->line('amount')?></th>
                    <th><?= $this->lang->line('actions')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($fees as $fee){?>
                <tr entity_id="<?= $fee['fee_id']?>">
                    <td><?= $fee['fee_id']?></td>
                    <td><?= $fee['fee_name']?></td>
                    <td><?= number_format($fee['amount'])?></td>
                    <td>
                        <a href="fees/edit/<?= $fee['fee_id']?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_fee')?>"><i class="icon-edit"></i></a>
                        <a href="fees/payers/<?= $fee['fee_id']?>" class="btn btn-mini" title="<?= $this->lang->line('view_payers')?>"><i class="icon-cog"></i></a>
                        <button class="btn btn-mini" onclick="delete_fee(<?= $fee['fee_id']?>)" title="<?= $this->lang->line('delete_fee')?>"><i class="icon-remove"></i></button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer')?>