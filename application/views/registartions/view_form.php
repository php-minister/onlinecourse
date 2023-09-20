<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('registrations'),'forms'=>TRUE,'tables'=>TRUE,'date_picker'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'school'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "oLanguage":<?= $this->lang->line('datatables')?>,
         "aaSorting": [[0, "desc" ]],
     });
  }); 
</script>
<header>
    <h2><?= $this->lang->line('form')?>: <small><?= $form['form_name']?></small></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('student')?></th>
                    <th><?= $this->lang->line('phone_num')?></th>
                    <th><?= $this->lang->line('time_call')?></th>
                    <th><?= $this->lang->line('student_country')?></th>
                    <th><?= $this->lang->line('learning_language')?></th>
                    <th><?= $this->lang->line('status')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($registrations as $registration){?>
                <tr entity_id="<?= $registration['registration_id']?>">
                    <td><?= $registration['registration_id']?></td>
                    <td><?= $registration['student_name']?>, <?= $this->lang->line('at')?> <?= date('d M Y',strtotime($registration['registation_date']))?> <?= ($registration['last_comment'])?(','.$registration['last_comment']):''?></td>
                    <td><?= $registration['student_phone'];?></td>
                    <td><?= $registration['best_time_to_call']; ?> </td>
                    <td><?= $registration['country']; ?></td>
                    <td><?= $registration['prefered_language']; ?></td>
                    <td><span style="display: none;"><?= $registration['registration_status']?></span><?= $this->lang->line($registration['registration_status'])?></td>
                    <td>
                        <a  class="btn btn-mini" title="<?= $this->lang->line('view_details')?>" href="registrations/view/<?= $registration['registration_id']?>" data-target="#waiting_for_response" data-toggle="modal"><i class="icon-search"></i></a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>