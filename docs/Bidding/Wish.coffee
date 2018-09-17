###
@api {post} /api/wish Add to wish list
@apiName Add to wish list
@apiDescription Add to wish list. Available for active customers
@apiGroup Bidding
@apiVersion 0.1.0

@apiParam {Integer} product_id Required. Product should be active (offer end > now)
@apiParam {Integer} quantity Required.
@apiParam {Float} desired_price Required. Should be less than max_price. Max value - 999999.99
@apiParam {Float} max_price Required. Max value - 999999.99
@apiParam {Integer} bid_end Required. Available values: 1, 2, 3
@apiParam {Float} longitude
@apiParam {Float} latitude

@apiSuccessExample Success-response:
HTTP/1.1 200 OK
{
    "success": true
}

@apiErrorExample Product not active:
HTTP/1.1 422 Error
{
    "message": "The given data was invalid.",
    "errors": {
        "product_id": [
            "Product's offer end should be more than now"
        ]
    }
}

@apiErrorExample Product not active:
HTTP/1.1 422 Error
{
    "message": "The given data was invalid.",
    "errors": {
        "desired_price": [
            "Desired price should be less or equal to Maximum price."
        ],
    }
}
###

###
@api {get} /api/wish Get wishes by filters
@apiName Get wishes by filters
@apiDescription Get wishes by filters. Page limit - 50. Available for active customers and active merchants
@apiGroup Bidding
@apiVersion 0.1.0

@apiParam {Integer} filter Required. Available values: all, my, bid-result for customer; all form merchant
@apiParam {Float} longitude Required for customer with filter all Ex: 50.12345612
@apiParam {Float} latitude Required for customer with filter all
@apiParam {Integer} distance Required. Available values from 1 to 100
@apiParam {Integer} category_id
@apiParam {String} name Max 100 symbols
@apiParam {String} barcode Max 20 symbols
@apiParam {integer} offset Default value 0

@apiSuccessExample Customer all:
HTTP/1.1 200 OK
{
    "wishes": [
        {
            "id": 2,
            "product": {
                "id": 68,
                "tax": 1.5,
                "name": "iphone 5",
                "images": [],
                "rating": 3.6,
                "barcode": null,
                "user_id": 4,
                "offer_end": "2018-03-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-05 14:06:25",
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": "{\"quantity\": \"19\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
                "updated_at": "2018-01-05 14:06:28",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8,
                "regular_price": 10,
                "local_delivery": {
                    "active": false,
                    "distance": "0"
                },
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": true
            },
            "quantity": 10,
            "desired_price": 15,
            "max_price": 15,
            "end_date": "2018-02-01 13:29:08",
            "bids_count": 2,
            "distance": 0.00009493529796600342,
            "lowest_bid": [
                {
                    "wish_id": 2,
                    "total_price": "5.35000000"
                }
            ]
        },
        {
            "id": 5,
            "product": {
                "id": 68,
                "tax": 1.5,
                "name": "iphone 5",
                "images": [],
                "rating": 3.6,
                "barcode": null,
                "user_id": 4,
                "offer_end": "2018-03-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-05 14:06:25",
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": "{\"quantity\": \"19\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
                "updated_at": "2018-01-05 14:06:28",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8,
                "regular_price": 10,
                "local_delivery": {
                    "active": false,
                    "distance": "0"
                },
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": true
            },
            "quantity": 10,
            "desired_price": 12.5,
            "max_price": 15,
            "end_date": "2018-02-03 09:19:33",
            "bids_count": 0,
            "distance": 0.00009493529796600342,
            "lowest_bid": []
        },
    ]
}

@apiSuccessExample Customer my:
HTTP/1.1 200 OK
{
    "wishes": [
        {
            "id": 2,
            "product": {
                "id": 68,
                "tax": 1.5,
                "name": "iphone 5",
                "images": [],
                "rating": 3.6,
                "barcode": null,
                "user_id": 4,
                "offer_end": "2018-03-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-05 14:06:25",
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": "{\"quantity\": \"19\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
                "updated_at": "2018-01-05 14:06:28",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8,
                "regular_price": 10,
                "local_delivery": {
                    "active": false,
                    "distance": "0"
                },
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": true
            },
            "quantity": 10,
            "desired_price": 15,
            "max_price": 15,
            "end_date": "2018-02-01 13:29:08",
            "bids_count": 2,
            "lowest_bid": [
                {
                    "wish_id": 2,
                    "total_price": "5.35000000"
                }
            ]
        },
        {
            "id": 6,
            "product": {
                "id": 68,
                "tax": 1.5,
                "name": "iphone 5",
                "images": [],
                "rating": 3.6,
                "barcode": "54654",
                "user_id": 4,
                "offer_end": "2018-03-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-05 14:06:25",
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": "{\"quantity\": \"19\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
                "updated_at": "2018-01-05 14:06:28",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8,
                "regular_price": 10,
                "local_delivery": {
                    "active": false,
                    "distance": "0"
                },
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": true
            },
            "quantity": 10,
            "desired_price": 12.5,
            "max_price": 15,
            "end_date": "2018-02-03 09:20:50",
            "bids_count": 0,
            "lowest_bid": []
        }
    ]
}

@apiSuccessExample Bid result:
HTTP/1.1 200 OK
{
    "wishes": [
        {
            "id": 6,
            "product": {
                "id": 68,
                "tax": 1.5,
                "name": "iphone 5",
                "images": [],
                "rating": 3.6,
                "barcode": "54654",
                "user_id": 4,
                "offer_end": "2018-03-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-05 14:06:25",
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": "{\"quantity\": \"19\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
                "updated_at": "2018-01-05 14:06:28",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8,
                "regular_price": 10,
                "local_delivery": {
                    "active": false,
                    "distance": "0"
                },
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": true
            },
            "quantity": 10,
            "desired_price": 12.5,
            "max_price": 15,
            "end_date": "2018-02-07 09:20:50",
            "lowest_bid": [
                {
                    "wish_id": 6,
                    "total_price": "10.40000000"
                }
            ],
            "bids": [
                {
                    "id": 4,
                    "wish_id": 6,
                    "merchant_id": 2,
                    "price": 10,
                    "tax": 4,
                    "created_at": "2018-02-05 15:24:45",
                    "updated_at": "2018-02-05 15:24:45",
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
    ]
}

@apiSuccessExample Merchant all:
HTTP/1.1 200 OK
{
    "wishes": [
        {
            "id": 5,
            "product": {
                "id": 68,
                "tax": 1.5,
                "name": "iphone 5",
                "images": [],
                "rating": 3.6,
                "barcode": null,
                "user_id": 4,
                "offer_end": "2018-03-01 00:00:00",
                "attributes": null,
                "created_at": "2018-01-05 14:06:25",
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": "{\"quantity\": \"19\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
                "updated_at": "2018-01-05 14:06:28",
                "category_id": 1,
                "certificate": true,
                "description": "some description",
                "offer_price": 8,
                "regular_price": 10,
                "local_delivery": {
                    "active": false,
                    "distance": "0"
                },
                "purchase_count": 0,
                "return_details": "14 d",
                "store_delivery": true
            },
            "quantity": 10,
            "desired_price": 12.5,
            "max_price": 15,
            "end_date": "2018-04-03 09:19:33",
            "distance": 5.873947691926691,
            "my_bid": { // info about my bid. If current merchant didn't bid this wish - would be null
                "id": 2,
                "wish_id": 5,
                "merchant_id": 2,
                "price": 10,
                "tax": 6,
                "created_at": "2018-01-31 17:42:29",
                "updated_at": "2018-01-31 17:42:28"
            }
        }
    ]
}
###