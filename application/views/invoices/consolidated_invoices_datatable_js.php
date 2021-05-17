<script>
	(function($) {
		'use strict';
		var datatableInit = function() {
			var $table = $('#datatable-tabletools-invoices');

			var table = $table.dataTable({
				scrollX: true,
				processing: true,
				serverSide: true,
				serverMethod: 'post',
				ajax: {
					'url':'<?=base_url()?>Invoice/consolidatedInvoiceList'
				},
				columns: [
					// { data: 'invoice_no' },
					{"data": 'primary_contact'},
					{ "data": 'null',
						"render": function(data, type, full, meta){
							return full["owner_name"];
						}
					},
					{"data": 'invoice_count'},
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["invoice_amount"];
						}
					},
					{ data: 'adjustment_amount' },
					{ data: 'amount_paid' },
					{ data: 'outstanding_amount' },
					{"data": 'secondary_contact'},
				]
			});

		};

		$(function() {
			datatableInit();
		});

	}).apply(this, [jQuery]);
</script>

