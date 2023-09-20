<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('teachers'),'forms'=>TRUE,'tables'=>TRUE,'date_picker'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'teachers'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "bProcessing": true,
         "bServerSide": true,
         "sAjaxSource": "teachers/data",
         "fnServerData": function ( sSource, aoData, fnCallback ) {
            aoData.push({"name":"deleted","value":show_deleted});
            $.getJSON( sSource, aoData, function (json) { fnCallback(json) } );
        },
         "aoColumns": [
            { "mData": "teacher_id" },
            { "mData": "name" },
			{ "mData": "ssn" },
			{ "mData": "ratings" },
            { "mData": "status" },
            { "mData": "actions"}
         ],
         "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            if (iMax==iTotal) 
            {
                return '<?= $this->lang->line('teachers_all')?>';
            }
            return '<?= $this->lang->line('teachers_filtered')?>';
         },
         "showAll":true,
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  }); 

function delete_teacher(teacher_id)
{
    if (confirm('<?= $this->lang->line('confirm_delete_teacher')?>'))
    {
        ajax_query('teachers/change_status/deleted/'+teacher_id,'',function(){
            delete_row(0,'<?= $this->lang->line('teacher_deleted')?>');
        });
    }    
}
</script>
<header>
    <h2><?= $this->lang->line('teachers')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="teachers/new_teacher" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_teacher')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('name')?></th>
                    <th><?= $this->lang->line('join_date')?></th>
                    <th>Rating</th>
                    <th><?= $this->lang->line('status')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="dataTables_empty alert-info"><?= $this->lang->line('loading_data_from_server')?></td>
                </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>