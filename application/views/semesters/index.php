<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('semesters'),'forms'=>TRUE,'tables'=>TRUE,'date_picker'=>TRUE)) ?>
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

function delete_semester(semester_id)
{
    if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_semester_')?>'))
    {
        ajax_query('semesters/delete/'+semester_id,'',function(){
            delete_row(semester_id,'<?= $this->lang->line('semester_deleted')?>');
        });
    }    
}
</script>
<header>
    <h2><?= $this->lang->line('semesters')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="semesters/new_semester" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_semester')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('name')?></th>
                    <th><?= $this->lang->line('start')?></th>
                    <th><?= $this->lang->line('end')?></th>
                    <th><?= $this->lang->line('actions')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($semesters as $semester){?>
                <tr entity_id="<?= $semester['semester_id']?>">
                    <td><?= $semester['semester_id']?></td>
                    <td><?= $semester['name']?></td>
                    <td><?= date('d M Y',strtotime($semester['start_date']))?></td>
                    <td><?= date('d M Y',strtotime($semester['end_date']))?></td>
                    <td>
                     <?php if ($semester['is_active']=='1'){?>
                     <a href="semesters/close" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini current_semester" title="<?= $this->lang->line('make_as_completed_and_calculate_final_scores')?>"><i class="icon-ok-sign"></i></a>
                     <?php }?>
                     <?php if ($semester['is_completed']=='0'){?>    
                        <a href="semesters/edit/<?= $semester['semester_id']?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_semester')?>"><i class="icon-edit"></i></a>
                        <button class="btn btn-mini" onclick="delete_semester(<?= $semester['semester_id']?>)" title="<?= $this->lang->line('delete_semester')?>"><i class="icon-remove"></i></button>
                     <?php }else{?>
                     <?= $this->lang->line('completed')?>
                     <?php }?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>