###
@api {post} /api/auth/login Login into app
@apiName Login into app. Available for guest
@apiGroup Auth
@apiVersion 0.1.0

@apiParam {String} username Required
@apiParam {String} password Required

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'token': 'eyJ6fgtAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0Ojg4OfffYXBpL3JlZ2lzdGVyL2N1c3RvbWVyIiwiaWF0IjoxNTEwNjUxMzcyLCJleHAiOjE1'
    'token_type': 'bearer',
    'expires_in': 3600,
    "roles": {
        "name": "merchant",
    },
}

@apiErrorExample Error-Response:
HTTP/1.1 401 Error
{
    "message":"No such username or password",
}
###

###
@api {post} /api/auth/logout Logout from app
@apiName Logout from app
@apiGroup Auth
@apiVersion 0.1.0


@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "message": "Successfully logged out"
}

@apiErrorExample Error-Response:
HTTP/1.1 401 Error
{
    "message": "Unauthenticated."
}
###

###
@api {post} /api/auth/me Info about current user
@apiName Info about current user
@apiGroup Auth
@apiVersion 0.1.0


@apiSuccessExample Success-Response merchant:
HTTP/1.1 200 OK
{
    "id": 4,
    "username": "merchant1",
    "email": "merchant1@gmail.com",
    "created_at": "2017-12-12 12:50:03",
    "updated_at": "2017-12-12 12:50:03",
    "deleted_at": null,
    "merchant": {
        "id": 2,
        "user_id": 4,
        "business_name": "govno 1",
        "telephone": "11111111111",
        "ein": "123456789",
        "contact": "dfhgsygwewerwer",
        "payment_option": "paypal",
        "check": "Yes",
        "status": "active",
        "address": "My delivery address3123123",
        "longitude": 50.111,
        "latitude": 40,
        "rating": [
            {
                "merchant_id": 2,
                "avg": "3.7500"
            }
        ],
        "merchants_reviews": [
            {
                "id": 1,
                "review": "ok",
                "status": "active",
                "rate": 5,
                "customer_id": 1,
                "merchant_id": 2,
                "created_at": "2018-01-03 16:02:17",
                "updated_at": "2018-01-03 16:02:18",
                "customer": {
                    "id": 1,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            },
            {
                "id": 2,
                "review": "wertger",
                "status": "active",
                "rate": 3,
                "customer_id": 1,
                "merchant_id": 2,
                "created_at": "2018-01-15 10:40:57",
                "updated_at": "2018-01-15 10:40:58",
                "customer": {
                    "id": 1,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            },
            {
                "id": 3,
                "review": "fawer",
                "status": "active",
                "rate": 2,
                "customer_id": 2,
                "merchant_id": 2,
                "created_at": "2018-01-03 16:05:58",
                "updated_at": "2018-01-03 16:05:59",
                "customer": {
                    "id": 2,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            },
        ]
    },
    "customer": null,
    "roles": {
        "name": "merchant"
    },
    "payment_options": {
        "merchant_id": 2,
        "email": "the9thlaw@ukr.net",
        "created_at": "2017-12-15 13:45:45",
        "updated_at": "2017-12-15 13:45:45"
    }
}

@apiSuccessExample Success-Response customer:
HTTP/1.1 200 OK
{
    "id": 17,
    "username": "customer15",
    "email": "customer15@gmail.com",
    "created_at": "2017-12-22 15:58:25",
    "updated_at": "2017-12-22 15:58:25",
    "deleted_at": null,
    "merchant": null,
    "customer": {
        "id": 3,
        "user_id": 17,
        "first_name": "Artem",
        "last_name": "Petrov",
        "status": "active",
        "address": {
            "customer_id": 3,
            "address": "asdrfasdfawer",
            "longitude": 50,
            "latitude": 40,
            "created_at": "2017-12-22 16:10:52",
            "updated_at": "2017-12-22 16:10:52"
        },
        "delivery_address": {
            "customer_id": 3,
            "address": "asdrfasdfawer",
            "longitude": 50,
            "latitude": 40,
            "created_at": "2017-12-22 16:13:28",
            "updated_at": "2017-12-22 16:13:28"
        }
    },
    "roles": {
        "name": "customer"
    }
}

###

###
@api {post} /api/auth/refresh Update token
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