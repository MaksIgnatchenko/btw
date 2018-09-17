###
@api {post} /api/password/change Change password
@apiName Change password
@apiGroup Auth
@apiVersion 0.1.0

@apiParam {String} old_password Required
@apiParam {String} new_password Required

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'message': 'Password changed successfully'
}

@apiErrorExample Error-Response:
HTTP/1.1 400 Error
{
    "message":"Wrong old password. Please try again",
}
###