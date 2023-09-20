<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('donors'),'forms'=>TRUE,'tables'=>TRUE,'date_picker'=>TRUE,'magic_suggest'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'students'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "bProcessing": true,
         "bServerSide": true,
         "sAjaxSource": "donors/data",
         "fnServerData": function ( sSource, aoData, fnCallback ) {
            aoData.push({"name":"deleted","value":show_deleted});
            $.getJSON( sSource, aoData, function (json) { fnCallback(json) } );
        },
         "aoColumns": [
            { "mData": "donor_id" },
            { "mData": "name" },
			{ "mData": "number_of_students" },	
			{ "mData": "total_donated" },
			{ "mData": "total_used" },
			{ "mData": "current_balance" },
            { "mData": "status" },		
            { "mData": "actions"}
         ],
         "fnInfoCallback": function( oSettings, iStart, iEnd, iMax, iTotal, sPre ) {
            if (iMax==iTotal) 
            {
                return '<?= $this->lang->line('donors_all')?>';
            }
            return '<?= $this->lang->line('donors_filtered')?>';
         },
         "showAll":true,
         "oLanguage":<?= $this->lang->line('datatables')?>
     });
  }); 

function delete_donor(donor_id)
{
    if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_donor_')?>'))
    {
        ajax_query('donors/change_status/deleted/'+donor_id,'',function(){
            delete_row(0,'<?= $this->lang->line('donor_deleted')?>');
        });
    }    
}
</script>
<header>
    <h2><?= $this->lang->line('donors')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="donors/new_donor" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_donor')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th> <?= $this->lang->line('name')?> </th>
                    <th> <?= $this->lang->line('number_of_students')?> </th>
                    <th> <?= $this->lang->line('total_donated')?> </th>
                    <th> <?= $this->lang->line('total_used')?> </th>
                    <th> <?= $this->lang->line('current_balance')?> </th>
                    <th> <?= $this->lang->line('status')?> </th>
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