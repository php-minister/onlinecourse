<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('incidents'),'forms'=>TRUE,'tables'=>TRUE, 'page_name' => 'Students' )) ?>
<?php $this->load->view('student/menu',array('active_menu'=>'incidents'))?>
<script type="text/javascript">
    $('document').ready(function(){
       $(".full_details").click(function(){
          $(this).prev().toggle();
          $(this).find('i')
            .toggleClass('icon-chevron-up')
            .toggleClass('icon-chevron-down');
          $('span.expand_details').toggle();
       });
       
       $('.dynamicTable').dataTable({"sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>});
    });
</script>
<!--<header>
    <h2><?= $this->lang->line('incidents')?></h2>
</header>-->
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->lang->line('date')?></th>
                    <th><?= $this->lang->line('details')?></th>
                    <th><?= $this->lang->line('response')?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($incidents as $incident){?>
                <tr>
                    <td><?= $incident['incident_id']?></td>
                    <td><?= date('d M Y',strtotime($incident['date']))?></td>
                    <td style=" text-align:left"> 
                        <?php if ((strlen($incident['full_details'])>150)){?>
                        <?= substr($incident['full_details'],0,80)?><span class="expand_details">...</span>
                        <span class="more_text">
                          <?= substr($incident['full_details'],80,strlen($incident['full_details']))?>  
                        </span>
                        <button type="button" class="btn btn-mini full_details">
                            <i class="icon-chevron-down"></i>
                            <span class="expand_details"><?= $this->lang->line('read_more')?></span>
                            <span style="display: none;" class="expand_details"><?= $this->lang->line('hide')?></span>
                        </button>
                        <?php }else{?>
                        <?= $incident['full_details']?>
                        <?php }?>
                    </td>
                    <td style=" text-align:left">
                        
						<?php if ((strlen($incident['response'])>150)){?>
                        <?= substr($incident['response'],0,80)?><span class="expand_details">...</span>
                        <span class="more_text">
                          <?= substr($incident['response'],80,strlen($incident['response']))?>  
                        </span>
                        <button type="button" class="btn btn-mini full_details">
                            <i class="icon-chevron-down"></i>
                            <span class="expand_details"><?= $this->lang->line('read_more')?></span>
                            <span style="display: none;" class="expand_details"><?= $this->lang->line('hide')?></span>
                        </button>
                        <?php }else{?>
                        <?= $incident['response']?>
                        <?php }?>
                                            
                    </td>
                    
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer_web')?>