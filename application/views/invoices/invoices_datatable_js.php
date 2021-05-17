<script>
	(function($) {

	'use strict';
	var datatableInit = function() {
		var $table = $('#datatable-tabletools-invoices');

			var table = $table.dataTable({
				// sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
				// buttons: [ 'print', 'excel', 'pdf' ],
				scrollX: true,
				processing: true,
				serverSide: true,
				serverMethod: 'post',
				ajax: {
				'url':'<?=base_url()?>Invoice/invoiceList',
				"data": function ( d ) {
						d.product = '<?=$product?>',
						d.category1 = '<?=$category1?>',
						d.category2 = '<?=$category2?>',
						d.category3 = '<?=$category3?>',
						d.category4 = '<?=$category4?>',
						d.category5 = '<?=$category5?>',
						d.category6 = '<?=$category6?>',
						d.year = '<?=$year?>'
					}
				},
				columns: [
					{ data: 'invoice_no' },
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["property_code"];
						}
					},
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["owner_name"];
						}
					},
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["product"];
						}
					},
					{ data: 'invoice_amount' },
					{ data: 'adjustment_amount' },
					{ data: 'amount_paid' },
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["outstanding_amount"];
						}
					},
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["assessed"];
						}
					},
					{ data: 'category1' },
					{ data: 'category2' },
					{ data: 'category3' },
					{ data: 'category4' },
					{ data: 'category5' },
                    { data: 'category6' },
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["switch"];
						}
					},
					{ data: 'date_created' },
					{ data: 'payment_due_date' }
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

