<script type="text/javascript">
    $('#area_council').change(function(){
    var area = $(this).val();
    //alert(classes);
    // AJAX request
    $.ajax({
        url:"<?php echo base_url().'Residence/get_area_towns';?>",
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
  $(document).on('change','#nationality',function(){
    var state = $('#nationality').val();
    if(state == 'Non-Ghanaian'){
        document.getElementById("count").style.display = 'inline';
        document.getElementById("nat").style.display = 'inline';
        document.getElementById("idn").style.display = 'none';
        document.getElementById("idt").style.display = 'none';
    }
    else{
        document.getElementById("count").style.display = 'none';
        document.getElementById("nat").style.display = 'none';
        document.getElementById("idn").style.display = 'inline';
        document.getElementById("idt").style.display = 'inline';
    }
  });
</script>
<script type="text/javascript">
  $(document).on('change','#avai_of_water',function(){
    var state = $('#avai_of_water').val();
    if(state == 'No'){
        document.getElementById("water_no").style.display = 'inline';
        document.getElementById("water_yes").style.display = 'none';
    }
    else if(state == "Yes"){
        document.getElementById("water_no").style.display = 'none';
        document.getElementById("water_yes").style.display = 'inline';
    }else{
        document.getElementById("water_no").style.display = 'none';
        document.getElementById("water_yes").style.display = 'none';
    }
  });
</script>

<script type="text/javascript">
  $(document).on('change','#food_type',function(){
    var state = $('#food_type').val();
    if(state == 'Others'){
        document.getElementById("food_others").style.display = 'inline';
    }else{
        document.getElementById("food_others").style.display = 'none';
    }
  });
</script>
<script type="text/javascript">
  $(document).on('change','#medically_certified',function(){
    var state = $('#medically_certified').val();
    if(state == 'Yes'){
        document.getElementById("medical_yes").style.display = 'flex';
    }else{
        document.getElementById("medical_yes").style.display = 'none';
    }
  });
</script>
<script type="text/javascript">
    $("#btn1").click(function(){
        var validated = $('#basicformm').valid();
        if( validated ) {
            document.getElementById("basicformm").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#btn2").click(function(){
        var validated = $('#locform').valid();
        if( validated ) {
            document.getElementById("locform").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#btn3").click(function(){
        var validated = $('#propform').valid();
        if( validated ) {
            document.getElementById("propform").submit();
        }else{
            //alert("error")
        }
    })
</script>