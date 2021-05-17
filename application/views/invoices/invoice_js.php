<?php if($title == "Invoices"):?>
  <script>
    $(document).ready(function(){

      if($("#product").val() != ""){
          var product = $("#product").val();
          var category1 = $("#category1s").val(); 
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

                $('[name=category1] option').filter(function() {
                    return ($(this).val() == category1);
                }).prop('selected', true);
              },

              error: function (jqXHR, textStatus, errorThrown)
              {
                alert("error");

              }
          });
      }

      var category1 = $("#category1s").val();
      var category2 = $("#category2s").val(); 
      //alert("love you");
      // AJAX request
      $.ajax({
          url:"<?php echo base_url().'Invoice/get_product_category';?>",
          method: "POST",
          data: {id: category1, table: "product_category2", column: "category1_id"},
          dataType: "JSON",
          success: function(response){

              // Remove options
              $('#category2').find('option').not(':first').remove();

              // Add options
              $.each(response,function(index,data){
                  $('#category2').append('<option value="'+data['id']+'">'+data['name']+'</option>');
              });

              $('[name=category2] option').filter(function() {
                  return ($(this).val() == category2);
              }).prop('selected', true);
          },

          error: function (jqXHR, textStatus, errorThrown)
          {
              alert("error");

          }
      });
      
      var category2 = $("#category2s").val();
      var category3 = $("#category3s").val(); 
      //alert("love you");
      // AJAX request
      $.ajax({
          url:"<?php echo base_url().'Invoice/get_product_category';?>",
          method: "POST",
          data: {id: category2, table: "product_category3", column: "category2_id"},
          dataType: "JSON",
          success: function(response){

              // Remove options
              $('#category3').find('option').not(':first').remove();

              // Add options
              $.each(response,function(index,data){
                  $('#category3').append('<option value="'+data['id']+'">'+data['name']+'</option>');
              });

              $('[name=category3] option').filter(function() {
                  return ($(this).val() == category3);
              }).prop('selected', true);
          },

          error: function (jqXHR, textStatus, errorThrown)
          {
              alert("error");

          }
      });
      
      var category3 = $("#category3s").val();
      var category4 = $("#category4s").val(); 
      //alert("love you");
      // AJAX request
      $.ajax({
          url:"<?php echo base_url().'Invoice/get_product_category';?>",
          method: "POST",
          data: {id: category3, table: "product_category4", column: "category3_id"},
          dataType: "JSON",
          success: function(response){

              // Remove options
              $('#category4').find('option').not(':first').remove();

              // Add options
              $.each(response,function(index,data){
                  $('#category4').append('<option value="'+data['id']+'">'+data['name']+'</option>');
              });

              $('[name=category4] option').filter(function() {
                  return ($(this).val() == category4);
              }).prop('selected', true);
          },

          error: function (jqXHR, textStatus, errorThrown)
          {
              alert("error");

          }
      });
      
      var category4 = $("#category4s").val();
      var category5 = $("#category5ss").val(); 
      //alert("love you");
      // AJAX request
      $.ajax({
          url:"<?php echo base_url().'Invoice/get_product_category';?>",
          method: "POST",
          data: {id: category4, table: "product_category5", column: "category4_id"},
          dataType: "JSON",
          success: function(response){

              // Remove options
              $('#category5').find('option').not(':first').remove();

              // Add options
              $.each(response,function(index,data){
                  $('#category5').append('<option value="'+data['id']+'">'+data['name']+'</option>');
              });

              $('[name=category5] option').filter(function() {
                  return ($(this).val() == category5);
              }).prop('selected', true);
          },

          error: function (jqXHR, textStatus, errorThrown)
          {
              alert("error");

          }
      });
      
      var category5 = $("#category5ss").val();
      var category6 = $("#category6ss").val();

      // AJAX request
      $.ajax({
          url:"<?php echo base_url().'Invoice/get_product_category';?>",
          method: "POST",
          data: {id: category5, table: "product_category6", column: "category5_id"},
          dataType: "JSON",
          success: function(response){

              // Remove options
              $('#category6').find('option').not(':first').remove();

              // Add options
              $.each(response,function(index,data){
                  $('#category6').append('<option value="'+data['id']+'">'+data['name']+'</option>');
              });

              $('[name=category6] option').filter(function() {
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
<?php endif;?>
<?php if($title == "Transactions"):?>
<script>
	$(document).ready(function(){

    var state = $('#search_by').val();
    if(state == "Keyword"){
      document.getElementById("search_box").style.display= "inline-block";
      $('.criteria').css('display','none');
      document.getElementById("admin").style.display= "none";
      document.getElementById("agent").style.display= "none";
    }else if (state == "Criteria") {
      document.getElementById("search_box").style.display= "none";
      $('.criteria').css('display','inline');
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
    }else{
      	if(document.getElementById("search_box")){
		  document.getElementById("search_box").style.display= "none";
	      $('.criteria').css('display','none');
	      document.getElementById("admin").style.display= "none";
	      document.getElementById("agent").style.display= "none";
    	}
	}
});
</script>
<?php endif;?>
<script type="text/javascript">
  function invoiceStatus(id){
    //alert(id);
    if (document.getElementById(id).checked){
			var devstate = 1;
			//update to true
		}else{
			//update to false
			var devstate = 0;
		}

		var baseurl = "<?php echo base_url(); ?>";
		var xmlhttp = new XMLHttpRequest();
		var url1 = baseurl + "Invoice/update_print_status/" + id  + "/" + devstate ;
		var url = url1;

		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				myFunction(xmlhttp.responseText);
			}
		}
		xmlhttp.open("GET",url, true);
		xmlhttp.send();


		function myFunction(response) {
      alert("Successfully Updated")
			//document.getElementById("exampleTopRight").click();
		}

  }
</script>

<script type="text/javascript">
  $(document).on('change','#payment_mode',function(){
    var state = $('#payment_mode').val();
    if(state == 'Mobile Money'){
      $('.momo').css('display','inline');
      $('.cheque').css('display','none');
      $('.momo_number').css('display','none');
    }else if(state == 'Cheque'){
      $('.momo_number').css('display','none');
      $('.momo').css('display','none');
      $('.cheque').css('display','inline');
    }else if(state == 'Mobile Money Number'){
      $('.momo_number').css('display','inline');
      $('.momo').css('display','none');
      $('.cheque').css('display','none');
    }else{
      $('.momo').css('display','none');
      $('.cheque').css('display','none');
      $('.momo_number').css('display','none');
    }
  });

  $(document).on('change','#mobile_operator',function(){
    var mo_state = $('#mobile_operator').val();
    if(mo_state == 'Vodafone'){
      $('.momo_vouchercode').css('display','inline');
    }else{
      $('.momo_vouchercode').css('display','none');
    }
  });
</script>
<script type="text/javascript">

  $(document).on('change','#payment_type',function(){
    var state = $('#payment_type').val();
    if(state == 'Part Payment'){
      $('.pp').css('display','inline');
    }else{
      $('.pp').css('display','none');
    }
  });

  $(document).on('change','select[name=type_of_invoice]',function(){
    var toi = $(this).val();
    if(toi === 6){
      $('div.busname').css('display','inline');
    }else{
      $('div.busname').css('display','none');
    }
  });
  
</script>
<script type="text/javascript">
  $(document).on('change','#paid_by',function(){
    var state = $('#paid_by').val();
    if(state == 'others'){
      $('.paid_by').css('display','inline');
    }else{
      $('.paid_by').css('display','none');
    }
  });
</script>
<script type="text/javascript">

  function displayFinishPaymentButton(){
    $('#basicform input.inv-payment-btn').val('Finish Payment');
    $("#basicform input.inv-payment-btn").attr("disabled", false);  
    $('#momo-status').text('Mobile Money payment has been completed. Click ok "Finish Payment to complete transaction."'); 
    $('#momo-instructions').text('');
           
  }

  function checktxstatus(clienttransid){
    
    //function to query local db for status of transaction
    var loop = setInterval(function(){
      console.log('checking');
      $.ajax({
        url: "http://178.62.20.56/momo/checktxstatus",
        method: "POST",
        data: {clienttransid: clienttransid}, 
        dataType: "text",
        success: function(response){
            //console.log(response);
            if(response == 'PAID'){
              $('#momo_transaction_id').val(clienttransid);   
              displayFinishPaymentButton(response);
              clearInterval(loop);
            }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            return 'error';
          } 
        }); 
      }, 5000)
  }

	$('#basicform input.inv-payment-btn').click(function(e){
		e.preventDefault();
		let validated = $('#basicform').valid();
		let paymode = $('#basicform select[name=payment_mode]').val();
		let buttonval = $('#basicform input.inv-payment-btn').val();
		if( validated ) {
			if(buttonval !== "Finish Payment" && paymode !== 'Mobile Money'){
				let amount=0;
				if($('#amount_paid').closest('.pp').css('display') === 'block'){
					amount = 'GHS ' + $('#amount_paid').val() + ' as part payment of GHS ' + $('#invoice_amountt').val();
				} else {
					amount = 'GHS ' + $('#invoice_amountt').val();
				}
				let target = $('input[name=target]').val() || 0;
				let phone_no;
				if($('select[name=paid_by]').val() === "registered"){
          phone_no = $('input[name=contactno]').val();
				}	else {
					phone_no = $('.pay-invoice input[name=phone_no]').val();
				}
				ajaxHandler(null, "<?php echo base_url().'Invoice/send_otp';?>", "POST",
					{'phone_no': phone_no,'invoice_no': $('#invoice_no').val(), 'amount': amount},
					function(result){
						if(result.status === "success" && result.data.code == '1701'){
							$('.pay-invoice .otp').css('display', 'inline');
							$('#basicform input.inv-payment-btn').val('Finish Payment');
						}else{
							$('#error_notif').css('display', 'block');
						  $('#error_notif').html(result.data.message);
						}
					}
				);

			} else if(buttonval !== "Finish Payment" && paymode == 'Mobile Money'){
        //momo processing....
        $('#momo-status').text('Sending request to mobile wallet for approval');
        $('.momo-status').css('display','inline');

        clienttransid = Math.floor((Math.random() * 100000) + 1);

        paymentoption = $('#mobile_operator').val();
        walletnumber = $('#momo_number').val();
        amount_paid = $('#amount_paid').val();
        invoice_number = $('#invoice_number').val();
        payment_type = $('#payment_type').val();
        invoice_amountt = $('#invoice_amountt').val();
        let vouchercode = null;

        // if(paymentoption == 'Vodafone'){
        //   vouchercode = $('#momo_vouchercode').val();
        // }

        if(payment_type == 'Part Payment'){
          amount = amount_paid;
        }else{
          amount = invoice_amountt;
        }

        data = {
          paymentoption: paymentoption, 
          walletnumber: walletnumber, 
          amount: amount,
          clientreference: "RMS Invoice no: " + invoice_number,
          description: "RMS Invoice no: " + invoice_number,
          clienttransid: clienttransid,
          vouchercode: vouchercode
        };

        if(paymentoption == 'MTN'){
          momo_instruction = "<b>MTN Mobile Money Instructions</b><br /><font style='color:#ff0000'>1. Dial *170#  <br /> 2. Choose option: 6) Wallet <br /> 3. Choose option: 3) My Approvals <br /> 4. Enter your MOMO pin to retrieve your pending approval list <br /> 5. Choose a pending transaction <br /> 6. Choose option 1 to approve <br /> 7. Tap button to continue <br /> </font> <br /><br /> Transaction ends in 5:00 minutes"
        } else if(paymentoption == 'AirtelTigo'){
          momo_instruction = "<b>AirtelTigo Instructions</b><br /><font style='color:#ff0000'>1. Dial *501*5# to approve your transaction. <br />2. Select the transaction to approve and click on send. <br />3. Select YES to confirm your payment.</font> <br /><br /> Transaction ends in 5:00 minutes"
        } else if(paymentoption == 'Vodafone'){
          momo_instruction = "<b>Vodafone Cash Instructions</b><br /><font style='color:#ff0000'>1. Dial *110# and select option 6 on your vodafone line and generate a token<br /> 2. Please check phone and complete process <br /><br /> Transaction ends in 5:00 minutes"
        }

        $.ajax({
            url: "http://178.62.20.56/momo/receive",
            method: "POST",
            data: data, 
            dataType: "JSON",
            success: function(response){
              $('#momo-status').text('Request has been sent to mobile wallet. Please check phone and approve.');
              $('#momo-instructions').html(momo_instruction);
              $("#basicform input.inv-payment-btn").attr("disabled", true);
              $('#basicform input.inv-payment-btn').val('Awaiting approval....');

              checktxstatus(clienttransid);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");
            }
        });

      } else {
        document.getElementById("btn").disabled == true;
        document.getElementById("basicform").submit();
      }
    };
  });
</script>
<script type="text/javascript">
	$('#adj_btn').click(function(e){
		e.preventDefault();
		let validated = $('#basicform').valid();
		let paymode = $('#basicform select[name=payment_mode]').val();
		if( validated ) {
        document.getElementById("adj_btn").disabled == true;
        document.getElementById("basicform").submit();			
	  };
  });
</script>
<script type="text/javascript">
  $(document).on('change','#search_by',function(){

    var state = $('#search_by').val();
    if(state == "Keyword"){
      document.getElementById("search_box").style.display= "inline-block";
      $('.criteria').css('display','none');
      document.getElementById("admin").style.display= "none";
      document.getElementById("agent").style.display= "none";
    }else if (state == "Criteria") {
      document.getElementById("search_box").style.display= "none";
      $('.criteria').css('display','inline');
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
    }else{
      document.getElementById("search_box").style.display= "none";
      $('.criteria').css('display','none');
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
<script>
  $(document).on('change','#invoice_for',function(){

    var state = $('#invoice_for').val();
    if(state == "1"){
      document.getElementById("company").style.display= "none";
    }else if (state == "2") {
      document.getElementById("company").style.display= "flex";
    }else{
      document.getElementById("company").style.display= "none";
    }
  });
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
<script type="text/javascript">
  $('#category1').change(function(){
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
        $('#category2').find('option').not(':first').remove();

        // Add options
        $.each(response,function(index,data){
            $('#category2').append('<option value="'+data['id']+'">'+data['name']+'</option>');
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
  $('#category2').change(function(){
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
          $('#category3').find('option').not(':first').remove();

          // Add options
          $.each(response,function(index,data){
              $('#category3').append('<option value="'+data['id']+'">'+data['name']+'</option>');
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
  $('#category3').change(function(){
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
        $('#category4').find('option').not(':first').remove();

        // Add options
        $.each(response,function(index,data){
            $('#category4').append('<option value="'+data['id']+'">'+data['name']+'</option>');
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
  $('#category4').change(function(){
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
        $('#category5').find('option').not(':first').remove();

        // Add options
        $.each(response,function(index,data){
            $('#category5').append('<option value="'+data['id']+'">'+data['name']+'</option>');
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
  $('#category5').change(function(){
    var category5 = $(this).val();
    
    // AJAX request
    $.ajax({
      url:"<?php echo base_url().'Invoice/get_product_category';?>",
      method: "POST",
      data: {id: category5, table: "product_category6", column: "category5_id"},
      dataType: "JSON",
      success: function(response){
          // Remove options
          $('#category6').find('option').not(':first').remove();
          // Add options
          $.each(response,function(index,data){
            $('#category6').append('<option value="'+data['id']+'">'+data['name']+'</option>');
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
    $('#w4-area_council').change(function(){
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
            $('#w4-town').find('option').not(':first').remove();

            // Add options
            $.each(response,function(index,data){
                $('#w4-town').append('<option value="'+data['id']+'">'+data['town']+'</option>');
            });
        },

        error: function (jqXHR, textStatus, errorThrown)
        {
            alert("error");

        }
    });
});
</script>
