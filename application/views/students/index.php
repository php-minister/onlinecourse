<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('students'),'forms'=>TRUE,'tables'=>TRUE,'magic_suggest'=>TRUE,'date_picker'=>TRUE,'calendar'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'students'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "bProcessing": true,
         "bServerSide": true,
         "sAjaxSource": "students/data",
         "fnServerData": function ( sSource, aoData, fnCallback ) {
            aoData.push({"name":"deleted","value":show_deleted});	
            $.getJSON( sSource, aoData, function (json) { fnCallback(json) } );
        }, 
         "aoColumns": [
            { "mData": "student_id" },
            { "mData": "name" },
			{ "mData": "total_fees" },
			{ "mData": "paid_fees" },
			{ "mData": "donors_name" },
			{ "mData": "parents_name" },
            { "mData": "status" },
            { "mData": "actions"}
         ],
         "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            if (iMax==iTotal) 
            {
                return '<?= $this->lang->line('students_all')?>';
            }
            return '<?= $this->lang->line('students_filtered')?>';
         },
         "showAll":true,
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  }); 

function delete_student(student_id)
{
    if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_student_')?>'))
    {
        ajax_query('students/change_status/deleted/'+student_id,'',function(){
            delete_row(0,'<?= $this->lang->line('student_deleted')?>');
        });
    }    
}
</script>
<header>
    <h2><?= $this->lang->line('students')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="students/new_student" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_student')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('name')?></th>
                    <th><?= $this->lang->line('total_student_fees')?></th>
                    <th><?= $this->lang->line('paid_fees')?></th>
                    <th><?= $this->lang->line('donors')?></th>
                    <th><?= $this->lang->line('parents')?></th>
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