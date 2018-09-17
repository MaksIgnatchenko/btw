###
@api {get} /api/order Get orders by filter
@apiName Get orders y filter
@apiDescription Get orders by filters. Only for active users
@apiGroup Orders
@apiVersion 0.1.0

@apiParam {string} filter Required. Available values - redeemed, unredeemed, refunded, returned, all for customer; pending-redemption, pending-payout, completed-transactions for merchant
@apiParam {integer} offset If no such field - set default 0. Page size - 10

@apiSuccessExample For customer:
HTTP/1.1 200 OK
{
    "orders": [
        {
            "id": 8,
            "customer_id": 1,
            "merchant_id": 2,
            "transaction_id": "c5987322-fc4e-11e7-9fb5-6fcdcc2050f1",
            "product": {
                "id": 51,
                "tax": 2.5,
                "name": "iphone3",
                "rating": 0,
                "barcode": null,
                "user_id": 4,
                "offer_end": "2018-02-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-04 10:04:09",
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": null,
                "updated_at": "2018-01-04 10:06:19",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8.7,
                "regular_price": 10,
                "local_delivery": null,
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": false
            },
            "quantity": 10,
            "qr_code": "243o1VOf4xuqLNCwu8uyWfu2zh3Lz0g1GXRTM1HzPCjnkYXvtCXGQvjWPCJjGFCZ",
            "status": "picked_up",
            "created_at": "2018-01-22 19:03:57",
            "updated_at": "2018-01-23 15:23:21",
            "outcome_id": null,
            "redeemed_at": null,
            "delivery_option": "local_delivery",
            "merchant": {
                "id": 2,
                "user_id": 4,
                "business_name": "govno 1",
                "address": "My delivery address3123123",
                "telephone": "11111111111",
                "ein": "123456789",
                "contact": "dfhgsygwewerwer",
                "payment_option": "paypal",
                "check": "Yes",
                "created_at": "2017-12-12 12:50:03",
                "updated_at": "2017-12-22 15:44:49",
                "status": "active",
                "longitude": 50.111,
                "latitude": 40,
                "rating": [
                    {
                        "merchant_id": 2,
                        "avg": "3.7500"
                    }
                ]
            }
        },
        {
            "id": 7,
            "customer_id": 1,
            "merchant_id": 2,
            "transaction_id": "c5987322-fc4e-11e7-9fb5-6fcdcc2050f1",
            "product": {
                "id": 51,
                "tax": 2.5,
                "name": "iphone2",
                "rating": 0,
                "barcode": null,
                "user_id": 4,
                "offer_end": "2018-02-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-04 10:04:09",
                "main_image": "/tmp/phpfDMwhG",
                "parameters": null,
                "updated_at": "2018-01-04 10:06:19",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8.7,
                "regular_price": 10,
                "local_delivery": null,
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": false
            },
            "quantity": 30,
            "qr_code": "143o1VOf4xuqLNCwu8uyWfu2zh3Lz0g1GXRTM1HzPCjnkYXvtCXGQvjWPCJjGFCZ",
            "status": "pending",
            "created_at": "2018-01-20 10:41:47",
            "updated_at": "2018-01-23 15:42:47",
            "outcome_id": null,
            "redeemed_at": null,
            "delivery_option": "local_delivery",
            "merchant": {
                "id": 2,
                "user_id": 4,
                "business_name": "govno 1",
                "address": "My delivery address3123123",
                "telephone": "11111111111",
                "ein": "123456789",
                "contact": "dfhgsygwewerwer",
                "payment_option": "paypal",
                "check": "Yes",
                "created_at": "2017-12-12 12:50:03",
                "updated_at": "2017-12-22 15:44:49",
                "status": "active",
                "longitude": 50.111,
                "latitude": 40,
                "rating": [
                    {
                        "merchant_id": 2,
                        "avg": "3.7500"
                    }
                ]
            }
        },
        {
            "id": 6,
            "customer_id": 1,
            "merchant_id": 2,
            "transaction_id": "c5987322-fc4e-11e7-9fb5-6fcdcc2050f1",
            "product": {
                "id": 51,
                "tax": 2.5,
                "name": "iphone1",
                "rating": 0,
                "barcode": null,
                "user_id": 4,
                "offer_end": "2018-02-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-04 10:04:09",
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": null,
                "updated_at": "2018-01-04 10:06:19",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8.7,
                "regular_price": 10,
                "local_delivery": null,
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": false
            },
            "quantity": 2,
            "qr_code": "l43o1VOf4xuqLNCwu8uyWfu2zh3Lz0g1GXRTM1HzPCjnkYXvtCXGQvjWPCJjGFCZ",
            "status": "picked_up",
            "created_at": "2018-01-19 10:41:48",
            "updated_at": "2018-01-23 15:42:47",
            "outcome_id": null,
            "redeemed_at": null,
            "delivery_option": "local_delivery",
            "merchant": {
                "id": 2,
                "user_id": 4,
                "business_name": "govno 1",
                "address": "My delivery address3123123",
                "telephone": "11111111111",
                "ein": "123456789",
                "contact": "dfhgsygwewerwer",
                "payment_option": "paypal",
                "check": "Yes",
                "created_at": "2017-12-12 12:50:03",
                "updated_at": "2017-12-22 15:44:49",
                "status": "active",
                "longitude": 50.111,
                "latitude": 40,
                "rating": [
                    {
                        "merchant_id": 2,
                        "avg": "3.7500"
                    }
                ]
            }
        }
    ]
}

@apiSuccessExample For merchant:
HTTP/1.1 200 OK
{
    "orders": [
        {
            "customer_id": 1,
            "merchant_id": 2,
            "product": {
                "id": 51,
                "tax": 2.5,
                "name": "iphone2",
                "rating": 0,
                "barcode": null,
                "user_id": 4,
                "offer_end": "2018-02-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-04 10:04:09",
                "main_image": "/tmp/phpfDMwhG",
                "parameters": null,
                "updated_at": "2018-01-04 10:06:19",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8.7,
                "regular_price": 10,
                "local_delivery": null,
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": false
            },
            "quantity": 30,
            "status": "pending",
            "created_at": "2018-01-20 10:41:47",
            "delivery_option": "local_delivery",
            "customer": {
                "id": 1,
                "user_id": 6,
                "first_name": "Artem",
                "last_name": "Petrov",
                "user": {
                    "id": 6,
                    "username": "customer1",
                    "email": "customer1@gmail.com"
                },
                "delivery_address": {
                    "customer_id": 1,
                    "address": "ывап",
                    "longitude": 50.12,
                    "latitude": 40
                }
            }
        }
    ]
}

@apiErrorExample Wrong :
HTTP/1.1 200 OK
{
    "message": "The given data was invalid.",
    "errors": {
        "filter": [
            "Wrong value. Available values - redeemed,unredeemed,refunded,returned,all for customer, pending-redemption,pending-payout,returned,completed-transactions for merchant"
        ]
    }
}

###

###
@api {get} /api/order/{qr_code} Get order by qr code
@apiName Get order by qr code. Available for active merchant
@apiGroup Orders
@apiVersion 0.1.0


@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "order": {
        "id": 7,
        "merchant_id": 2,
        "transaction_id": "c5987322-fc4e-11e7-9fb5-6fcdcc2050f1",
        "product": {
            "id": 51,
            "tax": 2.5,
            "name": "iphone2",
            "rating": 0,
            "barcode": null,
            "user_id": 4,
            "offer_end": "2018-02-01 00:00:00",
            "attributes": null,
            "created_at": "2018-01-04 10:04:09",
            "main_image": "/tmp/phpfDMwhG",
            "parameters": null,
            "updated_at": "2018-01-04 10:06:19",
            "category_id": 1,
            "certificate": true,
            "description": "some description",
            "offer_price": 8.7,
            "regular_price": 10,
            "local_delivery": null,
            "purchase_count": 0,
            "return_details": "14 d",
            "store_delivery": false
        },
        "quantity": 30,
        "qr_code": "143o1VOf4xuqLNCwu8uyWfu2zh3Lz0g1GXRTM1HzPCjnkYXvtCXGQvjWPCJjGFCZ",
        "status": "pending",
        "created_at": "2018-01-20 10:41:47",
        "updated_at": "2018-01-23 15:42:47",
        "outcome_id": null,
        "customer": {
            "id": 1,
            "user_id": 6,
            "first_name": "Artem",
            "last_name": "Petrov",
            "user": {
                "id": 6,
                "username": "customer1",
                "email": "customer1@gmail.com"
            },
            "delivery_address": {
                "customer_id": 1,
                "address": "ывап",
                "longitude": 50.12,
                "latitude": 40
            }
        }
    }
}


@apiErrorExample Error-Response:
HTTP/1.1 200 OK
{
  "message": "There is no such order"
}
###

###
@api {put} /api/order/{qr_code} Confirm or return order
@apiName Confirm or return order
@apiDescription Confirm or return order. Depends on order status. Available for active merchant
@apiGroup Orders
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}

@apiErrorExample Error-Response:
HTTP/1.1 422 Error
{
  "message": "There is no such order"
}

@apiErrorExample Expired time to return:
HTTP/1.1 400 Bad request
{
    "message": "Sorry, No return is accepted after the return period",
    "errors": {
        "qr_code": [
            "Sorry, No return is accepted after the return period"
        ]
    }
}
###





