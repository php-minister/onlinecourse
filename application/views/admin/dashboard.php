<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('dashboard'),'forms'=>TRUE ,'date_picker'=>TRUE , 'tables' => TRUE , 'page_name' => 'dashboard')) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'dashboard'))?>
<script type="text/javascript">
  $('document').ready(function(){
     current_table=$('.dynamicTable').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "oLanguage":<?= $this->lang->line('datatables')?>,
     });
	 
     current_table=$('.dynamicTable1').dataTable({
         "sPaginationType": "full_numbers",
         "bAutoWidth": false,
         "bLengthChange": false,
         "oLanguage":<?= $this->lang->line('datatables')?>,
         "aaSorting": [[0, "desc" ]],		 
     });	 
	 
  }); 
</script>


<header>
    <h1>Dashboard</h1>
</header>
<header>
    <h3>Latest Registered Students</h3>
</header>

<section  class="dashboard_pending_fees">
    <article>
        <table class="dynamicTable1 table-bordered table table-condensed table-hover">
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
                    <td><span><?= $registration['registration_status']?></span><?= $this->lang->line($registration['registration_status'])?></td>
                    <td>
                        <a  class="btn btn-mini" title="<?= $this->lang->line('view_details')?>" href="registrations/view/<?= $registration['registration_id']?>" data-target="#waiting_for_response" data-toggle="modal"><i class="icon-search"></i></a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </article>
</section>


<header>
    <h3>Pending/Upcoming Fees</h3>
</header>
<section class="dashboard_pending_fees">
    <article>
        <table class="dynamicTable table-bordered table table-condensed table-hover">
            <thead>
                <tr>
                    <th>Fees id</th>
                    <th><?= $this->lang->line('student')?></th>
                    <th><?= $this->lang->line('to_pay_by_student')?></th>
                    <th><?= $this->lang->line('to_pay_by_donor')?></th>
                    <th>Due Date</th>
                    <th><?= $this->lang->line('status')?></th>                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($payments as $payment){?>
                <tr>
                    <td><?= $payment['fee_id'] ?> </td>
                    <td><?= $payment['name'] ?> </td>
                    <td>
					<?php
                         if($payment['part_of_donation'])
                         {
                            $donor_amount = ($payment['amount'] * $payment['part_of_donation'])/ 100;
                            $student_fees = $payment['amount'] - $donor_amount;						
                         }
                         else
                         {
                             $donor_amount = 0;
                             $student_fees = $payment['amount'];
                         }
                          echo $student_fees;
                          
                          if($payment['is_paid']){ ?> <span class="icon-ok"></span> <?php }
                          ?>
                      </td>
                      <td>
					  	<?php echo $donor_amount;if($payment['donated_ids']){ ?> <span class="icon-ok"></span> <?php }?> 
                      </td>         
                      <td><?php echo date('d M Y',strtotime($payment['until'])); ?> </td>             
                    <td>
                       	<span class="due_date"><?  if(date('d M Y',strtotime($payment['until'])) >= date('d M Y' , time()))
						{ 
						echo "Upcoming"; }
						else{echo "Pending"; } ?></span>
                    </td>
                </tr>
                <?php 
					}
				?>
            </tbody>
        </table>
    </article>
</section>



<?php $this->load->view('layout/footer') ?>