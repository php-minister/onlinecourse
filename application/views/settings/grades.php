<script src="js/jquery-ui-1.10.2.custom.min.js"></script>
<script>
    var grades=<?= count($grades)?>;
    $('document').ready(function(){
        $("#new_grade").click(function(){
            grades++;    
            $('#grades').append('<li id="'+grades+'"><div class="control-group pull-left margin_right_10"><span>#'+($("#grades li").length+1)+'</span><input type="text" name="grade['+grades+']" class="required "></div><div class="pull-left" style="padding-top: 3px;"><button class="btn btn-mini visible-phone" type="button" onclick="$(this).parent().parent().insertAfter($(this).parent().parent().next());update_order();"><i class="icon-chevron-down"></i></button><button class="btn btn-mini" type="button" onclick="$(this).parent().parent().remove();update_order()"><i class="icon-remove"></i></button></div><div class="clearfix"></div><hr/></li>');
        })
        
        $("#grades").sortable({
            update:function()
            {
                update_order();
            }
        });
        $("#grades").disableSelection();
    })
    
    function update_order()
    {
       $("#save_result").html('<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('position_changed')?></div>');
       $('#grades li').each(function(index){
           $(this).find('span').html('#'+(index+1));
       })
    }
</script>
<style>
    #grades li:hover{cursor: move;}
</style>
<div class="modal show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3><?= $this->lang->line('active_grades')?></h3>
    </div>
    <div class="modal-body" style="max-height: 400px;">
        <div id="save_result"></div>
        <form action="settings/save_grades" method="POST" id="grades_form">
            <ul id="grades" class="unstyled">
            <?php  foreach($grades as $index=>$grade){ ?>
                <li id="<?= $grade['grade_id']?>">
                    <div class="control-group pull-left margin_right_10">
                        <span>#<?= $index+1?></span>
                        <input type="text" name="grade[<?= $grade['grade_id']?>]" value="<?= $grade['name']?>" class="required ">
                    </div>
                    <div class="pull-left" style="padding-top: 3px;">
                        <button class="btn btn-mini visible-phone" type="button" onclick="$(this).parent().parent().insertAfter($(this).parent().parent().next());update_order();"><i class="icon-chevron-down"></i></button>
                        <button class="btn btn-mini" type="button" onclick="$(this).parent().parent().remove();update_order()"><i class="icon-remove"></i></button>
                    </div>
                    <div class="clearfix"></div>
                    <hr/>
                </li>
            <?php }?>
            </ul>
        </form>
        <button class="btn btn-info" id="new_grade" type="button"><?= $this->lang->line('new_grade')?></button>
    </div>
    <div class="modal-footer">
        <button onclick="$('#waiting_for_response').modal('hide');" class="btn"><?= $this->lang->line('close')?></button>
        <button onclick="submit_form('#grades_form')" class="btn btn-info"><?= $this->lang->line('save')?></button>
    </div>
</div>