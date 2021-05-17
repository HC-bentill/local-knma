<script>
	(function($) {
		'use strict';
		var datatableInit = function() {
			var $table = $('#datatable-tabletools-audit');

			var table = $table.dataTable({
				// sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
				// buttons: [ 'print', 'excel', 'pdf' ],
				scrollX: true,
				processing: true,
				serverSide: true,
				serverMethod: 'post',
				ajax: {
					'url':'<?=base_url()?>Users/auditTrayList',
					"data": function ( d ) {
						d.start_date = '<?=$start_date?>',
                        d.end_date = '<?=$end_date?>',
                        d.role = '<?=$role?>',
                        d.category = '<?=$category?>',
                        d.agents = '<?=$agents?>',
                        d.users = '<?=$users?>',
                        d.channel = '<?=$channel?>'
					}
				},
				columns: [
                    { data: 'datetime_created' },
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["name"];
						}
                    },
                    { data: 'activity' },
					{ data: 'description' },
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["status"];
						}
                    },
                    { data: 'channel' }
				]
			});

		};

		$(function() {
			datatableInit();
		});

	}).apply(this, [jQuery]);
</script>

