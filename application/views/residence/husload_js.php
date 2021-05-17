<script>
	$(document).ready(function(){
	    
        check_res_code();
        birth();
        check_religion();
        b_disability();
        var state = $('#nationality').val();
        if(state == 'Non-Ghanaian'){
            $('#count').fadeIn('slow');
            $('#nat').fadeIn('slow');
            $('#idn').fadeOut('slow');
            $('#idt').fadeOut('slow');
        }
        else{
            $('#count').fadeOut('slow');
            $('#nat').fadeOut('slow');
            $('#idn').fadeIn('slow');
            $('#idt').fadeIn('slow');
        }
        var status = $('#employment_status').val();
    
        if(status == 'Employed'){
	        $('#employed').fadeIn('slow');
	        $('#employed1').fadeIn('slow');
	        $('#selfemployed').fadeOut('slow');
	        $('#selfemployed1').fadeOut('slow');
	    }
	    else if(status == "Self-Employed"){
	        //alert("i got ya");
	        $('#employed').fadeOut('slow');
	        $('#employed1').fadeOut('slow');
	        $('#selfemployed').fadeIn('slow');
	        $('#selfemployed1').fadeIn('slow');
	    }else{
	        $('#employed').fadeOut('slow');
	        $('#selfemployed').fadeOut('slow');
	        $('#selfemployed').fadeOut('slow');
	        $('#selfemployed1').fadeOut('slow');
	    }
	});
</script>