###
@api {post} /api/transaction Create transaction
@apiName Create transaction
@apiGroup Transaction
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiParam {Decimal} amount Transaction amount
@apiParam {String} noncence Transaction noncence

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###