

<script>

$('.btnshowMapFilters').click(function(){
    $('#showMapFilters').toggle('slow');
});

$.ajax({
    url: '<?php echo base_url().'MapApi/getAreaCouncil';?>',
    type: 'post',
    data: {id:''},
    dataType: 'json',
    success:function(response){

        var len = response.length;

        $("#sel_area").empty();
        $("#sel_area").append("<option value=''>Select</option>");
        for( var i = 0; i<len; i++){
            var id = response[i]['id'];
            var name = response[i]['area_council'];

            $("#sel_area").append("<option value='"+id+"'>"+name+"</option>");

        }
    }
});


$("#sel_area").change(function(){
    var deptid = $(this).val();

    $.ajax({
        url: '<?php echo base_url().'MapApi/getAreaTown';?>',
        type: 'post',
        data: {areaCouncil: deptid},
        dataType: 'json',
        success:function(response){

            var len = response.length;

            $("#sel_town").empty();
            $("#sel_town").append("<option value=''>All</option>");
            for( var i = 0; i<len; i++){
                var id = response[i]['id'];
                var name = response[i]['town'];

                $("#sel_town").append("<option value='"+id+"'>"+name+"</option>");

            }
        }
    });
});

  //*********** handle search inputs ********************************


  <?php if(isset($_GET['searchRecord'])):?>

    var searchCode = "<?=$this->input->get('searchCode')?>";
    var mapType = "<?=$this->input->get('maptype')?>";

    var fullPay = "<?=$this->input->get('fullPay')?>";
    var partPay = "<?=$this->input->get('partPay')?>";
    var noPay = "<?=$this->input->get('noPay')?>";
    var payType = fullPay+','+partPay+','+noPay;
    

    var area_council = "<?=$this->input->get('area_council')?>";
    var town = "<?=$this->input->get('town')?>";
    var property_code = "<?=$this->input->get('property_code')?>";
    var year = "<?=$this->input->get('year')?>";

    var map;

    function initMap(){

        $.ajax({
            url: "<?php echo base_url().'MapApi/getLocationDetails';?>",
            type: 'POST',
            data: {flag: mapType, payment_status: payType,area_council: area_council,town: town,property_code: property_code,year:year }, //  FULLY_PAID  PARTLY_PAID  NO_PAYMENT
            dataType: 'json',
            success: function (result) {
                // display total records
               if(isNaN(result.length)){
                    $('#totalCount').html("<b style='font-size: 25px; color: red'> Record not Found</<b>");
                }else{
                    $('#totalCount').html("<b>Total Records Found:</b> <b style='font-size: 25px'>"+result.length+'</b>');
                }

                //console.log(result);
                var locations = new Array();
                // SEARCH BY CODE

                if(searchCode != ''){
                    var count = 0;
                    $.each(result, function(key,valueObj){
                        var co = [];

                            if(mapType == 'b'){
                                co.push(valueObj.buis_prop_code);
                            }else if(mapType == 'r'){
                                co.push(valueObj.res_code);
                            }else{
                                co.push(valueObj.buis_occ_code);
                            }
                            co.push(valueObj.gps_lat);
                            co.push(valueObj.gps_long);
                            co.push('');
                            co.push(valueObj.payment_status);
                            co.push(valueObj.invoice_no);
                            co.push(valueObj.owner_name);
                            co.push(valueObj.area_council);
                            co.push(valueObj.town);

                        if(mapType == 'b' && valueObj.invoice_no == searchCode || valueObj.buis_prop_code == searchCode || valueObj.owner_phoneno == searchCode){
                            locations.push(co); count ++;
                        }else if(mapType == 'r' && valueObj.invoice_no == searchCode || valueObj.res_code == searchCode || valueObj.owner_phoneno == searchCode){
                            locations.push(co); count ++;
                        }else if(mapType == 'bo' && valueObj.invoice_no == searchCode || valueObj.buis_occ_code == searchCode || valueObj.owner_phoneno == searchCode){
                            locations.push(co); count ++;
                        }
                    });


                    if(count == 0){
                        $('#totalCount').html("<b style='font-size: 25px; color: red'> Record not Found</<b>");
                    }else{
                        $('#totalCount').html("<b>Total Records Found:</b> <b style='font-size: 25px'>"+(parseInt(count))+'</b>');
                    }

                }
                // OTHER SEARCH
                if(searchCode == '' && mapType != '' && payType == '' ){
                    $.each(result, function(key,valueObj){
                        var co = [];

                        if(mapType == 'b'){
                            co.push(valueObj.buis_prop_code);
                        }else if(mapType == 'r'){
                            co.push(valueObj.res_code);
                        }else{
                            co.push(valueObj.buis_occ_code);
                        }
                        co.push(valueObj.gps_lat);
                        co.push(valueObj.gps_long);
                        co.push('');
                        co.push(valueObj.payment_status);
                        co.push(valueObj.invoice_no);
                        co.push(valueObj.owner_name);
                        co.push(valueObj.area_council);
                        co.push(valueObj.town);

                        locations.push(co);
                    });
                }

                //-  if(searchCode == '' && fullPay != '' || && partPay != ''||  noPay != '' && payType != '' ){
                if(searchCode == '' && mapType != '' && payType != '' ){
                    $.each(result, function(key,valueObj){
                        var co = [];

                        if(mapType == 'b'){
                            co.push(valueObj.buis_prop_code);
                        }else if(mapType == 'r'){
                            co.push(valueObj.res_code);
                        }else{
                            co.push(valueObj.buis_occ_code);
                        }
                        co.push(valueObj.gps_lat);
                        co.push(valueObj.gps_long);
                        co.push('');
                        co.push(valueObj.payment_status);
                        co.push(valueObj.invoice_no);
                        co.push(valueObj.owner_name);
                        co.push(valueObj.area_council);
                        co.push(valueObj.town);

                        locations.push(co);
                    });
                }

<<<<<<< HEAD
=======
             var options = {
                 center: new google.maps.LatLng(5.62526083, -0.23407540),
                 zoom: 12,
                 mapTypeId: google.maps.MapTypeId.ROADMAP, // ROADMAP HYBRID
                 //styles: []
>>>>>>> 10327c51320015d28a09468b58fb2a94495770b6

        console.log(locations);

         var options = {
             center: new google.maps.LatLng(5.62526083, -0.23407540),
             zoom: 12,
             mapTypeId: google.maps.MapTypeId.ROADMAP, // ROADMAP HYBRID
             //styles: []



         };

         map = new google.maps.Map(document.getElementById('map'), options);

         var infowindow = new google.maps.InfoWindow();
         var marker, i;
         for (i = 0; i < locations.length; i++) {
            if(locations[i][4] == 'FULLY_PAID'){
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                  });
            }else if(locations[i][4] == 'PARTLY_PAID'){
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        icon: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png'
                      });
            }else{
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                    //icon: 'http://maps.google.com/mapfiles/kml/pal2/icon2.png'
                  });
            }

           google.maps.event.addListener(marker, 'click', (function(marker, i) {
             return function() {
               infowindow.open(map, marker);
               infowindow.open(map, marker);
               infowindow.setContent('<h3>Information</h3><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Invoice No: '+ locations[i][5]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Bisness code: '+ locations[i][0]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Owner: '+ locations[i][6]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Area Council: '+ locations[i][7]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Town: '+ locations[i][8]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Status: '+ locations[i][4] );
               map.setZoom(map.getZoom()+1);
               map.setCenter(marker.getPosition());
               //map.panTo(center);
            }
           })(marker, i));



         }

}
});

}
//end




<?php else: ?>



  // *********** DEFAULT SEARCH   *********************************


    var map;
    //var bounds = new google.maps.LatLngBounds();///

    function initMap(){

        $.ajax({
            url: "<?php echo base_url().'MapApi/getLocationDetails';?>",
            type: 'POST',
            data: {flag: 'b', payment_status: '',area_council: "",town: "",property_code: "",year:"" },//  FULLY_PAID  PARTLY_PAID  NO_PAYMENT
            dataType: 'json',
            success: function (result) {

                $('#totalCount').html("<b>Total Records Found:</b> <b style='font-size: 25px'>"+result.length +'</b>');

                //console.log(result);
                var locations = new Array();
                $.each(result, function(key,valueObj){
                    var co = [];
                    co.push(valueObj.buis_prop_code);
                    co.push(valueObj.gps_lat);
                    co.push(valueObj.gps_long);
                    co.push('');
                    co.push(valueObj.payment_status);
                    co.push(valueObj.invoice_no);
                    co.push(valueObj.owner_name);
                    co.push(valueObj.area_council);
                    co.push(valueObj.town);

                    locations.push(co);
                    //locations.push(co);
                });
                //console.log(locations);



        console.log(locations);

<<<<<<< HEAD
         var options = {
             center: new google.maps.LatLng(5.62526083, -0.23407540),
             zoom: 12,
             mapTypeId: google.maps.MapTypeId.ROADMAP, // ROADMAP HYBRID
             //styles: []
=======
             var options = {
                 center: new google.maps.LatLng(5.62526083, -0.23407540),
                 zoom: 12,
                 mapTypeId: google.maps.MapTypeId.ROADMAP, // ROADMAP HYBRID
                 //styles: []
>>>>>>> 10327c51320015d28a09468b58fb2a94495770b6




         };

         map = new google.maps.Map(document.getElementById('map'), options);

         var infowindow = new google.maps.InfoWindow();
         var marker, i;
         for (i = 0; i < locations.length; i++) {
            if(locations[i][4] == 'FULLY_PAID'){
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                  });
            }else if(locations[i][4] == 'PARTLY_PAID'){
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        icon: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png'
                      });
            }else{
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
                  });
            }



           google.maps.event.addListener(marker, 'click', (function(marker, i) {
             return function() {
               infowindow.open(map, marker);
               infowindow.setContent('<h3>Information</h3><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Invoice No: '+ locations[i][5]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Bisness code: '+ locations[i][0]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Owner: '+ locations[i][6]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Area Council: '+ locations[i][7]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Town: '+ locations[i][8]
               + '<br/><img src="https://img.icons8.com/color/20/000000/map-editing.png"> Status: '+ locations[i][4] );
               map.setZoom(map.getZoom() + 1);
               map.setCenter(marker.getPosition());
             }
           })(marker, i));
         }

         map.panToBounds(bounds);  ///

}
});

}



<?php endif;?>




</script>

<script src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyA0WbaWigD_WfIzpjyNWFG3W8naBY_Ju48" async defer></script>