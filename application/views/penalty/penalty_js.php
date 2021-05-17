
<script type="text/javascript">
    $(document).ready(function (e) {
        $('.subcat').addClass('hidden');
    })
    //determine whether to show amount or percentage text box
    $('#penalty_mode').change(function(){
        var penalty_mode = $(this).val();

        if(penalty_mode == 'Fixed'){
            $('.percentage').addClass('hidden');
            $('.fixed_percentage').addClass('hidden');
            $('.amount').removeClass('hidden');

        }else if(penalty_mode == 'Percentage'){
            $('.amount').addClass('hidden');
            $('.fixed_percentage').addClass('hidden');
            $('.percentage').removeClass('hidden');

        }else if(penalty_mode == 'Fixed_Percentage'){
            $('.amount').addClass('hidden');
            $('.percentage').addClass('hidden');
            $('.fixed_percentage').removeClass('hidden');

    }
    });

    $("#apply").change(function() {
        if(this.checked) {
            $('.subcat').removeClass('hidden');
        }else{
            $('.subcat').addClass('hidden');
        }
    });

    function clearselect(i){
        while(i < 7){
            var cat_select = $('.category'+i+'_name');
            cat_select.find('option').remove();
            cat_select.append('<option value="">Select an option</option>');
            i++;
        }

    }

</script>


<script type="text/javascript">
    //fill category 2 select
    $('.productname').change(function(){
        var product_id = $(this).val();
        var cat1_select = $('.category1_name');

        // AJAX request
        $.ajax({
            url:"<?php echo base_url().'Product/get_category1';?>",
            method: "POST",
            data: {product_id: product_id},
            dataType: "JSON",
            success: function(response){
                // Remove options
                cat1_select.find('option').remove();

                // Add options
                cat1_select.append('<option value="">Select an option</option>');
                $.each(response,function(index,data){
                    cat1_select.append('<option value="'+data['id']+'">'+data['name']+'</option>');
                });

                //clear categories below
                clearselect(2);
            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });
    });

    $('.category1_name').change(function(){
        var cat1_id = $(this).val();
        var cat2_select = $('.category2_name');

        // AJAX request
        $.ajax({
            url:"<?php echo base_url().'Product/get_category';?>",
            method: "POST",
            data: {cat_column_id: 2, cat_id: cat1_id},
            dataType: "JSON",
            success: function(response){
                // Remove options
                cat2_select.find('option').remove();

                // Add options
                cat2_select.append('<option value="">Select an option</option>');
                $.each(response,function(index,data){
                    cat2_select.append('<option value="'+data['id']+'">'+data['name']+'</option>');
                });

                //clear categories below
                clearselect(3);
            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });
    });

    //fill category 3 select
    $('.category2_name').change(function(){
        var cat2_id = $(this).val();
        var cat3_select = $('.category3_name');

        // AJAX request
        $.ajax({
            url:"<?php echo base_url().'Product/get_category';?>",
            method: "POST",
            data: {cat_column_id: 3, cat_id: cat2_id},
            dataType: "JSON",
            success: function(response){
                // Remove options
                cat3_select.find('option').remove();

                // Add options
                cat3_select.append('<option value="">Select an option</option>');
                $.each(response,function(index,data){
                    cat3_select.append('<option value="'+data['id']+'">'+data['name']+'</option>');
                });

                //clear categories below
                clearselect(4);
            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });
    });

    //fill category 4 select upon category 3 select change
    $('.category3_name').change(function(){
        var cat3_id = $(this).val();
        var cat4_select = $('.category4_name');

        // AJAX request
        $.ajax({
            url:"<?php echo base_url().'Product/get_category';?>",
            method: "POST",
            data: {cat_column_id: 4, cat_id: cat3_id},
            dataType: "JSON",
            success: function(response){
                // Remove options
                cat4_select.find('option').remove();

                // Add options
                cat4_select.append('<option value="">Select an option</option>');
                $.each(response,function(index,data){
                    cat4_select.append('<option value="'+data['id']+'">'+data['name']+'</option>');
                });

                //clear categories below
                clearselect(5);
            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });
    });

    //fill category 5 select upon category 4 select change
    $('.category4_name').change(function(){
        var cat4_id = $(this).val();
        var cat5_select = $('.category5_name');

        // AJAX request
        $.ajax({
            url:"<?php echo base_url().'Product/get_category';?>",
            method: "POST",
            data: {cat_column_id: 5 , cat_id: cat4_id},
            dataType: "JSON",
            success: function(response){
                // Remove options
                cat5_select.find('option').remove();

                // Add options
                cat5_select.append('<option value="">Select an option</option>');
                $.each(response,function(index,data){
                    cat5_select.append('<option value="'+data['id']+'">'+data['name']+'</option>');
                });

                //clear categories below
                clearselect(6);
            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });
    });

    //fill category 6 select upon category 4 select change
    $('.category5_name').change(function(){
        var cat5_id = $(this).val();
        var cat6_select = $('.category6_name');

        // AJAX request
        $.ajax({
            url:"<?php echo base_url().'Product/get_category';?>",
            method: "POST",
            data: {cat_column_id: 6 , cat_id: cat5_id},
            dataType: "JSON",
            success: function(response){
                // Remove options
                cat6_select.find('option').remove();

                // Add options
                cat6_select.append('<option value="">Select an option</option>');
                $.each(response,function(index,data){
                    cat6_select.append('<option value="'+data['id']+'">'+data['name']+'</option>');
                });

            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                alert("error");

            }
        });
    });
</script>
