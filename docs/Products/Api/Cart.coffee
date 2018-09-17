###
@api {get} /api/cart/ Get cart
@apiName Get cart
@apiDescription Get cart. Only for active customers
@apiGroup Cart
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "cart": [
        {
            "id": 5,
            "customer_id": 1,
            "product_id": 68,
            "product": {
                "id": 68,
                "tax": 1,
                "name": "iphone 5",
                "rating": 3.6,
                "barcode": null,
                "offer_end": "2018-02-01 00:00:00",
                "attributes": null,
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": "{\"quantity\": \"12\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
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
            "quantity": 14,
            "created_at": "2018-01-10 13:46:00",
            "updated_at": "2018-01-10 13:46:19",
            "source": "product", // available values: product, bid
            "product_relation": {
                "parameters": "{\"quantity\": \"19\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}"
            }
        },
        {
            "id": 6,
            "customer_id": 1,
            "product_id": 67,
            "product": {
                "id": 68,
                "tax": 1,
                "name": "iphone 5",
                "rating": 3.6,
                "barcode": null,
                "offer_end": "2018-02-01 00:00:00",
                "attributes": null,
                "main_image": "WEujsSn0TNKbHhHGRIsQy6tm4S9BfrTPnAAFnGid.jpeg",
                "parameters": "{\"quantity\": \"12\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
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
            "created_at": "2018-01-10 16:26:39",
            "updated_at": "2018-01-10 16:26:42",
            "source": "product", // available values: product, bid
            "delivery_option": "local_delivery", // available values: local_delivery, store_delivery
            "product_relation": {
                "parameters": null
            }
        }
    ]
}
###

###
@api {post} /api/cart/ Add to cart
@apiName Add to cart
@apiDescription Add to cart. Only for active customers
@apiGroup Cart
@apiVersion 0.1.0

@apiParam {String} source Required. Available values: product, bid
@apiParam {Integer} product_id Required if source product
@apiParam {Integer} bid_id Required if source bid
@apiParam {Integer} delivery_option Required if source product.  Available values: local_delivery, store_delivery

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}

@apiErrorExample Bid doesn't belongs to you:
HTTP/1.1 422 Error
{
    "message": "The given data was invalid.",
    "errors": {
        "bid_id": [
            "You are not allowed to add this bid to cart."
        ]
    }
}

@apiErrorExample Wrong bid date:
HTTP/1.1 422 Error
{
    "message": "The given data was invalid.",
    "errors": {
        "bid_id": [
            "Wrong wish date."
        ]
    }
}

@apiErrorExample Already added bid to cart:
HTTP/1.1 422 Error
{
    "message": "The given data was invalid.",
    "errors": {
        "bid_id": [
            "You already added this bid to cart."
        ]
    }
}
@apiErrorExample Already added bid to cart:
HTTP/1.1 400 Error
{
    "message": "The given data is invalid",
    "errors": {
        "product_id": [
            "This product is already added to cart"
        ]
    }
}
###

###
@api {put} /api/cart/{key} Change quantity in cart
@apiName Change quantity in cart
@apiDescription Change product quantity in cart. Only for cart from product. Only for active customers
@apiGroup Cart
@apiVersion 0.1.0

@apiParam {String} action Required. Available values: increment, decrement

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}

@apiErrorExample Too low quantity:
HTTP/1.1 401 Error
{
    "message": "Too low quantity for cart with id {key}"
}

@apiErrorExample Try to edit bid quantity:
HTTP/1.1 401 Error
{
    "message": "You can edit only when source product"
}

###

###
@api {delete} /api/cart/{cartId} Delete from cart
@apiName Delete from cart
@apiDescription Delete from cart. Only for active customers
@apiGroup Cart
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###

###
@api {get} /api/cart/check Check cart
@apiName Check if transaction could be started
@apiDescription Check if transaction could be started. Only active customer
@apiGroup Cart
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}

@apiErrorExample Error-Response:
HTTP/1.1 422 Unprocessible entity
{
    "message": "The given data was invalid.",
    "errors": {
        "13": [
            "Offer date for item iphone 5 has expired. Please delete it from the cart to proceed.",
            "Quantity 100000 isn’t available for item iphone 5. Please decrease quantity to 1 to proceed.",
            "Item iphone 5 has a free delivery option. Please, enter your delivery address to proceed."
        ]
    }
}

@apiErrorExample Quantity error:
HTTP/1.1 422 Unprocessible entity
{
    "message": "The given data was invalid.",
    "errors": {
        "13": [
            "Quantity 100000 isn’t available for item iphone 5. Please decrease quantity to 1 to proceed.",
        ]
    }
}

@apiErrorExample No delivery address:
HTTP/1.1 422 Unprocessible entity
{
    "message": "The given data was invalid.",
    "errors": {
        "13": [
            "Item iphone 5 has a free delivery option. Please, enter your delivery address to proceed."
        ]
    }
}

@apiErrorExample Not valid offer end:
HTTP/1.1 422 Unprocessible entity
{
    "message": "The given data was invalid.",
    "errors": {
        "13": [
            "Offer date for item iphone 5 has expired. Please delete it from the cart to proceed.",
        ]
    }
}
###
