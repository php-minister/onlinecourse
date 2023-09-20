<script>
    $('document').ready(function(){
        calendar.removeEvent(<?= $lesson_id?>);
        $("#waiting_for_response").modal("hide");
    })
</script>