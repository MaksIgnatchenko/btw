###
@api {post} /api/customer/profile Get profile
@apiName Get profile
@apiGroup Profile
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "id": 6,
    "first_name": "mr",
    "last_name": "demo",
    "email": "ilya.kobus@appus.me",
    "created_at": "2018-11-01 10:38:35",
    "updated_at": "2018-11-02 12:50:45",
    "address": 'New York, 27 st.'
}
###

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

###
@api {delete} /api/customer/profile Delete profile
@apiName Delete profile
@apiGroup Profile
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "status": "success"
}
###