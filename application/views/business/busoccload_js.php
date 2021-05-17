<script>
	$(document).ready(function(){
		check_busprop_code();
	    do_checks();
		accessed();
	    var state=document.getElementById('type_of_building').value;
		    var state = $('#type_of_building').val();
		    if(state == 'Temporary'){
		        $('#temp').fadeIn('slow');
		    }
		    else{
		        $('#temp').fadeOut('slow');
		    }
	});
</script>