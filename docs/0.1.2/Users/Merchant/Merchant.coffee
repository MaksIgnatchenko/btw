###
@api {get} /api/merchant/:id Get Merchant data and Products
@apiName Get Merchant data and Products
@apiGroup Auth
@apiPermission Guest
@apiVersion 0.1.2

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'token': 'token'
    'token_type': 'bearer',
    'expires_in': 7776000, // 3 month session lifetime
}

@apiErrorExample Wrong params:
HTTP/1.1 401 Unauthorized
{
    "message":"No such username or password",
}
###