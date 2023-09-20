<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('classrooms'),'forms'=>TRUE,'tables'=>TRUE)) ?>
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

function delete_classroom(classroom_id)
{
    if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_classroom_')?>'))
    {
        ajax_query('classrooms/delete/'+classroom_id,'',function(){
            delete_row(classroom_id,'<?= $this->lang->line('classroom_deleted')?>');
        });
    }    
}
</script>
<header>
    <h2><?= $this->lang->line('classrooms')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="classrooms/new_classroom" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_classroom')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('classroom')?></th>
                    <th><?= $this->lang->line('is_shared')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($classrooms as $classroom){?>
                <tr entity_id="<?= $classroom['room_id']?>">
                    <td><?= $classroom['room_id']?></td>
                    <td><?= $classroom['name']?></td>
                    <td><?= $classroom['is_shared']?$this->lang->line('yes'):$this->lang->line('no')?></td>
                    <td>
                        <a href="classrooms/edit/<?= $classroom['room_id']?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_classroom')?>"><i class="icon-edit"></i></a>
                        <a  class="btn btn-mini" title="<?= $this->lang->line('classroom_scheduling')?>" href="classrooms/scheduling/<?= $classroom['room_id']?>"><i class="icon-calendar"></i></a>
                        <button class="btn btn-mini" onclick="delete_classroom(<?= $classroom['room_id']?>)" title="<?= $this->lang->line('delete_classroom')?>"><i class="icon-remove"></i></button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>