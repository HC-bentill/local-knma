<script>
	$(document).ready(function(){
	
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

        var state1 = $('#avai_of_water').val();
        if(state1 == 'No'){
            document.getElementById("water_no").style.display = 'inline';
            document.getElementById("water_yes").style.display = 'none';
        }
        else if(state1 == "Yes"){
            document.getElementById("water_no").style.display = 'none';
            document.getElementById("water_yes").style.display = 'inline';
        }else{
            document.getElementById("water_no").style.display = 'none';
            document.getElementById("water_yes").style.display = 'none';
        }

        var state2 = $('#food_type').val();
        if(state2 == 'Others'){
            document.getElementById("food_others").style.display = 'inline';
        }else{
            document.getElementById("food_others").style.display = 'none';
        }

        
        var state3 = $('#medically_certified').val();
        if(state3 == 'Yes'){
            document.getElementById("medical_yes").style.display = 'flex';
        }else{
            document.getElementById("medical_yes").style.display = 'none';
        }
        
	    var area = $("#area_council").val();
	    var townn = $("#townn").val();
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

	            $('[name=town] option').filter(function() {
	                return ($(this).val() == townn);
	            }).prop('selected', true);
	        },

	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert("error");

	        }
	    });
	});
</script>
