<script type="text/javascript">
    function checkAddress(checkbox){
    
        if (document.getElementById(checkbox).checked){
          var state = "1";
          //update to true
        }else{
          //update to false
          var state = "0";
        }

        var baseurl = "<?php echo base_url(); ?>";       
        var xmlhttp = new XMLHttpRequest();
        var url1 = baseurl + "Channel/update_status/" + checkbox  + "/" + state ;
        var url = url1;   
        
        xmlhttp.onreadystatechange=function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            myFunction(xmlhttp.responseText);
          }
        }

        xmlhttp.open("GET",url, true);
        xmlhttp.send();
        
        
        function myFunction(response) {
          window.location.reload(false);
        }
    }
</script>