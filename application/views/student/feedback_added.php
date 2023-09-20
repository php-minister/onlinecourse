<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $this->lang->line('feedback_added')?></div>
<script>
    $('document').ready(function(){
        $("#rating").raty({score:$("input[name=score]").val(),cancel:false,readOnly:true});
        $("#comment_area").html($("#comment").val());
        calendar.changeAttribute('<?= $lesson['date']?>',<?= $lesson['scheduling_id']?>,'is_commented',1);
    })
</script>