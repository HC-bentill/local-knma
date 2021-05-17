<script>
	(function($) {

	'use strict';
	var datatableInit = function() {
		var $table = $('#datatable-tabletools-invoice-distribution');

			
			var table = $table.dataTable({
				// sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
				// buttons: [ 'print', 'excel', 'pdf' ],
				scrollX: true,
				processing: true,
				serverSide: true,
				serverMethod: 'post',
				ajax: {
				    'url':'<?=base_url()?>Invoice/invoiceDistributionList',
                    "data": function ( d ) {
							d.start_date = '<?=$start_date?>',
							d.end_date = '<?=$end_date?>',
							d.area = '<?=$electoral_area?>',
							d.town = '<?=$town?>',
                            d.bill_type = '<?=$bill_type?>'
						}
				},
				columns: [
					{ data: 'invoice_no'},
                    { data: null,
                        "render": function(data, type, full, meta){
                            return full["bill_type"];
                        }
					},
                    { data: 'town' },
                    { data: 'recipient_name' },
                    { data: 'recipient_phone' },
                    { data: 'recipient_position' },
                    { data: 'remark' },
                    { data: null,
                        "render": function(data, type, full, meta){
                            return full["delivered_by"];
                        }
					},
                    { data: null,
                        "render": function(data, type, full, meta){
                            return full["datetime"];
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

