<!-- Guess user timezone --> 
<script>
    $(function () {
        $('#timezone option[value="'+moment.tz.guess()+'"]').attr("selected", "selected");
    })
</script>