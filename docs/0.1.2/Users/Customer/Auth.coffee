###
@api {post} /api/customer/auth/login Login into app
@apiName Login into app as customer
@apiGroup Auth
@apiPermission Guest
@apiVersion 0.1.2

@apiParam {String} email Valid email. Max 100 symbols
@apiParam {String} password Min 6. At least one uppercase, one lowercase, one digit, one symbol

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
@apiVersion 0.1.2

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
@apiPermission Customer
@apiVersion 0.1.2

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
@apiPermission Customer
@apiVersion 0.1.2

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'token': 'eyJ6fgtAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg4OfffYXBpL3JlZ2lzdGVyL2N1c3RvbWVyIiwiaWF0IjoxNTEwNjUxMzcyLCJleHAiOjE1'
    'token_type': 'bearer',
    'expires_in': 3600,
}
###

###
@api {post} /api/customer/password/email Forgot password
@apiName Send token to email
@apiGroup Auth
@apiPermission Guest
@apiVersion 0.1.2

@apiParam {String} email

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

###
@api {post} /api/customer/password/change Change password
@apiName Change password
@apiGroup Auth
@apiPermission Customer
@apiVersion 0.1.2

@apiParam {String} old_password
@apiParam {String} new_password

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

###
@api {post} /api/customer/register Register customer
@apiName Register customer
@apiGroup Auth
@apiPermission Guest
@apiVersion 0.1.2

@apiParam {String} first_name
@apiParam {String} last_name
@apiParam {String} email
@apiParam {String} password
@apiParam {String} password_confirmation

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
  "token": "token",
  "customer": {
    "email": "test@wish.net",
    "first_name": "Test",
    "last_name": "Test",
    "updated_at": "2018-09-20 15:55:31",
    "created_at": "2018-09-20 15:55:31",
    "id": 5
  }
}
###

###
@api {post} /api/customer/auth/login/:service Login customer via Social services. Available values: facebook, google
@apiName Login customer via Social services
@apiGroup Auth
@apiPermission Guest
@apiVersion 0.1.2

@apiParam {String} token

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'token': 'token'
    'token_type': 'bearer',
    'expires_in': 3600,
}
###
