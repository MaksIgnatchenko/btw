###
@api {post} /api/customer/auth/login Login into app
@apiName Login into app as customer
@apiGroup Auth
@apiPermission Guest
@apiVersion 0.1.0

@apiParam {String} email
@apiParam {String} password

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

###
@api {post} /api/customer/auth/logout Logout from app
@apiName Logout from app
@apiGroup Auth
@apiPermission Customer
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "message": "Successfully logged out"
}
###

###
@api {post} /api/customer/auth/me Info about current user
@apiName Info about current user
@apiGroup Auth
@apiVersion 0.1.0

@apiSuccessExample Success-Response merchant:
HTTP/1.1 200 OK
{
    "id": 2,
    "first_name": "Appus",
    "last_name": "Tester",
    "email": "customer@wish.com",
    "created_at": "2018-09-20 09:45:37",
    "updated_at": "2018-09-20 09:45:38"
}
###

###
@api {post} /api/customer/auth/refresh Update token
@apiName Refresh token and session
@apiGroup Auth
@apiVersion 0.1.0


@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'token': 'eyJ6fgtAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg4OfffYXBpL3JlZ2lzdGVyL2N1c3RvbWVyIiwiaWF0IjoxNTEwNjUxMzcyLCJleHAiOjE1'
    'token_type': 'bearer',
    'expires_in': 3600,
}
###