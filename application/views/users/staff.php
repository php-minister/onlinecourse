<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('staff'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'users'))?>
<script type="text/javascript">
  $('document').ready(function(){
      current_table=$('.dynamicTable').dataTable({"sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>
      });
  })
  
  function delete_staff(staff_id)
  {
      if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_employee_')?>'))
      {
        ajax_query('users/delete_staff/'+staff_id,'',function(){
            delete_row(staff_id,'<?= $this->lang->line('employee_deleted')?>');
        });
     }
  }
</script>
<header>
    <h2><?= $this->lang->line('staff')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="users/new_employee" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_employee')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('name')?></th>
                    <th><?= $this->lang->line('login')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($staff as $employee){?>
                <tr entity_id="<?= $employee['admin_id']?>">
                    <td><?= $employee['admin_id']?></td>
                    <td><?= $employee['admin_name']?></td>
                    <td><?= $employee['admin_login']?></td>
                    <td>
                        <a href="users/staff_edit/<?= $employee['admin_id']?>" class="btn btn-mini" data-target="#waiting_for_response" data-toggle="modal" title="<?= $this->lang->line('edit')?>"><i class="icon-edit"></i></a>
                        <button class="btn btn-mini" onclick="delete_staff(<?= $employee['admin_id']?>)" title="<?= $this->lang->line('delete')?>"><i class="icon-remove"></i></button>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>