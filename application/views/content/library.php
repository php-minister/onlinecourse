<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('library'),'forms'=>TRUE,'tables'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'students'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  }); 
  
  function delete_item(item_id)
  {
      if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_item_')?>'))
      {
        ajax_query('content/delete_library_item/'+item_id,'',function(){
            delete_row(item_id,'<?= $this->lang->line('item_deleted')?>');
        });
     }
  }
</script>
<header>
    <h2><?= $this->lang->line('library')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="content/new_library_item" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_item')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('item')?></th>
                    <th><?= $this->lang->line('uploaded')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($library as $item){?>
                <tr entity_id="<?= $item['item_id']?>">
                    <td><?= $item['item_id']?></td>
                    <td><?= sprintf($template['item_name'],$item['item_extenstion'],$item['item_file'],$item['item_description'])?></td>
                    <td><?= date('d M Y h:i A',strtotime($item['uploaded']))?> <?= $this->lang->line('by')?> <?= $item['teacher_name']?></td>
                    <td><?= sprintf($template['item_actions'],$item['item_id'],$this->lang->line('edit_item'),$item['item_id'],$this->lang->line('delete_item'))?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer')?>