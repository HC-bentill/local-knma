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
    $('#owner_area_council').change(function(){
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
            $('#owner_town').find('option').not(':first').remove();

            // Add options
            $.each(response,function(index,data){
                $('#owner_town').append('<option value="'+data['id']+'">'+data['town']+'</option>');
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
    $('#transportCat').change(function(){
    var transportCat = $(this).val();

    // AJAX request
    $.ajax({
        url:"<?php echo base_url().'Transport/get_transportSubCat';?>",
        method: "POST",
        data: {transportCat: transportCat},
        dataType: "JSON",
        success: function(response){

            // Remove options
            $('#transportSubCat').find('option').not(':first').remove();

            // Add options
            $.each(response,function(index,data){
                $('#transportSubCat').append('<option value="'+data['id']+'">'+data['subcategory']+'</option>');
            });
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert(errorThrown);

        }
    });
});
</script>
