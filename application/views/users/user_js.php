<script>
    $(document).ready(function(){
        var state = $('#category').val();
        if(state == "admin"){
        document.getElementById("admin").style.display= "inline-block";
        document.getElementById("agent").style.display= "none";
        }else if (state == "agent") {
        document.getElementById("admin").style.display= "none";
        document.getElementById("agent").style.display= "inline-block";
        }else{
        document.getElementById("admin").style.display= "none";
        document.getElementById("agent").style.display= "none";
    }
    });
</script>
<script type="text/javascript">
  $(document).on('change','#category',function(){

    var state = $('#category').val();
    if(state == "admin"){
      document.getElementById("admin").style.display= "inline-block";
      document.getElementById("agent").style.display= "none";
    }else if (state == "agent") {
      document.getElementById("admin").style.display= "none";
      document.getElementById("agent").style.display= "inline-block";
    }else{
      document.getElementById("admin").style.display= "none";
      document.getElementById("agent").style.display= "none";
    }
  });
</script>
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
        var url1 = baseurl + "User/update_status/" + checkbox  + "/" + state ;
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