
<script type="text/javascript">
    var maxLength = 100;
    $('#send_pre_msg').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').html(textlen);


    });
</script>