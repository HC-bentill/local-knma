

<script>
	(function($) {

	'use strict';

	var datatableInit = function() {
		var $table = $('#datatable-tabletools-products');

			
			var table = $table.dataTable({
				// sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
				// buttons: [ 'print', 'excel', 'pdf' ],
				scrollX: true,
				processing: true,
				serverSide: true,
				serverMethod: 'post',
				ajax: {
				'url':'<?=base_url()?>Product/productList'
				},
				columns: [
					{ data: 'product' },
					{ data: 'category1' },
					{ data: 'category2' },
					{ data: 'category3' },
					{ data: 'category4' },
					{ data: 'category5' },
					{ data: 'category6' },
					{ data: 'frequency' },
					{ data: 'unit_of_measure' },
					{ data: 'price1' },
					{ data: 'price2' },
					{ data: 'price3' },
					{ data: 'price4' },
					{ data: 'price5' }
				]
			});

			// $('<div />').addClass('dt-buttons mb-2 pb-1 text-right').prependTo('#datatable-tabletools_wrapper');

			// $table.DataTable().buttons().container().prependTo( '#datatable-tabletools_wrapper .dt-buttons' );

			// $('#datatable-tabletools_wrapper').find('.btn-secondary').removeClass('btn-secondary').addClass('btn-default');
		};

		$(function() {
			datatableInit();
		});

	}).apply(this, [jQuery]);
</script>


