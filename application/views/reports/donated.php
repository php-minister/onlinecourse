<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('donated'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'reports'))?>
<script type="text/javascript">
    $('document').ready(function(){
      current_table=$('.dynamicTable').dataTable({
          "sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>,"aaSorting":[[0,"desc"]],
      });
    })
</script>
<header>
    <h2><?= $this->lang->line('donated')?></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('student')?></th>
                    <th><?= $this->lang->line('donor')?></th>
                    <th><?= $this->lang->line('payment')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($donated as $donation){?>
                    <tr>
                        <td><?= $donation['donate_id']?></td>
                        <td><?= $donation['student_name']?></td>
                        <td><?= $donation['donor_name']?></td>
                        <td>
                            <?= $currency?> <?= $donation['donated']?><?= $this->lang->line('of')?><?= $donation['fee_amount']?><br/>
                            <i><?= $this->lang->line('at')?><?= date('d M Y',strtotime($donation['date']))?><?= $this->lang->line('for')?><?= $donation['fee_name']?></i>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>