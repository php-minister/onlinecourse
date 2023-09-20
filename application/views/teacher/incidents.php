<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('incidents'),'forms'=>TRUE,'tables'=>TRUE,'magic_suggest'=>TRUE,'date_picker'=>TRUE));?>
<?php $this->load->view('teacher/menu',array('active_menu'=>'incidents'))?>
<script type="text/javascript">
  $('document').ready(function(){
      current_table=$('.dynamicTable').dataTable({
          "sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>
      });
  })
  
  function delete_incident(incident_id)
  {
      if (confirm('<?= $this->lang->line('are_you_sure_want_delete_this_incident_')?>'))
      {
          ajax_query('teacher/delete_incident/'+incident_id,'',function(){
            delete_row(incident_id,'<?= $this->lang->line('incident_deleted')?>');
          });
      }    
  }
</script>
<header>
    <h2><?= $this->lang->line('incidents')?>&nbsp;&nbsp;<a data-target="#waiting_for_response" data-toggle="modal" href="teacher/new_incident" class="btn btn-info"><i class="icon-plus icon-white"></i> <?= $this->lang->line('add_incident')?></a></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('date')?></th>
                    <th><?= $this->lang->line('details')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($incidents as $incident){?>
                <tr entity_id="<?= $incident['incident_id']?>">
                    <td><?= $incident['incident_id']?></td>
                    <td><?= date('d M Y',strtotime($incident['date']))?></td>
                    <td style="width: 62%;">
                        <?= $incident['full_details']?>
                    </td>
                    <td>
                        <?php if ($incident['autor_id']==$this->session->userdata['person_id']){?>
                        <a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('edit_incident')?>" href="teacher/edit_incident/<?= $incident['incident_id']?>"><i class="icon-edit"></i></a>
                        <button onclick="delete_incident(<?= $incident['incident_id']?>)" title="<?= $this->lang->line('delete_incident')?>" class="btn btn-mini"><i class="icon-remove"></i></button>
                        <?php }else{?>
                        <a data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" title="<?= $this->lang->line('view_incident')?>" href="teacher/view_incident/<?= $incident['incident_id']?>"><i class="icon-zoom-in"></i></a>
                        <?php }?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </article>
</section>
<?php $this->load->view('layout/footer')?>