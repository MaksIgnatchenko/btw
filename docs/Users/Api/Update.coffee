###
@api {put} /api/users/update/payment-option Change merchants payment
@apiDescription Change merchant payment settings. Only for active merchant
@apiGroup UserChanges
@apiVersion 0.1.0

@apiParam {String} payment_option Required. Available values: paypal, wire, cheque
@apiParam {String} paypal_email  Required when payment_option == 'paypal'
@apiParam {String} paypal_application_security  Required when payment_option == 'paypal'
@apiParam {String} paypal_application_id  Required when payment_option == 'paypal'
@apiParam {String} wire_bank_name  Required when payment_option == 'wire'
@apiParam {String} wire_account_name  Required when payment_option == 'wire'
@apiParam {String} wire_aba_number  Required when payment_option == 'wire'
@apiParam {Integer} wire_account_number  Required when payment_option == 'wire'

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": "true"
}
###
