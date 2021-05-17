<?php if($title == "Invoice Distribution"):?>
  <script>
    $(document).ready(function(){

      if($("#electoral_area").val()){
        var area = <?=$electoral_area?>;
        var town = <?=$town?>;
        
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
                    return ($(this).val() == town);
                }).prop('selected', true);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              alert("error");
            }
        });
      }
    });

  </script>
<?php endif;?>
<script type="text/javascript">
  $('#electoral_area').change(function(){
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
<?php if($title == "Batch Print Invoice"):?>
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
<?php endif; ?>
<script type="text/javascript">
	$(document).on('change', '#amount_type', function() {

		var state = $('#amount_type').val();
		if (state == "fixed_amount") {
			document.getElementById("amount").style.display = "inline-block";
		} else if (state == "fee_fixing") {
			document.getElementById("amount").style.display = "none";
		} else {
			document.getElementById("amount").style.display = "none";
		}
	});
</script>
