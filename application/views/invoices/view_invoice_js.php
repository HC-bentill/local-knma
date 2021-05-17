<script type="text/javascript">
    $(function() {
        var alertCtrlObj = $('#tab-alert'),
            discountAmount = $('#discount_amount_text').val(),
            penaltyAmount = $('#penalty_amount_text').val(),
            totalAmount = $('#total_amount_text').val(),
            arrearsAmount = $('#arrears_amount_text').val(),
            invoiceId = $('#invoice_id').val(),
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

        $('body').on('click', '#send-sms', function(event) {
            event.preventDefault();

            var formData = $('#sms_form'),
                primaryContact = formData.find('#primary_contact').val(),
                secondaryContact = formData.find('#secondary_contact').val(),
                alertMsgContainer = alertCtrlObj.find('#alert-msg-container');

            if (primaryContact === "" && secondaryContact === "") {
                showAlert(alertCtrlObj, alertMsgContainer, 'error',
                    "You must provide either a primary or secondary " +
                    "contact phone number");
                return ;
            }
            var postData = {
                'phoneNumbers': JSON.stringify([primaryContact, secondaryContact]),
                'total_amount': totalAmount,
                'penalty_amount': penaltyAmount,
                'discount_amount': discountAmount,
                'arrears_amount': arrearsAmount 
            };

            $.ajax({
                'url': "<?=base_url()."invoice/send_invoice_sms"?>",
                'data': postData,
                'method': 'post',
                'dataType': 'json'
            }).done(function(data) {
                var msg = "Sms has been sent";
                showAlert(alertCtrlObj, alertMsgContainer, 'success', msg);
            }).fail(function(data) {
                var msg = "Sending Sms failed kindly try again";
                showAlert(alertCtrlObj, alertMsgContainer, 'error', msg);
            });
       });

       $('body').on('click', '#send-email', function(event) {
            event.preventDefault();
            var formData = $('#email_form'),
                email = formData.find('#email').val(),
                alertMsgContainer = alertCtrlObj.find('#alert-msg-container');

            if (email === "") {
                showAlert(alertCtrlObj, alertMsgContainer, 'error',
                    "You must provide email address to send bill to");
                return ;
            }
            var postData = {
                'email': email,
                'total_amount': totalAmount,
                'penalty_amount': penaltyAmount,
                'discount_amount': discountAmount,
                'arrears_amount': arrearsAmount 
            };

            $.ajax({
                'url': "<?=base_url()."invoice/send_invoice_email"?>/" + invoiceId,
                'data': postData,
                'method': 'post',
                'dataType': 'json'
            }).done(function(data) {
                var msg = "Email has been sent";
                showAlert(alertCtrlObj, alertMsgContainer, 'success', msg);
            }).fail(function(data) {
                var msg = "Sending Email failed kindly try again";
                showAlert(alertCtrlObj, alertMsgContainer, 'error', msg);
            });
       });

       $('body').on('click', '#close-sms-alert', function (event) {
           event.preventDefault();
           alertCtrlObj.addClass('hidden');
       });

    });
</script>