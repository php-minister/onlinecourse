<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('incidents'),'forms'=>TRUE,'tables'=>TRUE,'magic_suggest'=>TRUE,'date_picker'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'students'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "bProcessing": true,
         "bServerSide": true,
         "sAjaxSource": "incidents/data",
         "fnServerData": function ( sSource, aoData, fnCallback ) {
            aoData.push({"name":"deleted","value":show_deleted});
            $.getJSON( sSource, aoData, function (json) { fnCallback(json) } );
        },
         "aoColumns": [
            { "mData": "incident_id" },
            { "mData": "date" },
            { "mData": "detail" },
			{ "mData": "details" },
            { "mData": "actions"}
         ],
         "aaSorting": [[0,'desc']],
         "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            if (iMax==iTotal) 
            {
                return '<?= $this->lang->line('incidents_all')?>';
            }
            return '<?= $this->lang->line('incidents_filtered')?>';
         },
         "showAll":true,
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  }); 

function delete_incident(incident_id)
{
    if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_incident_')?>'))
    {
        ajax_query('incidents/delete/'+incident_id,'',function(){
            delete_row(0,'<?= $this->lang->line('incident_deleted')?>');
        });
    }    
}
</script>
<header>
    <h2><?= $this->lang->line('incidents')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="incidents/new_incident" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_incident')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('date')?></th>
                    <th><?= $this->lang->line('details')?></th>
                    <th><?= $this->lang->line('student_names')?></th>
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