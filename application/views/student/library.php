<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('library'),'forms'=>TRUE,'tables'=>TRUE ,'page_name' => 'Students' )) ?>
<?php $this->load->view('student/menu',array('active_menu'=>'library'))?>
<script>
    $('document').ready(function(){
        $('.dynamicTable').dataTable({"sPaginationType": "full_numbers","bAutoWidth": false,"bLengthChange": false,"oLanguage":<?= $this->lang->line('datatables')?>});
    })
</script>
    <h3 class="section_heading">My Library</h3>
<section>
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="align-left">Document</th>
                    <th>Description</th>
                    <th><?= $this->lang->line('uploaded')?></th>
                </tr>
            </thead>
            <tbody>
                <?php
				$i = 0;
				 foreach($library as $item){
							$type = $item['value'];
							if($type == '*')
							{
								continue;
							}
						$i++;	
					?>
                <tr>
                    <td><?= $i?></td>
                    <td>
                        <div class="pull-left margin_right_10 hidden-phone"><a href="student/download/<?= $item['item_id']?>"><img src="images/files/<?= $item['item_extenstion']?>.png"></a> <a href="student/download/<?= $item['item_id']?>" class="wrapword"><?= $item['item_file']?></a></div>                        
                    </td>
                    <td> <span class="pull-left"><i><?= $item['item_description']?></i></span></td>
                    <td>
                        <?= date('d M Y h:i A',strtotime($item['uploaded']))?>
                        <?= $this->lang->line('by')?> <?= $item['autor_name']?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>

<section style="margin-top:85px;">

    <h3 class="section_heading">Common Library</h3>

    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="align-left">Document</th>
                    <th> Description</th>
                    <th><?= $this->lang->line('uploaded')?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
				$i = 0;
				foreach($library as $item){
							$type = $item['value'];
							if($type != '*')
							{
								continue;
							}
						$i++;		
					?>
                <tr>
                    <td><?= $i?></td>
                    <td>
                        <div class="pull-left margin_right_10 hidden-phone"><a href="student/download/<?= $item['item_id']?>"><img src="images/files/<?= $item['item_extenstion']?>.png"></a> <a href="student/download/<?= $item['item_id']?>" class="wrapword"><?= $item['item_file']?></a></div>                        
                    </td>
                    <td> <span class="pull-left"><i><?= $item['item_description']?></i></span></td>
                    <td>
                        <?= date('d M Y h:i A',strtotime($item['uploaded']))?>
                        <?= $this->lang->line('by')?> <?= $item['autor_name']?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>
<?php $this->load->view('layout/footer_web')?>