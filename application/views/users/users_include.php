<script>
function check_username(){

	var baseurl = "<?php echo base_url(); ?>";
	var code = document.getElementById("username").value;	
	var n = code.length;

	if (n == "0") {
		document.getElementById("status").innerHTML= "" ;
	}

		var url = baseurl + "Users/search_user/" + code  ;
		
		
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
	
			for (var i = 0; i < arr.length; i++) {
		
			
			var userid = arr[i].user_id;
			
			if (userid != "") {
				
				document.getElementById("status").style.display = 'inline-block';
				document.getElementById("status").innerHTML = "This user name is already taken";
				document.getElementById("save").disabled  = true ;
				
				
			}
			
		}
			
			
		}
		
	
}


function initiate_delete(x){
		deleteid = x;
		document.getElementById("dpop").click();
}

    //event delete

</script>
<script type="text/javascript">
    $('#chckHead').click(function () {
        if (this.checked == false) {
            $('.chcktbl:checked').attr('checked', false);
        }
        else {
            $('.chcktbl:not(:checked)').attr('checked', true);
        }
    });
    $('#chckHead').click(function () {
    });
</script>
<script type="text/javascript">
    $("#btnet1").click(function(){
        var validated = $('#form1').valid();
        if( validated ) {
            document.getElementById("form1").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
    $("#btnet2").click(function(){
        var validated = $('#form2').valid();
        if( validated ) {
            document.getElementById("form2").submit();
        }else{
            //alert("error")
        }
    })
</script>
<script type="text/javascript">
	 //user delete
    (function() {

        $('.deleteUser').on("click", function() {
        var id = deleteid; //this.id
          swal({
              title: "Are you sure?",
              text: "You are about to delete this Users's account" ,
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#DD6B55',
              confirmButtonText: 'Yes, delete it!',
              cancelButtonText: "No, cancel!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm) {
              if (isConfirm) {
          //alert("Deleted");
          
          var baseurl = "<?php echo base_url(); ?>";
          var url = baseurl + "users/delete_user/" + id ;
    
          var xmlhttp = new XMLHttpRequest();

          xmlhttp.onreadystatechange=function() {
            if (this.readyState == 4 && this.status == 200) {
              myFunction(this.responseText);
            }
          }
          xmlhttp.open("GET", url, true);
          xmlhttp.send();

          function myFunction(response) {
            swal("Deleted!","User " + " has been sucessfuly deleted!","success");
          
          }
          window.location.href = "<?=base_url()?>users";
          
                
              } else {
         
                swal("Cancelled", "Delete cancelled by user","error");
              }
            });
        });
      })();
</script>
<script>
    function draw_table(){
          $('#content').fadeIn('slow').load('<?=base_url()?>Users/redraw_table',function() {

          });
    }
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
        var url1 = baseurl + "Users/update_status/" + checkbox  + "/" + state ;
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