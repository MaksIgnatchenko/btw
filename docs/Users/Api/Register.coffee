###
@api {post} /api/register/customer Register customer
@apiName Register customer. Available for guest
@apiGroup Registration
@apiVersion 0.1.0

@apiParam {String} email Required
@apiParam {String} password  Required
@apiParam {String} username Required
@apiParam {String} first_name  Required
@apiParam {String} last_name  Required


@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'token': 'eyJ6fgtAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg4OfffYXBpL3JlZ2lzdGVyL2N1c3RvbWVyIiwiaWF0IjoxNTEwNjUxMzcyLCJleHAiOjE1'
    'token_type': 'bearer',
    'expires_in': 3600,
}

@apiErrorExample Error-Response:
HTTP/1.1 422 Error
{
    "message":"The given data was invalid.",
    "errors":{
        "email":["The email has already been taken."],
    }
}
###


###
@api {post} /api/register/merchant Register merchant
@apiName Register merchant. Available for guest
@apiGroup Registration
@apiVersion 0.1.0

@apiParam {String} email Required
@apiParam {String} password  Required
@apiParam {String} username Required
@apiParam {String} address  Required. Max 2000 symbols
@apiParam {Float} longitude  Required
@apiParam {Float} latitude  Required
@apiParam {String} ein  Required
@apiParam {String} telephone  Required
@apiParam {String} contact  Required
@apiParam {Boolean} check  Required. Is current business checked via google
@apiParam {Array} categories[] Required. Example: categories[]: 1, categories[]: 100500. Each category as separate field
@apiParam {String} business_name  Required
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
    'token': 'eyJ6fgtAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg4OfffYXBpL3JlZ2lzdGVyL2N1c3RvbWVyIiwiaWF0IjoxNTEwNjUxMzcyLCJleHAiOjE1'
    'token_type': 'bearer',
    'expires_in': 3600,
}

@apiErrorExample Error-Response:
HTTP/1.1 422 Error
{
    "message":"The given data was invalid.",
    "errors":{
        "email":["The email has already been taken."],
        "zip_code":["The zip code format is invalid."],
    }
}
###