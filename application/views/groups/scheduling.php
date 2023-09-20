<?php $this->load->view('layout/header',array('page_title'=>sprintf($this->lang->line('scheduling'),$group['group_name']),'forms'=>TRUE,'calendar_new'=>TRUE)) ?>
<?php $this->load->view('admin/menu',array('active_menu'=>'students'))?>
<script>
    $('document').ready(function(){
        var calendar = $("#group_calendar").calendario({
            onDayClick : function($el,$contentEl,dateProperties) {
                                var events = calendar.getDate(dateProperties);
                                if (events)
                                {
                                    $("#group_scheduling .modal-body").html(events);
                                    $("#group_scheduling h3").html(dateProperties.day+' '+dateProperties.monthname+', '+dateProperties.weekdayname);
                                    $('#group_scheduling').modal('show');
                                }
                            },
            caldata:<?= $scheduling?>,
            weeks:[<?= $this->lang->line('weeks')?>],
            weekabbrs:[<?= $this->lang->line('weekabbrs')?>],
            months:[<?= $this->lang->line('months')?>],
            monthabbrs:[<?= $this->lang->line('monthabbrs')?>]
        });
    })
</script>
<section>
    <article>
          <div class="modal hide" id="group_scheduling" role="dialog" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3><?= $this->lang->line('date_events')?></h3>
              </div>
              <div class="modal-body"></div>
              <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal"><?= $this->lang->line('close')?></button>
              </div>
            </div>
            
          <div class="custom-calendar-wrap custom-calendar-full">
            <div class="custom-header">
                <h3 class="custom-month-year">
                    <span><?= $group['group_name']?>,</span>
                    <span id="custom-month" class="custom-month"></span>
                    <span id="custom-year" class="custom-year"></span>                    
                    <nav>
                        <span id="custom-prev" class="custom-prev"></span>
                        <span id="custom-next" class="custom-next"></span>
                        <span id="custom-current" class="custom-current"></span>
                    </nav>
                </h3>
                <div class="clearfix"></div>
            </div>
            <div id="group_calendar" class="fc-calendar-container"></div>
            <div class="clearfix"></div>
        </div>
    </article>
</section>
<?php $this->load->view('layout/footer')?>