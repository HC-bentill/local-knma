<script>
	(function($) {
		'use strict';
		var datatableInit = function() {
			var $table = $('#datatable-tabletools-businessprop');

			var table = $table.dataTable({
				// sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
				// buttons: [ 'print', 'excel', 'pdf' ],
				scrollX: true,
				processing: true,
				serverSide: true,
				serverMethod: 'post',
				ajax: {
					'url':'<?=base_url()?>Business/businessPropertyList',
					"data": function ( d ) {
						d.search_by = '<?=$search_by?>',
						d.start_date = '<?=$start_date?>',
						d.end_date = '<?=$end_date?>'
					}
				},
				columns: [
                    { data: 'buis_prop_code' },
                    { data: 'area' },
					{ data: 'tt' },
					{ data: 'category' },
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["status"];
						}
					},
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["assessed"];
						}
                    },
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["invoice_status"];
						}
                    },
                    { "data": null,
						"render": function(data, type, full, meta){
							return full["owner"];
						}
					},
					{ data: 'primary_contact' },
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["registered_by"];
						}
                    },
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["resend_code"];
						}
                    },
					{ "data": null,
						"render": function(data, type, full, meta){
							return full["bill_generation"];
						}
                    }
				]
			});

		};

		$(function() {
			datatableInit();
		});

	}).apply(this, [jQuery]);
</script>
<script type="text/javascript">
//used for handling sending of messages
$(function() {
	var alertCtrlObj = $('#tab-alert'),
		alertMsgContainerObj = alertCtrlObj.find('#alert-msg-container'),
		showAlert = function (alertCtrl, alertMsgContainer, alertType, alertMsg) {
			var alertClass = "",
				possibleAlertClasses = [
					'alert-danger', 'alert-warning', 'alert-success'];
			if (alertType == "error") {
				alertClass = "alert-danger";
			} else if (alertType == 'warning') {
				alertClass = 'alert-warning';
			} else {
				alertClass = 'alert-success';
			}
			alertCtrl.removeClass('show');
			alertCtrl.addClass('hidden');
			for(var index in possibleAlertClasses) {
				alertCtrl.removeClass(possibleAlertClasses[index]);
			}
			alertMsgContainer.text(alertMsg);
			alertCtrl.addClass(alertClass);
			alertCtrl.removeClass('hidden');
			alertCtrl.addClass('show');
		};

	$('body').on('click', '#btnn', function(event) {
		event.preventDefault();
		var msgForm = $('#basicFormm'),
			formEntryIsValid = msgForm.valid(),
			messageType = msgForm.find('#message_type').val(),
			primaryContact = msgForm.find('#primary_contact').val(),
			email = msgForm.find('#email').val(),
			msgContent = msgForm.find('#message').val(),
			actionUrl = msgForm.attr('action');

		if (formEntryIsValid) {
			var postData = {
				'message_type': messageType,
				'email': email,
				'primary_contact': primaryContact,
				'message': msgContent
			};
			$.ajax({
                'url': actionUrl,
                'data': postData,
                'method': 'post',
                'dataType': 'json'
            }).done(function(data) {
                var msg = "Message has been sent";
                showAlert(alertCtrlObj, alertMsgContainerObj, 'success', msg);
            }).fail(function(data) {
                var msg = "Sending Message failed kindly try again";
                showAlert(alertCtrlObj, alertMsgContainerObj, 'error', msg);
            });
		}
	});

	$('body').on('click', '#close-sms-alert', function (event) {
		event.preventDefault();
		alertCtrlObj.addClass('hidden');
	});

});
</script>