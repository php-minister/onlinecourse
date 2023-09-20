<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('subjects'),'forms'=>TRUE,'tables'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'teachers'))?>
<script type="text/javascript">
  $('document').ready(function(){
      current_table=$('.dynamicTable').dataTable({
          "sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>
      });
  })
  
  function delete_subject(subject_id)
  {
      if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_subject_')?>'))
      {
        ajax_query('subjects/delete/'+subject_id,'',function(){
            delete_row(subject_id,'<?= $this->lang->line('subject_deleted')?>');
        });
     }
  }
</script>
<header>
    <h2><?= $this->lang->line('subjects')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="subjects/new_subject" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_subject')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('subject')?></th>
                    <th><?= $this->lang->line('teachers')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($subjects as $subject){?>
                <tr entity_id="<?= $subject['subject_id']?>">
                    <td><?= $subject['subject_id']?></td>
                    <td><?= $subject['name']?></td>
                    <td><?= $subject['teachers']?></td>
                    <td>
                        <a href="subjects/edit/<?= $subject['subject_id']?>" class="btn btn-mini" data-target="#waiting_for_response" data-toggle="modal" title="<?= $this->lang->line('edit')?>"><i class="icon-edit"></i></a>
                        <button class="btn btn-mini" onclick="delete_subject(<?= $subject['subject_id']?>)" title="<?= $this->lang->line('delete')?>"><i class="icon-remove"></i></button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>