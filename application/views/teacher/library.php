<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('my_files'),'forms'=>TRUE,'tables'=>TRUE,'magic_suggest'=>TRUE));?>
<?php $this->load->view('teacher/menu',array('active_menu'=>'files'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  }); 
  
  function delete_file(file_id)
  {
      if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_file_')?>'))
      {
        ajax_query('library/delete_file/'+file_id,'',function(){
            delete_row(file_id,'<?= $this->lang->line('file_deleted')?>');
        });
     }
  }
</script>
<header>
    <h2><?= $this->lang->line('my_files')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="library/new_file" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_file')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('file')?></th>
                    <th><?= $this->lang->line('uploaded')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($library as $item){?>
                <tr entity_id="<?= $item['item_id']?>">
                    <td><?= $item['item_id']?></td>
                    <td><?= sprintf($template['item_name'],$item['item_extenstion'],$item['item_file'],$item['item_description'])?></td>
                    <td><?= date('d M Y h:i A',strtotime($item['uploaded']))?></td>
                    <td><?= sprintf($template['item_actions'],$item['item_id'],$this->lang->line('edit_file'),$item['item_id'],$this->lang->line('delete_file'))?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer')?>