<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('groups'),'forms'=>TRUE,'tables'=>TRUE)) ?>
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

function delete_group(group_id)
{
    if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_group_')?>'))
    {
        ajax_query('students_groups/delete/'+group_id,'',function(){
            delete_row(group_id,'<?= $this->lang->line('group_deleted')?>');
        });
    }    
}
</script>
<header>
    <h2><?= $this->lang->line('groups')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="students_groups/new_group" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_group')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('group')?></th>
                    <th><?= $this->lang->line('actions')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($groups as $group){?>
                <tr entity_id="<?= $group['group_id']?>">
                    <td><?= $group['group_id']?></td>
                    <td><?= $group['group_name']?> (<?= $group['name']?>)</td>
                    <td>
                        <a href="students_groups/edit/<?= $group['group_id']?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_group')?>"><i class="icon-edit"></i></a>
                        <a  class="btn btn-mini" title="<?= $this->lang->line('group_scheduling')?>" href="students_groups/scheduling/<?= $group['group_id']?>"><i class="icon-calendar"></i></a>
                        <button class="btn btn-mini" onclick="delete_group(<?= $group['group_id']?>)" title="<?= $this->lang->line('delete_group')?>"><i class="icon-remove"></i></button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>