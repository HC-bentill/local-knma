<!-- Script -->
<script type="text/javascript">
	// $(document).ready(function(){
	//    	$('#datatable-tabletools-property-owner').DataTable({
	//       	'processing': true,
	//       	'serverSide': true,
	//       	'serverMethod': 'post',
	//       	'ajax': {
	//           'url':'<?=base_url()?>/Property/propOwnerList'
	//       	},
	//       	'columns': [
	//          	{ data: 'person_category' },
	//          	{ data: 'fullname' },
	//          	{ data: 'primary_contact' },
	//          	{ data: 'secondary_contact' },
	//          	{ data: 'email' },
	//       	]
    //        });
           
	// });

	(function($) {

		'use strict';

		var datatableInit = function() {
			var $table = $('#datatable-tabletools-property-owner');

				
				var table = $table.dataTable({
					// sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
					// buttons: [ 'print', 'excel', 'pdf' ],
					scrollX: true,
					processing: true,
					paginationType: "full_numbers",
					serverSide: true,
					serverMethod: 'post',
					ajax: {
					'url':'<?=base_url()?>Property/propOwnerList'
					},
					columns: [
						{ data: 'person_category' },
						{ "data": null,
							"render": function(data, type, full, meta){
								return full["firstname"] + " " + full["lastname"];
							}
						},
						{ data: 'primary_contact' },
						{ data: 'secondary_contact' },
						{ data: 'email' },
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