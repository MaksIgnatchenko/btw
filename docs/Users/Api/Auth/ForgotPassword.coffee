###
@api {post} /api/password/email Forgot password
@apiName Send token to email
@apiGroup Auth
@apiVersion 0.1.0

@apiParam {String} email Required

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'success': 'true'
}

@apiErrorExample Error-Response:
HTTP/1.1 401 Error
{
    "message":"No such email",
}
###