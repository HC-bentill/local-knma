<script>
	$(document).ready(function() {
		var state = $('#search_by').val();
		if (state == "Keyword") {
			document.getElementById("search_box").style.display = "inline-block";
			document.getElementById("search_box1").style.display = "inline-block";
			document.getElementById("date1").style.display = "none";
			document.getElementById("date2").style.display = "none";
		} else if (state == "Date") {
			document.getElementById("search_box").style.display = "none";
			document.getElementById("search_box1").style.display = "none";
			document.getElementById("date1").style.display = "inline-block";
			document.getElementById("date2").style.display = "inline-block";
		}
	});
</script>
<script type="text/javascript">
	$(document).on('change', '#search_by', function() {

		var state = $('#search_by').val();
		if (state == "Keyword") {
			document.getElementById("search_box").style.display = "inline-block";
			document.getElementById("search_box1").style.display = "inline-block";
			document.getElementById("date1").style.display = "none";
			document.getElementById("date2").style.display = "none";
		} else if (state == "Date") {
			document.getElementById("search_box").style.display = "none";
			document.getElementById("search_box1").style.display = "none";
			document.getElementById("date1").style.display = "inline-block";
			document.getElementById("date2").style.display = "inline-block";
		} else {
			document.getElementById("search_box").style.display = "none";
			document.getElementById("search_box1").style.display = "none";
			document.getElementById("date1").style.display = "none";
			document.getElementById("date2").style.display = "none";
		}
	});
</script>
<script type="text/javascript">
    function amount_type(){
        var state = document.getElementById("amount_type").value;
        //alert(prop);
        if( state == "fixed_amount"){
            $('#amount').fadeIn('slow');
        }else{
            $('#amount').fadeOut('slow');
        }
    }
</script>
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