<script type="text/javascript">
$("#tags").select2({
    maximumSelectionLength: 5
});
</script>
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
    function b_disability(){
        var state = document.getElementById("disability").value;
        //alert(prop);
        if( state == "Yes"){
            $('#s_disability').fadeIn('slow');
        }else{
            $('#s_disability').fadeOut('slow');
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
	function check(){
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

        b_permit();
        p_permit();
	}
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
  $(document).on('change','#nationality',function(){
    var state = $('#nationality').val();
    if(state == 'Non-Ghanaian'){
        $('#count').fadeIn('slow');
        $('#nat').fadeIn('slow');
        $('#idn').fadeOut('slow');
        $('#idt').fadeOut('slow');
    }
    else{
        $('#count').fadeOut('slow');
        $('#nat').fadeOut('slow');
        $('#idn').fadeIn('slow');
        $('#idt').fadeIn('slow');
    }
  });
</script>
<script type="text/javascript">
  $(document).on('change','#employment_status',function(){
    var state = $('#employment_status').val();

    if(state == 'Employed'){
        $('#employed').fadeIn('slow');
        $('#employed1').fadeIn('slow');
        $('#selfemployed').fadeOut('slow');
        $('#selfemployed1').fadeOut('slow');
    }
    else if(state == "Self-Employed"){
        //alert("i got ya");
        $('#employed').fadeOut('slow');
        $('#employed1').fadeOut('slow');
        $('#selfemployed').fadeIn('slow');
        $('#selfemployed1').fadeIn('slow');
    }else{
        $('#employed').fadeOut('slow');
        $('#employed1').fadeOut('slow');
        $('#selfemployed').fadeOut('slow');
        $('#selfemployed1').fadeOut('slow');
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
    $('#next').click(function(){
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
<script>
function check_res_code(){

    var baseurl = "<?php echo base_url(); ?>";
    var username = document.getElementById("res_prop_code").value;
    var n = username.length;
    if(n < 11){
        document.getElementById("status").style.display= "inline-block";
        document.getElementById("statuss").style.display = "none";

    }else{
        var url = baseurl + "Residence/search_res_prop_code/" + username;
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
                //document.getElementById("save").disabled  = true;
            }else{
            for (var i = 0; i < arr.length; i++) {
            var userid = arr[i].id;
            if(userid !== "") {

                document.getElementById("status").style.display = 'none';
                document.getElementById("statuss").style.display = "inline-block";
                //document.getElementById("save").disabled  = false;

            }
            }
            }
        }
    }

}
</script>
<script type="text/javascript">
    function birth(){
        var state = $('#no_of_kids').val();

        if(state == 1){
            $('#first_birth').fadeIn('slow');
            $('#last_birth').fadeOut('slow');
        }else if(state > 1){
            $('#first_birth').fadeIn('slow');
            $('#last_birth').fadeIn('slow');
        }else{
            $('#first_birth').fadeOut('slow');
            $('#last_birth').fadeOut('slow');
        }
    }
</script>
<script type="text/javascript">
    $('#owner_native').change(function(){
        var state = $('#owner_native').val();

        if(state == "No"){
            $('.owner_reside').fadeOut('slow');
            $('.owner_reside_not').fadeIn('slow');
        }else if(state == "Yes"){
            $('.owner_reside').fadeIn('slow');
            $('.owner_reside_not').fadeOut('slow');
        }else{
            $('.owner_reside').fadeOut('slow');
            $('.owner_reside_not').fadeOut('slow');
        }
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
    $("#locbtn").click(function(){
        var validated = $('#locform').valid();
        if( validated ) {
            document.getElementById("locform").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#propbtn").click(function(){
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
    $("#btn1").click(function(){
        var validated = $('#form1').valid();
        if( validated ) {
            document.getElementById("form1").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#btn2").click(function(){
        var validated = $('#form2').valid();
        if( validated ) {
            document.getElementById("form2").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#btn3").click(function(){
        var validated = $('#form3').valid();
        if( validated ) {
            document.getElementById("form3").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    function edit(){
        check_res_code();
        birth();
        check_religion();
        var state = $('#nationality').val();
        if(state == 'Non-Ghanaian'){
            $('#count').fadeIn('slow');
            $('#nat').fadeIn('slow');
            $('#idn').fadeOut('slow');
            $('#idt').fadeOut('slow');
        }
        else{
            $('#count').fadeOut('slow');
            $('#nat').fadeOut('slow');
            $('#idn').fadeIn('slow');
            $('#idt').fadeIn('slow');
        }
        var status = $('#employment_status').val();

        if(status == 'Employed'){
            $('#employed').fadeIn('slow');
            $('#selfemployed').fadeOut('slow');
        }
        else if(status == "Self-Employed"){
            //alert("i got ya");
            $('#employed').fadeOut('slow');
            $('#selfemployed').fadeIn('slow');
        }else{
            $('#employed').fadeOut('slow');
            $('#selfemployed').fadeOut('slow');
        }
    }
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
                document.getElementById("owner_native").disabled = false;
                document.getElementById("religion").disabled = false;
                document.getElementById("email").disabled = false;
                document.getElementById("postal_address").disabled = false;
                document.getElementById("other_religion").disabled = false;
                document.getElementById("owner_town").disabled = false;
                document.getElementById("owner_area_council").disabled = false;
                document.getElementById("owner_ghpost_gps").disabled = false;
                document.getElementById("owner_location").disabled = false;
                document.getElementById("owner_hometown").disabled = false;
                document.getElementById("owner_home_district").disabled = false;
                document.getElementById("owner_ethnicity").disabled = false;
                document.getElementById("owner_native_language").disabled = false;
                document.getElementById("owner_region").disabled = false;
                document.getElementById("firstname").value = "";
                document.getElementById("personal_category").value = "";
                document.getElementById("lastname").value = "";
                document.getElementById("secondary_contact").value = "";
                document.getElementById("owner_native").value = "";
                document.getElementById("email").value = "";
                document.getElementById("postal_address").value = "";
                document.getElementById("religion").value = "";
                document.getElementById("other_religion").value = "";
                document.getElementById("owner_town").value = "";
                document.getElementById("owner_area_council").value = "";
                document.getElementById("owner_ghpost_gps").value = "";
                document.getElementById("owner_location").value = "";
                document.getElementById("owner_hometown").value = "";
                document.getElementById("owner_home_district").value = "";
                document.getElementById("owner_region").value = "";
                document.getElementById("owner_ethnicity").value = "";
                document.getElementById("owner_native_language").value = "";
                document.getElementById("others").style.display ="none";
                // Remove options
                $('#owner_town').find('option').not(':first').remove();
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
                    document.getElementById("owner_native").disabled = false;
                    document.getElementById("religion").disabled = false;
                    document.getElementById("email").disabled = false;
                    document.getElementById("postal_address").disabled = false;
                    document.getElementById("owner_ghpost_gps").disabled = false;
                    document.getElementById("other_religion").disabled = false;
                    document.getElementById("owner_town").disabled = false;
                    document.getElementById("owner_area_council").disabled = false;
                    document.getElementById("owner_location").disabled = false;
                    document.getElementById("owner_hometown").disabled = false;
                    document.getElementById("owner_ethnicity").disabled = false;
                    document.getElementById("owner_native_language").disabled = false;
                    document.getElementById("owner_home_district").disabled = false;
                    document.getElementById("owner_region").disabled = false;
                    document.getElementById("firstname").value = "";
                    document.getElementById("personal_category").value = "";
                    document.getElementById("lastname").value = "";
                    document.getElementById("secondary_contact").value = "";
                    document.getElementById("owner_native").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("postal_address").value = "";
                    document.getElementById("religion").value = "";
                    document.getElementById("other_religion").value = "";
                    document.getElementById("owner_town").value = "";
                    document.getElementById("owner_area_council").value = "";
                    document.getElementById("owner_ghpost_gps").value = "";
                    document.getElementById("owner_location").value = "";
                    document.getElementById("owner_hometown").value = "";
                    document.getElementById("owner_home_district").value = "";
                    document.getElementById("owner_region").value = "";
                    document.getElementById("owner_ethnicity").value = "";
                    document.getElementById("owner_native_language").value = "";
                    document.getElementById("others").style.display ="none";
                    // Remove options
                    $('#owner_town').find('option').not(':first').remove();
                }else{

                  for (var i = 0; i < arr.length; i++) {

                    document.getElementById("firstname").value = arr[i].firstname;
                    document.getElementById("personal_category").value = arr[i].person_category;
                    document.getElementById("lastname").value = arr[i].lastname;
                    document.getElementById("secondary_contact").value = arr[i].secondary_contact;
                    document.getElementById("email").value = arr[i].email;
                    document.getElementById("postal_address").value = arr[i].postal_address;
                    document.getElementById("owner_ghpost_gps").value = arr[i].ghpostgps_code;
                    document.getElementById("owner_native").value = arr[i].owner_native;
                    document.getElementById("religion").value = arr[i].religion;
                    document.getElementById("other_religion").value = arr[i].other_religion;
                    var town = arr[i].town;
                    document.getElementById("owner_area_council").value = arr[i].area_council;
                    document.getElementById("owner_location").value = arr[i].location;
                    document.getElementById("owner_hometown").value = arr[i].hometown;
                    document.getElementById("owner_home_district").value = arr[i].home_district;
                    document.getElementById("owner_ethnicity").value = arr[i].ethnicity;
                    document.getElementById("owner_native_language").value = arr[i].native_language;
                    document.getElementById("owner_region").value = arr[i].region;
                    document.getElementById("firstname").disabled = true;
                    document.getElementById("personal_category").disabled = true;
                    document.getElementById("lastname").disabled = true;
                    document.getElementById("secondary_contact").disabled = true;
                    document.getElementById("email").disabled = true;
                    document.getElementById("postal_address").disabled = true;
                    document.getElementById("owner_native").disabled = true;
                    document.getElementById("religion").disabled = true;
                    document.getElementById("other_religion").disabled = true;
                    document.getElementById("owner_town").disabled = true;
                    document.getElementById("owner_area_council").disabled = true;
                    document.getElementById("owner_ghpost_gps").disabled = true;
                    document.getElementById("owner_location").disabled = true;
                    document.getElementById("owner_hometown").disabled = true;
                    document.getElementById("owner_home_district").disabled = true;
                    document.getElementById("owner_region").disabled = true;
                    document.getElementById("owner_ethnicity").disabled = true;
                    document.getElementById("owner_native_language").disabled = true;

                  }
                  $('.owner_others').css('display','inline');
                    if(document.getElementById("religion").value == "Others"){

                        document.getElementById("others").style.display ="inline";
                    }
                    if(document.getElementById("owner_native").value == "No"){
                        $('.owner_reside_not').css('display','inline');
                        $('.owner_reside').fadeOut('slow');
                    }else{
                       $('.owner_reside_not').fadeOut('slow');
                        $('.owner_reside').css('display','inline');
                    }

                    var area = $("#owner_area_council").val();
                    //alert(area+' '+town);
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
                            $('[name=owner_area_council] option').filter(function() {
                                return ($(this).val() == document.getElementById("owner_area_council").value);
                            }).prop('selected', true);
                            $('[name=owner_religion] option').filter(function() {
                                return ($(this).val() == document.getElementById("religion").value);
                            }).prop('selected', true);
                            $('[name=owner_native] option').filter(function() {
                                return ($(this).val() == document.getElementById("owner_native").value);
                            }).prop('selected', true);
                            $('[name=owner_religion] option').filter(function() {
                                return ($(this).val() == document.getElementById("owner_religion").value);
                            }).prop('selected', true);
                            $('[name=owner_region] option').filter(function() {
                                return ($(this).val() == document.getElementById("owner_region").value);
                            }).prop('selected', true);
                        },

                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert("error");

                        }
                    });

                }

           };
        }
    }
</script>
<script type="text/javascript">
    $('#product').change(function(){
        if($("#product").val() != ""){
        var product = $(this).val();
        
        // alert("love you");
        // AJAX request
        $.ajax({
            url:"<?php echo base_url().'Invoice/get_product_category';?>",
            method: "POST",
            data: {id: product, table: "product_category1", column: "product_id"},
            dataType: "JSON",
            success: function(response){

                // Remove options
                $('#category1').find('option').not(':first').remove();

                // Add options
                $.each(response,function(index,data){
                    $('#category1').append('<option value="'+data['id']+'">'+data['name']+'</option>');
                });

            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });
        }
    });
</script>

<?php if($title == "Edit Residential Details"):?>
<script type="text/javascript">
    $('#cat1').change(function(){
    var category1 = $(this).val();
     
    // alert("love you");
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
