<script>
    function copyToClipboard(element) {
        console.log('s');
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
  }
  
</script>