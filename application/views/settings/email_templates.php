<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('email_templates'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'settings'))?>
<?php if ($this->config->item('language')!='english'){?>
<script src="js/nicedit/messages_<?= $this->config->item('language')?>.js"></script>
<?php }?>
<script src="js/nicEdit.js?ver=1.2"></script>
<script type="text/javascript">
  $('document').ready(function(){
     $('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>
     });
  });
</script>
<header>
    <h2><?= $this->lang->line('email_templates')?></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th><?= $this->lang->line('template_name')?></th>
                    <th><span class="hidden-phone"><?= $this->lang->line('actions')?></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($templates as $template){?>
                <tr>
                    <td><?= $template['template_name']?></td>
                    <td>
                        <a title="<?= $this->lang->line('edit')?>" data-target="#waiting_for_response" data-toggle="modal" class="btn btn-mini" href="settings/edit_email_template/<?= $template['template_id']?>"><i class="icon-edit"></i></a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>