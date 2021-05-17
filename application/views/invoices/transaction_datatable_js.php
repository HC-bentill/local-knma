<script>
	(function($) {

	'use strict';
	var datatableInit = function() {
		var $table = $('#datatable-tabletools-transactions');

			
			var table = $table.dataTable({
				// sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
				// buttons: [ 'print', 'excel', 'pdf' ],
				scrollX: true,
				processing: true,
				serverSide: true,
				serverMethod: 'post',
				ajax: {
				    'url':'<?=base_url()?>Invoice/transactionList',
                    "data": function ( d ) {
							d.start_date = '<?=$start_date?>',
							d.end_date = '<?=$end_date?>',
							d.payment_mode = '<?=$payment_mode?>',
							d.category = '<?=$category?>',
							d.agent = '<?=$agentid?>',
							d.admin = '<?=$admin?>',
							d.status = '<?=$status?>',
							d.transaction_type = '<?=$transaction_type?>'
						}
				},
				columns: [
                    
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["invoice_no"];
						}
					},
                    { data: 'transaction_id' },
					{ data: 'gcr_no' },
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["transaction_type"];
						}
					},
                    { data: 'payment_mode' },
                    { data: 'amount' },
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["status"];
						}
					},
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["identifier"];
						}
					},
                    { data: 'payer_name' },
                    { data: 'payer_phone' },
                    { data: 'channel' },
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["collector"];
						}
					},
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["datetime"];
						}
					},
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["reciept"];
						}
					},
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["photo"];
						}
					},
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["reversal"];
						}
					}
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

