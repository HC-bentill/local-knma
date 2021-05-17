
<!-- start: page -->
  <div class="row">
    <div class="col-md-12">
      <section class="card">
           <div id="dvMap"></div>
            <div id="mapPanel" class="row dropSheet">
              
              <div class="form-group row">
                <div class="col-sm-6">
                  <label class="control-label text-sm-right pt-2"><strong>Source:</strong></label>
                  <input type="text" class="form-control" id="txtSource" value="Nzulenzu, Ghana">
                </div>
              </div>
              <div class="col-sm-6">
                <label class="control-label text-sm-right pt-2"><strong>Business Property Code:</strong></label>
                <input type="text" class="form-control" onKeyUp="check_busprop_code();" id="buis_property_code" >
                <span id="status" class="badge badge-danger" style="display:none">Invalid</span>
                <span id="statuss" class="badge badge-success" style="display:none">Valid</span>
              </div>  
              <div class="form-group row">
                <div class="col-sm-6">
                  <button type="button" id="route" onclick="GetRoute()" class="btn btn-success" style="margin-top:0.5em;" disabled="">Get Routes</button>
                </div>
              </div>
              <div class="col-md-12">
                <div id="dvPanel"></div>
              </div>
              <div class="col-md-12">
                <div id="dvDistance"></div>
              </div>    
            </div>
      </section>
    </div>
  </div>
  
<!-- end: page --> 
<script async defer 
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgEMcP8mSrlPeI8jMLVh9PU7RBrQZVJ6I&callback=initMap&libraries=places">
</script> 
<script>		
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('dvMap'), {
        zoom: 16,
        center: new google.maps.LatLng(5.6379, -0.1612),
        mapTypeId: 'roadmap'
      });
    }
</script> 
<script type="text/javascript">
  var source, destination, lat, long;
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  google.maps.event.addDomListener(window, 'load', function () {
      new google.maps.places.SearchBox(document.getElementById('txtSource'));
      directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true });
  });
  
  function GetRoute() {
      
      var username = document.getElementById("buis_property_code").value; 
      var baseurl = "<?php echo base_url(); ?>";
      var xmlhttp = new XMLHttpRequest();
      var url = baseurl + "Business/search_business_prop_latlong/" + username; 
      
      xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              myFunction(xmlhttp.responseText);
          }
      }

      xmlhttp.open("GET", url, true);
      xmlhttp.send();

      function myFunction(response) {
        
        var arr = JSON.parse(response);
        for (var i = 0; i < arr.length; i++) {
          lat = arr[i].gps_lat;
          long = arr[i].gps_long;
        }
       
      var mumbai = new google.maps.LatLng(4.9387, -2.3493);
      var mapOptions = {
          zoom: 10,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: mumbai,
          panControl: true,
          gestureHandling: 'cooperative'
      };
    
      map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);
      directionsDisplay.setMap(map);
      directionsDisplay.setPanel(document.getElementById('dvPanel'));

      //*********DIRECTIONS AND ROUTE**********************//
      source = document.getElementById("txtSource").value;
      destination = new google.maps.LatLng(lat, long);
      var request = {
          origin: source,
          destination: new google.maps.LatLng(lat, long),
          travelMode: google.maps.TravelMode.DRIVING
      };
      directionsService.route(request, function (response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
          }
      });

      //*********DISTANCE AND DURATION**********************//
      var service = new google.maps.DistanceMatrixService();
      service.getDistanceMatrix({
          origins: [source],
          destinations: [destination],
          travelMode: google.maps.TravelMode.DRIVING,
          unitSystem: google.maps.UnitSystem.METRIC,
          avoidHighways: false,
          avoidTolls: false
      }, function (response, status) {
          if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
              var distance = response.rows[0].elements[0].distance.text;
              var duration = response.rows[0].elements[0].duration.text;
              var dvDistance = document.getElementById("dvDistance");
              dvDistance.innerHTML = "";
              dvDistance.innerHTML += "<strong>Distance</strong>: " + distance + "<br />";
              dvDistance.innerHTML += "<strong>Duration</strong>: " + duration;


          } else {
   
            alert("Sorry Route Not Found Via Road");
          }
      });
      };
  }
</script> 

<script>
  function check_busprop_code(){

    var username = document.getElementById("buis_property_code").value;  
    var baseurl = "<?php echo base_url(); ?>";  
    var n = username.length;
    if(n < 11){
        document.getElementById("status").style.display= "inline-block";
        document.getElementById("statuss").style.display = "none";
        document.getElementById("route").disabled = true;
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
                        document.getElementById("route").disabled = false;
                    }
                }
            }  
        }  
    }       
    
}
</script>

  


 

  


 
  