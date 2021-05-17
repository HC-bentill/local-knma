<script>
	$(document).ready(function(){
		do_checks();
		propertyAssessment();
	    check();
		accessed();
		property();
		inhabitant();

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
		
		var prop = document.getElementById("type_of_building").value;
		//alert(prop);
        if( prop == "Permanent"){
            $('#part2').fadeIn('slow');
            $('#part1').fadeOut('slow');
        }else if(prop == "Temporary"){
            $('#part1').fadeIn('slow');
            $('#part2').fadeOut('slow');
        }else{
            $('#part1').fadeOut('slow');
            $('#part2').fadeOut('slow');
		}
		
		if(prop == "Temporary"){	
			$('#floor').fadeOut('slow');
        }else{
            $('#floor').fadeIn('slow');
        }
	});
</script>
<script>
	$(document).ready(function(){
    
		var product  = 13;
		if(product != ""){
			var category1 = $("#category1").val(); 
			// alert("love you");
			// AJAX request
			$.ajax({
				url:"<?php echo base_url().'Invoice/get_product_category';?>",
				method: "POST",
				data: {id: product, table: "product_category1", column: "product_id"},
				dataType: "JSON",
				success: function(response){

					// Remove options
					$('#cat1').find('option').not(':first').remove();

					// Add options
					$.each(response,function(index,data){
						$('#cat1').append('<option value="'+data['id']+'">'+data['name']+'</option>');
					});

					$('[name=cat1] option').filter(function() {
						return ($(this).val() == category1);
					}).prop('selected', true);
				},

				error: function (jqXHR, textStatus, errorThrown)
				{
					alert("error");

				}
			});
		}
		
		var category1 = $("#category1").val();
		var category2 = $("#category2").val(); 
		//alert("love you");
		// AJAX request
		$.ajax({
			url:"<?php echo base_url().'Invoice/get_product_category';?>",
			method: "POST",
			data: {id: category1, table: "product_category2", column: "category1_id"},
			dataType: "JSON",
			success: function(response){

				// Remove options
				$('#cat2').find('option').not(':first').remove();

				// Add options
				$.each(response,function(index,data){
					$('#cat2').append('<option value="'+data['id']+'">'+data['name']+'</option>');
				});

				$('[name=cat2] option').filter(function() {
					return ($(this).val() == category2);
				}).prop('selected', true);
			},

			error: function (jqXHR, textStatus, errorThrown)
			{
				alert("error");

			}
		});
		
		var category2 = $("#category2").val();
		var category3 = $("#category3").val(); 
		//alert("love you");
		// AJAX request
		$.ajax({
			url:"<?php echo base_url().'Invoice/get_product_category';?>",
			method: "POST",
			data: {id: category2, table: "product_category3", column: "category2_id"},
			dataType: "JSON",
			success: function(response){

				// Remove options
				$('#cat3').find('option').not(':first').remove();

				// Add options
				$.each(response,function(index,data){
					$('#cat3').append('<option value="'+data['id']+'">'+data['name']+'</option>');
				});

				$('[name=cat3] option').filter(function() {
					return ($(this).val() == category3);
				}).prop('selected', true);
			},

			error: function (jqXHR, textStatus, errorThrown)
			{
				alert("error");

			}
		});
		
		var category3 = $("#category3").val();
		var category4 = $("#category4").val(); 
		//alert("love you");
		// AJAX request
		$.ajax({
			url:"<?php echo base_url().'Invoice/get_product_category';?>",
			method: "POST",
			data: {id: category3, table: "product_category4", column: "category3_id"},
			dataType: "JSON",
			success: function(response){

				// Remove options
				$('#cat4').find('option').not(':first').remove();

				// Add options
				$.each(response,function(index,data){
					$('#cat4').append('<option value="'+data['id']+'">'+data['name']+'</option>');
				});

				$('[name=cat4] option').filter(function() {
					return ($(this).val() == category4);
				}).prop('selected', true);
			},

			error: function (jqXHR, textStatus, errorThrown)
			{
				alert("error");

			}
		});
		
		var category4 = $("#category4").val();
		var category5 = $("#category5").val(); 
		//alert("love you");
		// AJAX request
		$.ajax({
			url:"<?php echo base_url().'Invoice/get_product_category';?>",
			method: "POST",
			data: {id: category4, table: "product_category5", column: "category4_id"},
			dataType: "JSON",
			success: function(response){

				// Remove options
				$('#cat5').find('option').not(':first').remove();

				// Add options
				$.each(response,function(index,data){
					$('#cat5').append('<option value="'+data['id']+'">'+data['name']+'</option>');
				});

				$('[name=cat5] option').filter(function() {
					return ($(this).val() == category5);
				}).prop('selected', true);
			},

			error: function (jqXHR, textStatus, errorThrown)
			{
				alert("error");

			}
		});
		
		var category5 = $("#category5").val();
		var category6 = $("#category6").val();

		// AJAX request
		$.ajax({
			url:"<?php echo base_url().'Invoice/get_product_category';?>",
			method: "POST",
			data: {id: category5, table: "product_category6", column: "category5_id"},
			dataType: "JSON",
			success: function(response){

				// Remove options
				$('#cat6').find('option').not(':first').remove();

				// Add options
				$.each(response,function(index,data){
					$('#cat6').append('<option value="'+data['id']+'">'+data['name']+'</option>');
				});

				$('[name=cat6] option').filter(function() {
					return ($(this).val() == category6);
				}).prop('selected', true);
			},

			error: function (jqXHR, textStatus, errorThrown)
			{
				alert("error");

			}
		});
	});
    </script>
