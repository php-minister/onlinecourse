<?php $this->load->view('layout/header_web',array('page_title'=>$this->lang->line('scheduler'),'calendar_new'=>TRUE,'forms'=>TRUE , 'page_name' => 'Students' , 'page_style' => 'students_home')) ?>

<div id="student_schedule_page">
<?php $this->load->view('student/menu',array('active_menu'=>'scheduler'))?>
<script>
    var calendar;
    $('document').ready(function(){
         calendar = $('#student_calendar_new').calendario({
                        /*onDayClick : function($el,$contentEl,dateProperties) {                          
						    var events = calendar.getDate(dateProperties);
						    if (events)
                            {
                                $("#day_scheduling .modal-body").html(events);
                                $("#day_scheduling h3").html(dateProperties.day+' '+dateProperties.monthname+', '+dateProperties.weekdayname);
                                $('#day_scheduling').modal('show');
                            }
                        },*/
                        afterEventTitleRender:function(event,date){
                          return (new Date()>new Date(date+' '+event.end))?('&nbsp;&nbsp;&nbsp;<a href="student/left_comment/'+event.id+'" class="btn btn-mini '+(event.is_commented=='0'?'btn-info':'')+'" onclick="$(\'#day_scheduling\').modal(\'hide\')" data-target="#waiting_for_response" data-toggle="modal" title="<?= $this->lang->line('leave_feedback')?>"><span class="icon-thumbs-up '+(event.is_commented=='0'?'icon-white':'')+'"></span></a>'):'';
                        },
                        caldata : <?= $scheduling?>,
                        weeks:[<?= $this->lang->line('weeks')?>],
                        weekabbrs:[<?= $this->lang->line('weekabbrs')?>],
                        months:[<?= $this->lang->line('months')?>],
                        monthabbrs:[<?= $this->lang->line('monthabbrs')?>]

		   })						


function fomartTimeShow(h_24 , mins) {
    var h = h_24 % 12;
    if (h === 0) h = 12;
    return (h < 10 ? "0" + h : h) + ":" +mins +'  '+(h_24 < 12 ? 'am' : 'pm');
}
			$('.trigger_class').click(function(){
				var schedule_id = $(this).attr('id');
				var web_url ='<?= $this->config->item('base_url')?>student/get_particular_schedule/'+schedule_id;

					 $.ajax({ // ajax call starts
							  url: web_url,
							  type: 'post',
							  //data: 'button=' + $(this).val(), // Send value of the clicked button
							  dataType: 'json', // Choosing a JSON datatype
							  success: function(data) // Variable data contains the data we get from serverside
							  {
								  var i=0;
								  dates = '';
								  ul_content = '';
								var comment = '';
								teacher_data  = data[i].title.split('{|}')[1];
								by_teacher = teacher_data.split(' in ')[0];
								
								//var comment = '<a href="student/left_comment/'+data[i].id+'" class="btn btn-mini '+(data[i].is_commented=='0'?'btn-info':'')+'" onclick="$(\'#day_scheduling\').modal(\'hide\')" data-target="#waiting_for_response" data-toggle="modal" title="<?= $this->lang->line('leave_feedback')?>"><span class="icon-thumbs-up '+(data[i].is_commented=='0'?'icon-white':'')+'"></span></a>';
								dates +='<li class="event even"> <div class="time"> From &nbsp;'+fomartTimeShow(data[i].start_time.split(':')[0] , data[i].start_time.split(':')[1])+' To '+fomartTimeShow(data[i].end_time.split(':')[0] , data[i].end_time.split(':')[1])+'</div><div class="title">';
								dates += '<span class="subject_head">';
								dates += '<div class="head_container"><span class="heading_sub">Subject : </span><span class="subject_data">';
								dates += data[i].title.split('{|}')[0] +'</span></div>';
								dates+= '<div class="head_container"><span class="heading_sub">Teacher :  </span>'+by_teacher;
								dates +='</span></div>';                       
								 dates +='</div><div class="clearfix"></div><p class="description"><?= $this->lang->line('leave_feedback')?> &nbsp;&nbsp;<a href="student/left_comment/'+data[i].id+'" class="btn btn-mini '+(data[i].is_commented=='0'?'btn-info':'')+'" onclick="$(\'#day_scheduling\').modal(\'hide\')" data-target="#waiting_for_response" data-toggle="modal" title="<?= $this->lang->line('leave_feedback')?>"><span class="icon-thumbs-up '+(data[i].is_commented=='0'?'icon-white':'')+'"></span></a></p></li>';
								 ul_content = '<ul class="day_events student_class_detail">'+dates+'</ul>';
								var ful_date = data[i].date; 
								var date_array = ful_date.split('-');										 								
								//var d = new Date(date_array[2], date_array[0], date_array[1], 00, 00, 00, 00)
								var a = moment([date_array[2],date_array[0], date_array[1], 0, 0, 0, 0]);
								date_event = a.format('MMMM  DD YYYY');

								 $("#day_scheduling .modal-body").html(ul_content);
                                $("#day_scheduling h3").html(date_event);
								
                                $('#day_scheduling').modal('show');										 

							  }
						  });				
				
				//ajax function ends
			})	
	   
    });
</script>
<?php
$scheduling_data = json_decode($scheduling);
//echo $scheduling_data[0]->class_attend_url;
?>

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
        
        <h3 class="schedule_heading" style="text-align:center"><span class="monthly_schedule_heading"> Your Monthly Schedule</span> <?php if(!empty($scheduling_data[0]->class_attend_url)){?>  <a class="attend_class" href="<?php echo $scheduling_data[0]->class_attend_url; ?>" target="_blank"> Click here to attend class</a><?php } ?></h3>
        <div class="custom-calendar-wrap custom-calendar-full">
            <div class="custom-header">
                <h3 class="custom-month-year" style="width:100%; text-align:center">
                    <span id="custom-month" class="custom-month"></span>
                    <span id="custom-year" class="custom-year"></span>                    
                    <nav>
                        <span id="custom-prev" class="custom-prev"></span>
                        <span id="custom-next" class="custom-next"></span>
                        <span id="custom-current" class="custom-current"></span>
                    </nav>
						<a href="student/get_schedule" target="_blank" id="download_pdf" title="<?= $this->lang->line('download_pdf')?>">
							<img src="images/pdf.png" style="vertical-align:top;">
                        </a>                                        
                </h3>
                <div class="clearfix"></div>
            </div>
            <div id="student_calendar_new" class="fc-calendar-container"></div>
            <div class="clearfix"></div>
        </div>
    </article>
</section>

</div>
<?php $this->load->view('layout/footer_web')?>