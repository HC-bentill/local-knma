<script type="text/javascript">
    $(".open1").click(function() {
        $(".frm").hide("fast");
        $("#sf2").show("slow");
        document.getElementById("no_of_floors").disabled = true;
    });

    $(".open2").click(function() {
        $(".frm").hide("fast");
        $("#sf3").show("slow");
    });

    $(".open3").click(function() {
        $(".frm").hide("fast");
        $("#sf4").show("slow");
    });

    $(".open4").click(function() {
        $(".frm").hide("fast");
        $("#sf5").show("slow");
    });

    $(".open5").click(function() {
        $(".frm").hide("fast");
        $("#sf6").show("slow");
    });
    $(".back2").click(function() {
      $(".frm").hide("fast");
      $("#sf1").show("slow");
    });

    $(".back3").click(function() {
      $(".frm").hide("fast");
      $("#sf2").show("slow");
    });
    $(".back4").click(function() {
      $(".frm").hide("fast");
      $("#sf3").show("slow");
    });
    $(".back5").click(function() {
      $(".frm").hide("fast");
      $("#sf4").show("slow");
    });
    $(".back6").click(function() {
      $(".frm").hide("fast");
      $("#sf5").show("slow");
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
    else if(state == 'Ghanaian'){
        $('#count').fadeOut('slow');
        $('#nat').fadeOut('slow');
        $('#idn').fadeIn('slow');
        $('#idt').fadeIn('slow');
    }else{
        $('#count').fadeOut('slow');
        $('#nat').fadeOut('slow');
        $('#idn').fadeOut('slow');
        $('#idt').fadeOut('slow');
    }
  });
</script>
<script>
    $(document).ready(function(){
        // date picker
        $('.calender').datepicker({dateFormat:'yy-mm-dd'});
    });
</script>
<script type="text/javascript">
  function get_street(){
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
  }
</script>
<script type="text/javascript">
  function res_div(){
    var state = $('#has_res_code').val();
    if(state == 'Yes'){
        $('#code').fadeIn('slow');
        $('#location').fadeOut('slow');
        $('#location2').fadeOut('slow');
    }
    else if(state == 'No'){
        $('#code').fadeOut('slow');
        $('#location').fadeIn('slow');
        $('#location2').fadeIn('slow');
    }else{
        $('#code').fadeOut('slow');
        $('#location').fadeOut('slow');
        $('#location2').fadeOut('slow');
    }
  }
</script>
<script>
function check_res_code(){

    var baseurl = "<?php echo base_url(); ?>";
    var username = document.getElementById("res_prop_code").value;    
    var n = username.length;
    if (n == "0") { 
        document.getElementById("status").style.display= "inline-block";
        document.getElementById("statuss").style.display = "none";
        document.getElementById("save").disabled  = true;
    }
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
            document.getElementById("save").disabled  = true; 
        }else{
        for (var i = 0; i < arr.length; i++) {
        var userid = arr[i].id;
        if(userid !== "") {

            document.getElementById("status").style.display = 'none';
            document.getElementById("statuss").style.display = "inline-block";
            document.getElementById("save").disabled  = false;
            
        }
        }
        }

        
        
    }
        
    
}
</script>
<script>
function check_res_code(){

    var baseurl = "<?php echo base_url(); ?>";
    var username = document.getElementById("res_prop_code").value;    
    var n = username.length;
    if (n == "0") { 
        document.getElementById("status").style.display= "inline-block";
        document.getElementById("statuss").style.display = "none";
        document.getElementById("save").disabled  = true;
    }
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
            document.getElementById("save").disabled  = true; 
        }else{
        for (var i = 0; i < arr.length; i++) {
        var userid = arr[i].id;
        if(userid !== "") {

            document.getElementById("status").style.display = 'none';
            document.getElementById("statuss").style.display = "inline-block";
            document.getElementById("save").disabled  = false;
            
        }
        }
        }

        
        
    }
        
    
}
</script>