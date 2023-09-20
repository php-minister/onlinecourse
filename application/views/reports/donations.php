<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('donations'),'forms'=>TRUE,'tables'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'reports'))?>
<script type="text/javascript">
    $('document').ready(function(){
      current_table=$('.dynamicTable').dataTable({
          "sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>,"aaSorting":[[0,"desc"]],
      });
    })
</script>
<header>
    <h2><?= $this->lang->line('donations')?></h2>
</header>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('donation')?></th>
                    <th>Source</th>
                    <th><?= $this->lang->line('date')?></th>
                    <th><?= $this->lang->line('donor')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($donations as $donation){?>
                <tr>
                    <td><?= $donation['donation_id']?></td>
                    <td>
                        <?= $currency?> <?= $donation['donation']?><br/>                       
                    </td>
                    <td> <i>
                        <?php if (is_null($donation['transaction_code'])){?>
                        <?= 'Manual '.$donation['comment']?>
                        <?php }else{?>
                        <?= ucfirst($donation['source'])?>, <span class="wrapword"><?= $donation['transaction_code']?></span>
                        <?php }?>
                        </i></td>
                    <td><?= date('d M Y',strtotime($donation['donation_date']))?></td>
                    <td><?= $donation['name']?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer') ?>