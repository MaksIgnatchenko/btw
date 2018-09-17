###
@api {post} /api/transaction/ Execute transaction
@apiName Execute transaction
@apiDescription Execute transaction. Only for active customers. If transaction successful - all products from cart would be deleted and would be created orders
@apiGroup Transaction
@apiVersion 0.1.0

@apiParam {Numeric} amount Required. Total amount after discounts, taxes and other. Ex: 199.99
@apiParam {Float} noncence Required. Braintree hash. Max 1000 symbols

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true,
    "message": "Success ID: fx6jd12d"
}

@apiErrorExample Wrong noncence:
HTTP/1.1 422 OK
{
    "success": false,
    "message": "Unknown or expired payment_method_nonce."
}
###