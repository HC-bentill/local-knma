
<script type="text/javascript">
	function property(){
		var prop = document.getElementById("property_type2").value;
		//alert(prop);
        if( prop !== "Compound"){
            $('#floor').fadeIn('slow');
        }else{
            $('#floor').fadeOut('slow');
        }
	}
</script>
<script type="text/javascript">
	function propertyAssessment(){
		var prop = document.getElementById("property_assessment").value;
		//alert(prop);
        if( prop == 1){
            $('#photo').fadeIn('slow');
        }else{
            $('#photo').fadeOut('slow');
        }
	}
</script>
<script type="text/javascript">
	function par(){
		var prop = document.getElementById("business_building").value;
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
	}
</script>
<script type="text/javascript">
	function categoryLogic(){
		var prop = document.getElementById("category").value;
		//alert(prop);
        if( prop == 12){
            $('.business_property').fadeIn('slow');
            $('.residential_property').fadeOut('slow');
        }else if(prop == 13){
            $('.residential_property').fadeIn('slow');
            $('.business_property').fadeOut('slow');
        }else{
            $('.business_property').fadeOut('slow');
            $('.residential_property').fadeOut('slow');
        }
	}
</script>
<script type="text/javascript">
	function categoryLogic_edit(){
		var prop = document.getElementById("category").value;
		//alert(prop);
        if( prop == 12){
            $('.business_property').fadeIn('slow');
            $('.residential_property').fadeOut('slow');
        }else if(prop == 13){
            $('.residential_property').fadeIn('slow');
            $('.business_property').fadeOut('slow');
        }else{
            $('.business_property').fadeOut('slow');
            $('.residential_property').fadeOut('slow');
        }

        var category = $("#category").val(); 
        var category1 = $("#category1").val();
			// alert("love you");
			// AJAX request
			$.ajax({
				url:"<?php echo base_url().'Invoice/get_product_category';?>",
				method: "POST",
				data: {id: category, table: "product_category1", column: "product_id"},
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
</script>
<script type="text/javascript">
	function accessed(){
		var prop = document.getElementById("accessed_status").value;
		//alert(prop);
        if( prop == 1){
            $('#rateable').fadeIn('slow');
            $('#rate').fadeIn('slow');
            $('#valuation').fadeIn('slow');
            $('.assessed').fadeOut('slow');
        }else{
            $('#rateable').fadeOut('slow');
            $('#rate').fadeOut('slow');
            $('#valuation').fadeOut('slow');
            $('.assessed').fadeIn('slow');
        }
	}
</script>
<script type="text/javascript">
    function b_permit(){
        var state = document.getElementById("building_permit").value;
        //alert(prop);
        if( state == "Yes"){
            $('#b_permit').fadeIn('slow');
        }else{
            $('#b_permit').fadeOut('slow');
        }
    }
</script>
<script type="text/javascript">
    function p_permit(){
        var state = document.getElementById("planning_permit").value;
        //alert(prop);
        if( state == "Yes"){
            $('#p_permit').fadeIn('slow');
        }else{
            $('#p_permit').fadeOut('slow');
        }
    }
</script>
<script type="text/javascript">
    function inhabitant(){
        var state = document.getElementById("building_status").value;
        //alert(prop);
        if( state == "0"){
            $('#uncompleted_yes').fadeIn('slow');
        }else{
            $('#uncompleted_yes').fadeOut('slow');
        }
    }
</script>
<script type="text/javascript">
	function check(){
		var state = $('#toilet_facility').val();
		if(state == 'No'){
	        $('#t_no').fadeIn('slow');
            $('#t_yes').fadeOut('slow');
            $('#t_yes1').fadeOut('slow');
	    }else{
	        $('#t_no').fadeOut('slow');
            $('#t_yes').fadeIn('slow');
            $('#t_yes1').fadeIn('slow');
	    }

	    var state1 = $('#avai_of_water').val();
	    if(state1== 'No'){
	        $('#water_no').fadeIn('slow');
	        $('#water_yes').fadeOut('slow');
	    }
	    else{
	        $('#water_no').fadeOut('slow');
	        $('#water_yes').fadeIn('slow');
	    }

	    var state2 = $('#avai_of_refuse').val();
	    if(state2 == 'No'){
	        $('#refuse_no').fadeIn('slow');
	        $('#refuse_yes').fadeOut('slow');
	    }
	    else{
	        $('#refuse_no').fadeOut('slow');
	        $('#refuse_yes').fadeIn('slow');
        }
        
        var state3 = $('#avail_of_telcom_network').val();
        if(state3 == 'Yes'){
            $('#avail_of_telcom_network_yes').fadeIn('slow');
        }
        else{
            $('#avail_of_telcom_network_yes').fadeOut('slow');
        }

        b_permit();
        p_permit();
	}
</script>
<script type="text/javascript">
  $(document).on('change','#toilet_facility',function(){
    var state = $('#toilet_facility').val();
    if(state == 'No'){
        $('#t_no').fadeIn('slow');
        $('#t_yes').fadeOut('slow');
        $('#t_yes1').fadeOut('slow');
    }
    else{
        $('#t_no').fadeOut('slow');
        $('#t_yes').fadeIn('slow');
        $('#t_yes1').fadeIn('slow');
    }
  });
</script>
<script type="text/javascript">
  $(document).on('change','#avail_of_telcom_network',function(){
    var state = $('#avail_of_telcom_network').val();
    if(state == 'Yes'){
        $('#avail_of_telcom_network_yes').fadeIn('slow');
    }
    else{
        $('#avail_of_telcom_network_yes').fadeOut('slow');
    }
  });
</script>
<script type="text/javascript">
  $(document).on('change','#type_of_building',function(){
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
  });
</script>
<script type="text/javascript">
  $(document).on('change','#type_of_building',function(){
    var state = $('#type_of_building').val();
    if(state == 'Temporary'){
        $('#temp').fadeIn('slow');
    }
    else{
        $('#temp').fadeOut('slow');
    }
  });
</script>
<script type="text/javascript">
  $(document).on('change','#avai_of_water',function(){
    var state = $('#avai_of_water').val();
    if(state == 'No'){
        $('#water_no').fadeIn('slow');
        $('#water_yes').fadeOut('slow');
    }
    else{
        $('#water_no').fadeOut('slow');
        $('#water_yes').fadeIn('slow');
    }
  });
</script>
<script type="text/javascript">
  $(document).on('change','#avai_of_refuse',function(){
    var state = $('#avai_of_refuse').val();
    if(state == 'No'){
        $('#refuse_no').fadeIn('slow');
        $('#refuse_yes').fadeOut('slow');
    }
    else{
        $('#refuse_no').fadeOut('slow');
        $('#refuse_yes').fadeIn('slow');
    }
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
    $('#next').click(function(){
    var area = $("#area_council").val();
    var townn = $("#townn").val();
    //alert(townn);
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
                $('#town').append('<option value="'+data['id']+'" >'+data['town']+'</option>');
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
<script>
function check_busprop_code(){

    var username = document.getElementById("buis_property_code").value;
    var baseurl = "<?php echo base_url(); ?>";
    var n = username.length;
    if(n < 11){
        document.getElementById("status").style.display= "inline-block";
        document.getElementById("statuss").style.display = "none";
    }else{

        var url = baseurl + "Business/search_business_prop_code/" + username;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState == 4 && this.status == 200) {
                myFunction(this.responseText);
            }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send();

        function myFunction(response) {
            var arr = JSON.parse(response);
            if(arr == ""){
                document.getElementById("status").style.display = 'inline-block';
                document.getElementById("statuss").style.display = "none";
            }else{
                for (var i = 0; i < arr.length; i++) {
                    var userid = arr[i].id;
                    if(userid !== "") {

                        document.getElementById("status").style.display = 'none';
                        document.getElementById("statuss").style.display = "inline-block";

                    }
                }
            }
        }
    }

}
</script>
<script type="text/javascript">
    $('#property_category').change(function(){
    var prop_cat = $(this).val();
    //alert(classes);
    // AJAX request
    $.ajax({
        url:"<?php echo base_url().'Business/get_sectors';?>",
        method: "POST",
        data: {prop_cat: prop_cat},
        dataType: "JSON",
        success: function(response){

            // Remove options
            $('#buis_sector').find('option').not(':first').remove();

            // Add options
            $.each(response,function(index,data){
                $('#buis_sector').append('<option value="'+data['id']+'">'+data['name']+'</option>');
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
    $('#buis_sector').change(function(){
    var buis_sector = $(this).val();
    //alert(classes);
    // AJAX request
    $.ajax({
        url:"<?php echo base_url().'Business/get_prop_type';?>",
        method: "POST",
        data: {buis_sector: buis_sector},
        dataType: "JSON",
        success: function(response){

            // Remove options
            $('#property_type').find('option').not(':first').remove();

            // Add options
            $.each(response,function(index,data){
                $('#property_type').append('<option value="'+data['id']+'">'+data['name']+'</option>');
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
    function val_occ(){
        var prop_cat = $("#property_category").val();
        var buis_sectorr = $("#buis_sectorr").val()
        //alert(classes);
        // AJAX request
        $.ajax({
            url:"<?php echo base_url().'Business/get_sectors';?>",
            method: "POST",
            data: {prop_cat: prop_cat},
            dataType: "JSON",
            success: function(response){

                // Remove options
                $('#buis_sector').find('option').not(':first').remove();

                // Add options
                $.each(response,function(index,data){
                    $('#buis_sector').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                });
                $('[name=buis_sector] option').filter(function() {
                return ($(this).val() == buis_sectorr);
                }).prop('selected', true);
            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });

        var buis_sector = $("#buis_sectorr").val();
        var property_categoryy = $("#property_categoryy").val();
        //alert(property_categoryy);
        //alert(classes);
        // AJAX request
        $.ajax({
            url:"<?php echo base_url().'Business/get_prop_type';?>",
            method: "POST",
            data: {buis_sector: buis_sector},
            dataType: "JSON",
            success: function(response){

                // Remove options
                $('#property_type').find('option').not(':first').remove();

                // Add options
                $.each(response,function(index,data){
                    $('#property_type').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                });
                $('[name=property_type] option').filter(function() {
                return ($(this).val() == property_categoryy);
                }).prop('selected', true);
            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });
    }
</script>
<script type="text/javascript">
    $("#btnet").click(function(){
        var validated = $('#formm').valid();
        if( validated ) {
            document.getElementById("formm").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#btnet1").click(function(){
        var validated = $('#formm1').valid();
        if( validated ) {
            document.getElementById("formm1").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#btnet2").click(function(){
        var validated = $('#formm2').valid();
        if( validated ) {
            document.getElementById("formm2").submit();
        }else{
            //alert("error")
        }
    })
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
    $("#locbtnn").click(function(){
        var validated = $('#locform').valid();
        if( validated ) {
            document.getElementById("locform").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#locbtn").click(function(){
        var validated = $('#propform').valid();
        if( validated ) {
            document.getElementById("propform").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#facbtn").click(function(){
        var validated = $('#facform').valid();
        if( validated ) {
            document.getElementById("facform").submit();
        }else{
            //alert("error")
        }
    })
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
<script type="text/javascript">
    function search_owner(){

          var a = document.getElementById("primary_contactt").value;
          document.getElementById("primary_contact").value = a;

          if(a.length < 10){

                $('.owner_others').css('display','inline');
                $('.owner_reside').fadeOut('slow');
                $('.owner_reside_not').fadeOut('slow');
                document.getElementById("firstname").disabled = false;
                document.getElementById("personal_category").disabled = false;
                document.getElementById("lastname").disabled = false;
                document.getElementById("secondary_contact").disabled = false;
                document.getElementById("gender").disabled = false;
                document.getElementById("owner_pwd").disabled = false;
                //document.getElementById("owner_native").disabled = false;
                //document.getElementById("religion").disabled = false;
                document.getElementById("email").disabled = false;
                document.getElementById("postal_address").disabled = false;
                // document.getElementById("other_religion").disabled = false;
                // document.getElementById("owner_town").disabled = false;
                // document.getElementById("owner_area_council").disabled = false;
                document.getElementById("owner_ghpost_gps").disabled = false;
                // document.getElementById("owner_location").disabled = false;
                // document.getElementById("owner_hometown").disabled = false;
                // document.getElementById("owner_home_district").disabled = false;
                // document.getElementById("owner_ethnicity").disabled = false;
                // document.getElementById("owner_native_language").disabled = false;
                // document.getElementById("owner_region").disabled = false;
                document.getElementById("firstname").value = "";
                document.getElementById("personal_category").value = "";
                document.getElementById("lastname").value = "";
                document.getElementById("secondary_contact").value = "";
                document.getElementById("gender").value = "";
                document.getElementById("owner_pwd").value = "";
                //document.getElementById("owner_native").value = "";
                document.getElementById("email").value = "";
                document.getElementById("postal_address").value = "";
                // document.getElementById("religion").value = "";
                // document.getElementById("other_religion").value = "";
                // document.getElementById("owner_town").value = "";
                // document.getElementById("owner_area_council").value = "";
                document.getElementById("owner_ghpost_gps").value = "";
                // document.getElementById("owner_location").value = "";
                // document.getElementById("owner_hometown").value = "";
                // document.getElementById("owner_home_district").value = "";
                // document.getElementById("owner_region").value = "";
                // document.getElementById("owner_ethnicity").value = "";
                // document.getElementById("owner_native_language").value = "";
                // document.getElementById("others").style.display ="none";
                // Remove options
                //$('#owner_town').find('option').not(':first').remove();
          }else{
              var baseurl = "<?php echo base_url(); ?>";
              var xmlhttp = new XMLHttpRequest();
              var url = baseurl + "Residence/search_property_owner/" + a;

            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    myFunction(xmlhttp.responseText);
                }
            }

            xmlhttp.open("GET", url, true);
            xmlhttp.send();

            function myFunction(response) {

                var arr = JSON.parse(response);

                if(arr == ""){
                    //document.getElementById("exampleToastrErrorShadow").click();
                    $('.owner_others').css('display','inline');
                    $('.owner_reside').fadeOut('slow');
                    $('.owner_reside_not').fadeOut('slow');
                    document.getElementById("firstname").disabled = false;
                    document.getElementById("personal_category").disabled = false;
                    document.getElementById("lastname").disabled = false;
                    document.getElementById("secondary_contact").disabled = false;
                    document.getElementById("gender").disabled = false;
                    document.getElementById("owner_pwd").disabled = false;
                    // document.getElementById("owner_native").disabled = false;
                    // document.getElementById("religion").disabled = false;
                    document.getElementById("email").disabled = false;
                    document.getElementById("postal_address").disabled = false;
                    document.getElementById("owner_ghpost_gps").disabled = false;
                    // document.getElementById("other_religion").disabled = false;
                    // document.getElementById("owner_town").disabled = false;
                    // document.getElementById("owner_area_council").disabled = false;
                    // document.getElementById("owner_location").disabled = false;
                    // document.getElementById("owner_hometown").disabled = false;
                    // document.getElementById("owner_ethnicity").disabled = false;
                    // document.getElementById("owner_native_language").disabled = false;
                    // document.getElementById("owner_home_district").disabled = false;
                    // document.getElementById("owner_region").disabled = false;
                    document.getElementById("firstname").value = "";
                    document.getElementById("personal_category").value = "";
                    document.getElementById("lastname").value = "";
                    document.getElementById("secondary_contact").value = "";
                    document.getElementById("gender").value = "";
                    document.getElementById("owner_pwd").value = "";
                    //document.getElementById("owner_native").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("postal_address").value = "";
                    //document.getElementById("religion").value = "";
                    // document.getElementById("other_religion").value = "";
                    // document.getElementById("owner_town").value = "";
                    // document.getElementById("owner_area_council").value = "";
                    // document.getElementById("owner_ghpost_gps").value = "";
                    // document.getElementById("owner_location").value = "";
                    // document.getElementById("owner_hometown").value = "";
                    // document.getElementById("owner_home_district").value = "";
                    // document.getElementById("owner_region").value = "";
                    // document.getElementById("owner_ethnicity").value = "";
                    // document.getElementById("owner_native_language").value = "";
                    // document.getElementById("others").style.display ="none";
                    // // Remove options
                    // $('#owner_town').find('option').not(':first').remove();
                }else{

                  for (var i = 0; i < arr.length; i++) {

                    document.getElementById("firstname").value = arr[i].firstname;
                    document.getElementById("personal_category").value = arr[i].person_category;
                    document.getElementById("lastname").value = arr[i].lastname;
                    document.getElementById("secondary_contact").value = arr[i].secondary_contact;
                    document.getElementById("email").value = arr[i].email;
                    document.getElementById("postal_address").value = arr[i].postal_address;
                    document.getElementById("owner_ghpost_gps").value = arr[i].ghpostgps_code;
                    document.getElementById("gender").value = arr[i].gender;
                    document.getElementById("owner_pwd").value = arr[i].owner_pwd;
                    // document.getElementById("owner_native").value = arr[i].owner_native;
                    // document.getElementById("religion").value = arr[i].religion;
                    // document.getElementById("other_religion").value = arr[i].other_religion;
                    // var town = arr[i].town;
                    // document.getElementById("owner_area_council").value = arr[i].area_council;
                    // document.getElementById("owner_location").value = arr[i].location;
                    // document.getElementById("owner_hometown").value = arr[i].hometown;
                    // document.getElementById("owner_home_district").value = arr[i].home_district;
                    // document.getElementById("owner_ethnicity").value = arr[i].ethnicity;
                    // document.getElementById("owner_native_language").value = arr[i].native_language;
                    // document.getElementById("owner_region").value = arr[i].region;
                    document.getElementById("firstname").disabled = true;
                    document.getElementById("personal_category").disabled = true;
                    document.getElementById("lastname").disabled = true;
                    document.getElementById("secondary_contact").disabled = true;
                    document.getElementById("email").disabled = true;
                    document.getElementById("gender").disabled = true;
                    document.getElementById("owner_pwd").disabled = true;
                    document.getElementById("postal_address").disabled = true;
                    // document.getElementById("owner_native").disabled = true;
                    // document.getElementById("religion").disabled = true;
                    // document.getElementById("other_religion").disabled = true;
                    // document.getElementById("owner_town").disabled = true;
                    // document.getElementById("owner_area_council").disabled = true;
                    document.getElementById("owner_ghpost_gps").disabled = true;
                    // document.getElementById("owner_location").disabled = true;
                    // document.getElementById("owner_hometown").disabled = true;
                    // document.getElementById("owner_home_district").disabled = true;
                    // document.getElementById("owner_region").disabled = true;
                    // document.getElementById("owner_ethnicity").disabled = true;
                    // document.getElementById("owner_native_language").disabled = true;

                  }
                //   $('.owner_others').css('display','inline');
                //     if(document.getElementById("religion").value == "Others"){

                //         document.getElementById("others").style.display ="inline";
                //     }
                //     if(document.getElementById("owner_native").value == "No"){
                //         $('.owner_reside_not').css('display','inline');
                //         $('.owner_reside').fadeOut('slow');
                //     }else{
                //        $('.owner_reside_not').fadeOut('slow');
                //         $('.owner_reside').css('display','inline');
                //     }

                //     var area = $("#owner_area_council").val();
                //     //alert(area+' '+town);
                //     //alert(clas"ses);
                //     // AJAX request
                //     $.ajax({
                //         url:"<?php echo base_url().'Residence/get_area_towns';?>",
                //         method: "POST",
                //         data: {area: area},
                //         dataType: "JSON",
                //         success: function(response){

                //             // Remove options
                //             $('#owner_town').find('option').not(':first').remove();

                //             // Add options
                //             $.each(response,function(index,data){
                //                 $('#owner_town').append('<option value="'+data['id']+'">'+data['town']+'</option>');
                //             });
                //             $('[name=owner_town] option').filter(function() {
                //                 return ($(this).val() == town);
                //             }).prop('selected', true);
                //             $('[name=owner_area_council] option').filter(function() {
                //                 return ($(this).val() == document.getElementById("owner_area_council").value);
                //             }).prop('selected', true);
                //             $('[name=owner_religion] option').filter(function() {
                //                 return ($(this).val() == document.getElementById("religion").value);
                //             }).prop('selected', true);
                //             $('[name=owner_native] option').filter(function() {
                //                 return ($(this).val() == document.getElementById("owner_native").value);
                //             }).prop('selected', true);
                //             $('[name=owner_religion] option').filter(function() {
                //                 return ($(this).val() == document.getElementById("owner_religion").value);
                //             }).prop('selected', true);
                //             $('[name=owner_region] option').filter(function() {
                //                 return ($(this).val() == document.getElementById("owner_region").value);
                //             }).prop('selected', true);
                //         },

                //         error: function (jqXHR, textStatus, errorThrown)
                //         {
                //             alert("error");

                //         }
                //     });

                }

           };
        }
    }
</script>
<script type="text/javascript">
    $('#owner_native').change(function(){
        var state = $('#owner_native').val();
        if(state == "No"){
            $('.owner_reside').css('display','none');
            $('.owner_reside_not').css('display','inline');
        }else if(state == "Yes"){
            $('.owner_reside').css('display','inline');
            $('.owner_reside_not').css('display','none');
        }else{
            $('.owner_reside').css('display','none');
            $('.owner_reside_not').css('display','none');
        }
    });
</script>
<!-- <script>
    $(document).on('change',"section#w4 #w4-billing select[name=cat5]",function(e){
        var value = $("section#w4 #w4-billing select[name=cat5]").val();
        var valueText = $("section#w4 #w4-billing select[name=cat5]").find('option:selected').text()
        console.log(value);
        console.log(valueText);
        if(valueText.toLowerCase() !== 'none' && valueText.toLowerCase() !== "n/a"){
            document.getElementById("cat5").value = value
        }else{
            document.getElementById("cat5").value = "0"
        }
     });
</script> -->
<script type="text/javascript">
    function check_religion(){
        var state = $('#religion').val();
        if(state == 'Others'){
            $('#others').fadeIn('slow');
        }
        else{
            $('#others').fadeOut('slow');
        }

    }
</script>
<?php if($title == "Edit Property Details" || $title == "Edit Business Occupant Details"):?>
<script type="text/javascript">
    $('#cat1').change(function(){
    var category1 = $(this).val();
     
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
           
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("error");

        }
    });
});
</script>
<script type="text/javascript">
    $('#cat2').change(function(){
    var category2 = $(this).val();
     
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
            
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("error");

        }
    });
});
</script>
<script type="text/javascript">
    $('#cat3').change(function(){
    var category3 = $(this).val();
    
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
            
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("error");

        }
    });
});
</script>
<script type="text/javascript">
    $('#cat4').change(function(){
    var category4 = $(this).val();
     
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
            
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("error");

        }
    });
});
</script>
<script type="text/javascript">
    $('#cat5').change(function(){
    var category5 = $(this).val();
    
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
            
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("error");

        }
    });
});
</script>
<?php endif;?>
<script>

    function busocc_modal(category1, category2, category3, category4, category5, category6, busoccid, busocccode,busid)
    {

        document.getElementById("buscatid").value = busoccid;
        document.getElementById("busocccode").value = busocccode;
        document.getElementById("busid").value = busid;
        jQuery('#m_modal_1').modal('show', {backdrop: 'static'});

        var product  = 1;
		if(product != ""){
			
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
        
    }
</script>
<script>
    function busoccdel_modal(busoccid, busocccode,busid)
    {

        document.getElementById("buscatid1").value = busoccid;
        document.getElementById("busocccode1").value = busocccode;
        document.getElementById("busid1").value = busid;
        jQuery('#m_modal_11').modal('show', {backdrop: 'static'});
    }
</script>
