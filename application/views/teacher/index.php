<?php $this->load->view('layout/header',array('page_title'=>$this->lang->line('teacher_s_dashboard'),'forms'=>TRUE,'calendar_new'=>TRUE,'date_picker'=>$settings['teacher_manage_own_subjects']=='on','magic_suggest'=>$settings['teacher_manage_own_subjects']=='on'))?>
<link rel="stylesheet" type="text/css" href="css/bootstrap-timepicker.min.css"> 
<script src="js/bootstrap-timepicker.min.js"></script>
<?php $this->load->view('teacher/menu',array('active_menu'=>'teacher'))?>
<script>
    var calendar;
    $('document').ready(function(){
        calendar = $('#teacher_calendar').calendario({			
                        onDayClick : function($el,$contentEl,dateProperties) {
                            var events = calendar.getDate(dateProperties);
                            if (events)
                            {
                                $("#day_scheduling .modal-body").html(events);
                                $("#day_scheduling h3").html(dateProperties.day+' '+dateProperties.monthname+', '+dateProperties.weekdayname);
                                $('#day_scheduling').modal('show');
                            }
                        },
                        afterEventTitleRender:function(event,date){
                          return '&nbsp;&nbsp;<a href="teacher/view_lesson_reminders/'+event.id+'" class="btn btn-mini" onclick="$(\'#day_scheduling\').modal(\'hide\')" data-target="#waiting_for_response" data-toggle="modal" title="<?= $this->lang->line('view_reminders')?>"><span class="icon-info-sign"></span></a>'; 
						  
                        },
                        caldata : <?= $scheduling?>,
                        url_template:'teacher/edit_lesson/{{event_id}}',
                        weeks:[<?= $this->lang->line('weeks')?>],
                        weekabbrs:[<?= $this->lang->line('weekabbrs')?>],
                        months:[<?= $this->lang->line('months')?>],
                        monthabbrs:[<?= $this->lang->line('monthabbrs')?>]
                    });
        <?php if ($settings['teacher_manage_own_subjects']=='on'){?>
        $('.custom-header .custom-month-year').after('<a style="padding-top:10px; display:block;" href="teacher/get_schedule" target="_blank" id="download_pdf" title="<?= $this->lang->line('download_pdf')?>"><img src="images/pdf.png" style="vertical-align:top;"></a>');
        <?php }?>
    });	
</script>

<section>
    <article>
        <div class="modal hide" id="day_scheduling" role="dialog" aria-hidden="true">
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
            <div id="teacher_calendar" class="fc-calendar-container"></div>
            <div class="clearfix"></div>
        </div>
    </article>
</section>
<?php $this->load->view('layout/footer')?>