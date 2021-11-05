<script type="text/javascript">
   $('#rating_mode').on('change',function(){
        if( $(this).val()==="dimensions"){
        $("#size").show()
        $("#metrics").show()
        }
        else{
        $("#size").hide()
        $("#metrics").hide()
        }
    });
</script>

<script type="text/javascript">
   $('#rating_mode').on('change',function(){
        if( $(this).val()==="fee_fixing"){
        $("#cat1_col").show()
        }
        else{
        $("#cat1_col").hide()
        $("#cat2_col").hide()
        $("#cat3_col").hide()
        $("#cat4_col").hide()
        $("#cat5_col").hide()
        $("#cat6_col").hide()
        }
    });
</script>

<script type="text/javascript">
   $('#outdoor_owner_name').on('change',function(){
        if( $(this).val()=== "8"){
        $("#outdoor_other").show()
        }
        else{
        $("#outdoor_other").hide()
        }
    });
</script>

<script type="text/javascript">
   $('#outdoor_category').on('change',function(){
        if( $(this).val()==="commercial"){
        $("#outdoor_name").show()
        }
        else{
        $("#outdoor_name").hide()
        }
    });
</script>

<script type="text/javascript">
   $('#outdoor_category').on('change',function(){
        if( $(this).val()==="private"){
        $("#signage_business_code").show()
        $("#business_n").show()
        }
        else{
        $("#signage_business_code").hide()
        $("#business_n").hide()
        }
    });
</script>

<!-- <script type="text/javascript">
 function conduct_checks(){

 }
</script> -->

<script type="text/javascript">
function check_busocc_code(){

var username = document.getElementById("buis_occ_code").value;
var baseurl = "<?php echo base_url(); ?>";
var n = username.length;
if(n < 11){
    document.getElementById("status").style.display= "inline-block";
    document.getElementById("save").style.display = 'none';
    document.getElementById("statuss").style.display = "none";
}else{
    var url = baseurl + "Food/search_business_occ_code/" + username;
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
            document.getElementById("save").style.display = 'none';
            document.getElementById("statuss").style.display = "none";
        }else{
            for (var i = 0; i < arr.length; i++) {
                var userid = arr[i].id;
                if(userid !== "") {

                    document.getElementById("status").style.display = 'none';
                    document.getElementById("save").style.display = 'block';
                    document.getElementById("statuss").style.display = "inline-block";

                }
            }
        }
    }
}

}
</script>
<script type="text/javascript">
    $('#area_council').change(function(){
    var area = $(this).val();
    //alert(classes);
    // AJAX request
    $.ajax({
        url:"<?php echo base_url().'Food/get_area_towns';?>",
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

<script>
  function delete_modal(id, signage_code) {
    $('#code').html(signage_code);
    $('#signage_code').val(signage_code);
    $('#signage_id').val(id);
    jQuery('#delete_signage_record').modal('show', {
      backdrop: 'static'
    });
  }
</script>
<!-- 
<script type="text/javascript">
//used for handling sending of messages
$(function() {
	var alertCtrlObj = $('#tab-alert'),
		alertMsgContainerObj = alertCtrlObj.find('#alert-msg-container'),
		showAlert = function (alertCtrl, alertMsgContainer, alertType, alertMsg) {
			var alertClass = "",
				possibleAlertClasses = [
					'alert-danger', 'alert-warning', 'alert-success'];
			if (alertType == "error") {
				alertClass = "alert-danger";
			} else if (alertType == 'warning') {
				alertClass = 'alert-warning';
			} else {
				alertClass = 'alert-success';
			}
			alertCtrl.removeClass('show');
			alertCtrl.addClass('hidden');
			for(var index in possibleAlertClasses) {
				alertCtrl.removeClass(possibleAlertClasses[index]);
			}
			alertMsgContainer.text(alertMsg);
			alertCtrl.addClass(alertClass);
			alertCtrl.removeClass('hidden');
			alertCtrl.addClass('show');
		};

	$('body').on('click', '#btnn', function(event) {
		event.preventDefault();
		var msgForm = $('#basicFormm'),
			formEntryIsValid = msgForm.valid(),
			messageType = msgForm.find('#message_type').val(),
			primaryContact = msgForm.find('#primary_contact').val(),
			email = msgForm.find('#email').val(),
			msgContent = msgForm.find('#message').val(),
			actionUrl = msgForm.attr('action');

		if (formEntryIsValid) {
			var postData = {
				'message_type': messageType,
				'email': email,
				'primary_contact': primaryContact,
				'message': msgContent
			};
			$.ajax({
                'url': actionUrl,
                'data': postData,
                'method': 'post',
                'dataType': 'json'
            }).done(function(data) {
                var msg = "Message has been sent";
                showAlert(alertCtrlObj, alertMsgContainerObj, 'success', msg);
            }).fail(function(data) {
                var msg = "Sending Message failed kindly try again";
                showAlert(alertCtrlObj, alertMsgContainerObj, 'error', msg);
            });
		}
	});

	$('body').on('click', '#close-sms-alert', function (event) {
		event.preventDefault();
		alertCtrlObj.addClass('hidden');
	});

});
</script>
 -->


