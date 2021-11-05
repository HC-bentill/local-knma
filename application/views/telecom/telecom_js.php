<script type="text/javascript">
    $('#area_council').change(function(){
    var area = $(this).val();
    //alert(classes);
    // AJAX request
    $.ajax({
        url:"<?php echo base_url().'Food/get_area_towns';?>",
        method: "POST",
        data: {area: area},
        dataType: "JSON",
        success: function(response){

            // Remove options
            $('#town').find('option').not(':first').remove();

            // Add options
            $.each(response,function(index,data){
                $('#town').append('<option value="'+data['id']+'">'+data['town']+'</option>');
            });
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("error");

        }
    });
});
</script>

<script type="text/javascript">
   $('#rating_mode').on('change',function(){
        if( $(this).val()==="fee_fixing"){
        $("#cat1_col").show()
        }
        else{
        $("#cat1_col").hide()
        $("#cat2_col").hide()
        $("#cat3_col").hide()
        $("#cat4_col").hide()
        $("#cat5_col").hide()
        $("#cat6_col").hide()
        }
    });
</script>
<script type="text/javascript">
   $('#cat1').on('change',function(){
        if( $(this).val() !== ""){
        $("#cat2_col").show()
        }
        else{
        $("#cat2_col").hide()
        }
    });
</script>

<script type="text/javascript">
   $('#cat2').on('change',function(){
        if( $(this).val() !== ""){
        $("#cat3_col").show()
        }
        else{
        $("#cat3_col").hide()
        }
    });
</script>

<script type="text/javascript">
   $('#cat3').on('change',function(){
        if( $(this).val() !== ""){
        $("#cat4_col").show()
        }
        else{
        $("#cat4_col").hide()
        }
    });
</script>

<script type="text/javascript">
   $('#cat4').on('change',function(){
        if( $(this).val() !== ""){
        $("#cat5_col").show()
        }
        else{
        $("#cat5_col").hide()
        }
    });
</script>

<script type="text/javascript">
   $('#cat5').on('change',function(){
        if( $(this).val() !== ""){
        $("#cat6_col").show()
        }
        else{
        $("#cat6_col").hide()
        }
    });
</script>
<script type="text/javascript">
   $('#rating_mode').on('change',function(){
        if( $(this).val()==="manual"){
        $("#manuall").show()
        }
        else{
        $("#manuall").hide()
        }
    });
</script>
<script>
  function delete_modal(id, code) {
    $('#code').html(code);
    $('#telecom_code').val(code);
    $('#telecom_id').val(id);
    jQuery('#delete_telecom_record').modal('show', {
      backdrop: 'static'
    });
  }
</script>