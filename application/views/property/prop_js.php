<script type="text/javascript">
    $('#edit').click(function(){
      $("#basicformm :input").prop("disabled", false);
      document.getElementById("btnn").disable == false;
      document.getElementById("edit_f").style.display = "none";
      document.getElementById("view_f").style.display = "block";
    });
</script>
<script type="text/javascript">
    $('#view').click(function(){
      $("#basicformm :input").prop("disabled", true);
      document.getElementById("btnn").disable == true;
      document.getElementById("edit_f").style.display = "block";
      document.getElementById("view_f").style.display = "none";
    });
</script>
<script type="text/javascript">
$("#tags").select2({
    maximumSelectionLength: 5
});
</script>
<script type="text/javascript">
$("#btnn").click(function(){
    var validated = $('#basicformm').valid();
    if( validated ) {
        document.getElementById("basicformm").submit();
    }else{
        //alert("error")
    }
})
</script>
<script type="text/javascript">
	function property(){
		var prop = document.getElementById("property_type").value;
		//alert(prop);
		if( prop !== "Compound"){
			$('#floor').fadeIn('slow');
		}else{
			$('#floor').fadeOut('slow');
		}
	}
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
    $('#owner_native').change(function(){
        var state = $('#owner_native').val();

        if(state == "No" || state == "Yes, Does not Reside In Property And In District"){
            $('.owner_reside').fadeOut('slow');
            $('.owner_reside_not').fadeIn('slow');
        }else if(state == "Yes, Does not Reside In Property"){
            $('.owner_reside').fadeIn('slow');
            $('.owner_reside_not').fadeOut('slow');
        }else{
            $('.owner_reside').fadeOut('slow');
            $('.owner_reside_not').fadeOut('slow');
        }
    });
</script>
<script type="text/javascript">
    function do_checks(){
        if(document.getElementById("religion").value == "Others"){
            document.getElementById("others").style.display ="inline";
        }
        if(document.getElementById("owner_native").value == "No" || document.getElementById("owner_native").value == "Yes, Does not Reside In Property And In District"){
            $('.owner_reside_not').css('display','inline');
            $('.owner_reside').css('display','none');
        }else{
            $('.owner_reside_not').css('display','none');
            $('.owner_reside').css('display','inline');
        }

        var area = $("#owner_area_council").val();
        var town = $("#owner_townn").val();
        //alert(area);
        //alert(clas"ses);
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
                $('[name=owner_town] option').filter(function() {
                    return ($(this).val() == town);
                }).prop('selected', true);
            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });
    }
</script>
 
