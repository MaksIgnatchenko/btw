###
@api {put} /api/customer/profile Update profile
@apiName Update profile
@apiGroup Profile
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>
@apiHeader {String} Content-Type <code>application/x-www-form-urlencoded</code>

@apiParam {String} first_name
@apiParam {String} last_name
@apiParam {String} email
@apiParam {String} address Optional

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "status": "success"
}
###