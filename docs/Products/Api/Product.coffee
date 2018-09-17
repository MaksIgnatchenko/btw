###
@api {post} /api/products/set Create product
@apiName Create product by merchant. Only for active merchants
@apiGroup Products
@apiDescription
  Max file size - 5 MB. Max dimension - 2436px X 2436px. Extensions - jpg, jpeg, png.
  Path to origin photo: storage/images/products/origin.
  Path to thumbs: storage/images/products/thumbs
@apiVersion 0.1.0

@apiParam {File} main_image Required.
@apiParam {Json} attributes Ex: {{"color": {"type": "digits","value": "10000"}, "size": {"type": "text","value": "dfhgsdfhg"}}
@apiParam {Json} parameters Ex: {"quantity": "100500", "valid_date":{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "09.00 AM", "valid_time_to": "08.00 PM"}, "other_restrictions":"some text", "not_valid_on_holidays": "true"}
@apiParam {String} name Required.
@apiParam {String} description Required.
@apiParam {Float} regular_price Required. Ex: 99.99. Coins must be present
@apiParam {Float} offer_price Required. Ex: 99.99. Coins must be present. Should not be more than regular_price
@apiParam {Integer} category_id Required. Category should be final
@apiParam {Boolean} store_delivery Required.
@apiParam {Boolean} local_delivery Required.
@apiParam {String} local_delivery_Required if local_delivery is true. Should contain only digits. Min - 1
@apiParam {File} images[] Max 5 files. Each file in separate parameter!
@apiParam {Integer} barcode 13 digits certain
@apiParam {Timestamp} offer_end Required
@apiParam {Boolean} certificate Required
@apiParam {String} return_details Required


@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'success': true
}

@apiErrorExample Error-Response not JSON:
HTTP/1.1 422 Bad request
{
    "message": "The given data was invalid.",
    "errors": {
        "attributes": [
            "The attributes must be a valid JSON string."
        ],
        "parameters": [
            "The parameters must be a valid JSON string."
        ]
    }
}

@apiErrorExample Error-Response wrong images:
HTTP/1.1 422 Bad request
{
    "message": "The given data was invalid.",
    "errors": {
        "images": [
            "The images may not have more than 5 items."
        ],
        "images.1": [
            "The images.1 must be less than or equal to 2436 pixels wide and less than or equal to 2436 pixels tall."
        ]
    }
}

@apiErrorExample Error-Response no permissions:
HTTP/1.1 401 Bad request
{
    "message": "",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\HttpException",
    "file": "/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Application.php",
    "line": 940,
    "trace": [ ... ]
}
###


###
@api {get} /api/products/get Get products
@apiName Get products. Only for active merchants
@apiGroup Products
@apiVersion 0.1.0

@apiParam {String} filter Required. Available values: outstanding-offers, pending-redemption, pending-payout, completed-transactions
@apiParam {Integer} offset Required

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 24,
            "name": "product",
            "description": "some descr",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"10000\"}}",
            "parameters": null,
            "regular_price": 90.99,
            "offer_price": 100,
            "tax": 99,
            "store_delivery": false,
            "local_delivery": {
                "distance": "100500",
                "active": true
            },
            "main_image": "kPMctXa3ErkpHRFk2fmoWlTf6CgpbyVROAO3BFAi.jpeg",
            "barcode": null,
            "offer_end": "2017-01-06 10:17:36",
            "user_id": 3,
            "category": {
                "id": 1,
                "name": "Shop"
            }
        },
    ]
}

@apiErrorExample Error-Response wrong filter:
HTTP/1.1 422 Bad request Incorrect filter
{
    "message": "The given data was invalid.",
    "errors": {
        "filter": [
            "The selected filter is invalid."
        ]
    }
}

###

###
@api {get} /api/products/price-breakers Get price breakers
@apiName Get price breakers.
@apiDescription Get products with the biggest difference between regular and offer prices. Returns closest products in 100 miles radius when longitude and latitude presents. Returns 10 products
@apiGroup Products
@apiVersion 0.1.0

@apiParam {Integer} offset Required
@apiParam {Float} longitude
@apiParam {Float} latitude

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 6,
            "name": "dfsdf",
            "regular_price": 101,
            "offer_price": 89,
            "main_image": "u3xUogqDMDgw7YH9Hn6aMHp30iELO8qbVFkn4f3b.jpeg",
            "price_break": "13.483146",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"00.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 1,
            "name": "dfsdf",
            "regular_price": 100.99,
            "offer_price": 90.99,
            "main_image": "IAW0Hh59OzuK7ZVDQ6AvTfV4eW6v5Eteniey0I6d.jpeg",
            "price_break": "10.990219",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "1970-01-02 10:17:36",
            "return_details": "14 days",
        },
        {
            "id": 2,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "sPzioZYGhyxgHScadfj0DTQB2G4jD2cVaNePgIjQ.jpeg",
            "price_break": "-9.010000",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "1970-01-02 10:17:36",
            "return_details": "14 days",
        },
        {
            "id": 3,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "DelLzGUF7OX0WGLUJfYps1DSmAqo9f5rNUu1cLuA.jpeg",
            "price_break": "-9.010000",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "1973-11-29 21:33:09",
            "return_details": "14 days",
        },
        {
            "id": 4,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "adedBUEl36gQtXaF0mWI7LNVcEYSWFfEPtoWfynU.jpeg",
            "price_break": "-9.010000",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 5,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "CYQi7WV1ysKWkPb8ePb1YG2WFoacSmQ8nAn7l3D3.jpeg",
            "price_break": "-9.010000",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 7,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "kWFBlCpFMNzukMsab5qLxEJw5Ae6CLnDMoBYt7vj.jpeg",
            "price_break": "-9.010000",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"01.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 8,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "Ge4BEWzDNaMOtbaSC4g1WeCdP66jIXSmBsdzyYyl.jpeg",
            "price_break": "-9.010000",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"01.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 9,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "SnhVWscuMDwaYUEJ9P3IiA7ucQw7KWwSCC7V6uO7.jpeg",
            "price_break": "-9.010000",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"01.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 10,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "v5JUcVaYbQqXLZ0eGdkGyzQj61xTbODd2d8c3Hcs.jpeg",
            "price_break": "-9.010000",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"01.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        }
    ]
}

###

###
@api {get} /api/products/popular Get popular
@apiName Get popular products
@apiDescription Get products with the biggest number of purchases. Returns closest products in 100 miles radius when longitude and latitude presents. Returns 10 products
@apiGroup Products
@apiVersion 0.1.0

@apiParam {Integer} offset Required
@apiParam {Float} longitude
@apiParam {Float} latitude

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 17,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "ZXKL33vpek6sRhmv5KBHxgKjIQiQiNeEu4U2Rqum.jpeg",
            "purchase_count": 100500,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"01.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 1,
            "name": "dfsdf",
            "regular_price": 100.99,
            "offer_price": 90.99,
            "main_image": "IAW0Hh59OzuK7ZVDQ6AvTfV4eW6v5Eteniey0I6d.jpeg",
            "purchase_count": 10,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "1970-01-02 10:17:36",
            "return_details": "14 days",
        },
        {
            "id": 34,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "sPWx94TJk1CSgQT8SsqgR9wj9MHF1EGPjRjA7wS9.jpeg",
            "purchase_count": 7,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"01.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 25,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "gzJCdhggr5X2BLPe0KlY5oFBMMd5cC5YrdsR848t.jpeg",
            "purchase_count": 3,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"01.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 14,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "YZVoauyaD9JMn40nCqOGHR5dicrckB1RC6tbn8jY.jpeg",
            "purchase_count": 2,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"01.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 2,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "sPzioZYGhyxgHScadfj0DTQB2G4jD2cVaNePgIjQ.jpeg",
            "purchase_count": 0,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "1970-01-02 10:17:36",
            "return_details": "14 days",
        },
        {
            "id": 3,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "DelLzGUF7OX0WGLUJfYps1DSmAqo9f5rNUu1cLuA.jpeg",
            "purchase_count": 0,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "1973-11-29 21:33:09",
            "return_details": "14 days",
        },
        {
            "id": 4,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "adedBUEl36gQtXaF0mWI7LNVcEYSWFfEPtoWfynU.jpeg",
            "purchase_count": 0,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 5,
            "name": "dfsdf",
            "regular_price": 90.99,
            "offer_price": 100,
            "main_image": "CYQi7WV1ysKWkPb8ePb1YG2WFoacSmQ8nAn7l3D3.jpeg",
            "purchase_count": 0,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        },
        {
            "id": 6,
            "name": "dfsdf",
            "regular_price": 101,
            "offer_price": 89,
            "main_image": "u3xUogqDMDgw7YH9Hn6aMHp30iELO8qbVFkn4f3b.jpeg",
            "purchase_count": 0,
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"00.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"01.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "offer_end": "2018-01-05 22:00:00",
            "return_details": "14 days",
        }
    ]
}

###


###
@api {get} /api/products/search Customer products search
@apiName Customer products search
@apiDescription Get products by filters
@apiGroup Products
@apiVersion 0.1.0

@apiParam {Integer} distance Required. Can be from 1 to 100
@apiParam {Float} longitude Required
@apiParam {Float} latitude Required
@apiParam {Integer} category_id Should be existing category
@apiParam {Integer} offset Default - 0
@apiParam {String} keyword Max 50 symbols
@apiParam {String} barcode 13 symbols certain


@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 1,
            "name": "name1",
            "description": "hdfghdfhdfgh",
            "attributes": "{\"size\": {\"type\": \"text\", \"value\": \"dfhgsdfhg\"}, \"color\": {\"type\": \"digits\", \"value\": \"1000\"}}",
            "parameters": "{\"quantity\": \"100500\", \"valid_date\": {\"valid_day_to\": \"Fri\", \"valid_time_to\": \"08.00 PM\", \"valid_day_from\": \"Mon\", \"valid_time_from\": \"09.00 AM\"}, \"other_restrictions\": \"\", \"not_valid_on_holidays\": \"false\"}",
            "regular_price": 100.99,
            "offer_price": 90.99,
            "tax": 99,
            "store_delivery": false,
            "local_delivery": {
                "distance": "100500",
                "active": true
            }            "main_image": "IAW0Hh59OzuK7ZVDQ6AvTfV4eW6v5Eteniey0I6d.jpeg",
            "barcode": "1234567891234",
            "offer_end": "1970-01-02 10:17:36",
            "certificate": true,
            "return_details": true,
            "purchase_count": 10
        }
    ]
}

@apiErrorExample Wrong distance:
HTTP/1.1 422 OK
{
    "message": "The given data was invalid.",
    "errors": {
        "distance": [
            "The distance may not be greater than 100."
        ]
    }
}

@apiErrorExample Wrong category id:
HTTP/1.1 422 OK
{
    "message": "The given data was invalid.",
    "errors": {
        "category_id": [
            "The selected category id is invalid."
        ]
    }
}

###


###
@api {get} /api/products/get/{$key} Get info about product
@apiName Get info about product
@apiDescription Get info about product. Available for guest
@apiGroup Products
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "product": {
        "id": 50,
        "name": "iphone 50",
        "description": "some description",
        "category_id": 5,
        "attributes": null,
        "parameters": null,
        "regular_price": 10,
        "offer_price": 8,
        "tax": 1,
        "main_image": "oNc1VcdkBRY7jPOIVSwkROIF7cZgVIUcBkfHnUlb.jpeg",
        "created_at": "2018-01-03 12:15:30",
        "updated_at": "2018-01-05 11:00:07",
        "barcode": null,
        "offer_end": "2018-02-01 00:00:00",
        "user_id": 4,
        "certificate": true,
        "return_details": "14 d",
        "purchase_count": 0,
        "rating": 4.3,
        "store_delivery": true,
        "images": [],
        "reviews": [
            {
                "review": "ok",
                "product_id": 50,
                "customer_id": 1,
                "customer": {
                    "id": 1,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            },
            {
                "review": "клево",
                "product_id": 50,
                "customer_id": 2,
                "customer": {
                    "id": 2,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            },
            {
                "review": "perfect",
                "product_id": 50,
                "customer_id": 3,
                "customer": {
                    "id": 3,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            }
        ],
        "category": {
            "id": 5,
            "name": "Health & Beauty"
        },
        "local_delivery": {
            "distance": "101",
            "active": false
        }
    },
    "merchant": {
        "id": 2,
        "business_name": "bus 1",
        "longitude": 50.111,
        "latitude": 40,
        "created_at": "2017-12-12 12:50:03",
        "address": "My delivery address3123123",
        "rating": 3.75,
        "merchants_reviews": [
            {
                "review": "good",
                "rate": 5,
                "merchant_id": 2,
                "customer_id": 1,
                "customer": {
                    "id": 1,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            },
            {
                "review": "wertger",
                "rate": 3,
                "merchant_id": 2,
                "customer_id": 1,
                "customer": {
                    "id": 1,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            },
            {
                "review": "fawer",
                "rate": 2,
                "merchant_id": 2,
                "customer_id": 2,
                "customer": {
                    "id": 2,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            },
            {
                "review": "hello world",
                "rate": 5,
                "merchant_id": 2,
                "customer_id": 3,
                "customer": {
                    "id": 3,
                    "first_name": "Artem",
                    "last_name": "Petrov"
                }
            }
        ]
    }
}

###

###
@api {post} /api/products/update Update product
@apiName Update product by merchant. Only for active merchants
@apiGroup Products
@apiDescription
  Max file size - 5 MB. Max dimension - 2436px X 2436px. Extensions - jpg, jpeg, png.
  Path to origin photo: storage/images/products/origin.
  Path to thumbs: storage/images/products/thumbs
@apiVersion 0.1.0

@apiParam {Integer} product_id Required. Product which should be edited
@apiParam {File} main_image Required.
@apiParam {Json} attributes Ex: {{"color": {"type": "digits","value": "10000"}, "size": {"type": "text","value": "dfhgsdfhg"}}
@apiParam {Json} parameters Ex: {"quantity": "100500", "valid_date":{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "09.00 AM", "valid_time_to": "08.00 PM"}, "other_restrictions":"some text", "not_valid_on_holidays": "true"}
@apiParam {String} name Required.
@apiParam {String} description Required.
@apiParam {Float} regular_price Required. Ex: 99.99. Coins must be present
@apiParam {Float} offer_price Required. Ex: 99.99. Coins must be present. Should not be more than regular_price
@apiParam {Integer} category_id Required. Category should be final
@apiParam {Boolean} store_delivery Required.
@apiParam {Boolean} local_delivery Required.
@apiParam {String} local_delivery_distance Required if local_delivery is true. Should contain only digits. Min - 1. Max 1000 symbols
@apiParam {Integer} barcode 13 digits certain
@apiParam {Timestamp} offer_end Required
@apiParam {Boolean} certificate Required
@apiParam {String} return_details Required

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'success': true
}

@apiErrorExample Error-Response not JSON:
HTTP/1.1 422 Bad request
{
    "message": "The given data was invalid.",
    "errors": {
        "attributes": [
            "The attributes must be a valid JSON string."
        ],
        "parameters": [
            "The parameters must be a valid JSON string."
        ]
    }
}

@apiErrorExample Error-Response wrong images:
HTTP/1.1 422 Bad request
{
    "message": "The given data was invalid.",
    "errors": {
        "images": [
            "The images may not have more than 5 items."
        ],
        "images.1": [
            "The images.1 must be less than or equal to 2436 pixels wide and less than or equal to 2436 pixels tall."
        ]
    }
}

@apiErrorExample Error-Response no permissions:
HTTP/1.1 401 Bad request
{
    "message": "",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\HttpException",
    "file": "/var/www/html/vendor/laravel/framework/src/Illuminate/Foundation/Application.php",
    "line": 940,
    "trace": [ ... ]
}
###

###
@api {get} /api/products/other-merchant-products Get other merchant products
@apiName Get other merchant products
@apiGroup Products
@apiDescription Get other merchant products. Available for guest.
@apiVersion 0.1.0

@apiParam {Integer} product_id Required. Product which should be ignored
@apiParam {Integer} merchant_id Required.
@apiParam {Integer} offset If empty uses default value 0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 54,
            "name": "drop images test",
            "description": "some description",
            "attributes": null,
            "parameters": null,
            "regular_price": 10,
            "offer_price": 8,
            "tax": 1,
            "store_delivery": false,
            "local_delivery": {
                "distance": "100500",
                "active": true
            }            "main_image": "ezvUvebPZow4YThRLaRfKbRzJJBqOa8PBgcljWr7.png",
            "barcode": null,
            "offer_end": "2018-02-01 00:00:00",
            "certificate": true,
            "return_details": "14 d",
            "purchase_count": 0,
            "rating": 3.9
        },
        {
            "id": 55,
            "name": "drop images test",
            "description": "some description",
            "attributes": null,
            "parameters": null,
            "regular_price": 10,
            "offer_price": 8,
            "tax": 1,
            "store_delivery": false,
            "local_delivery": {
                "distance": "100500",
                "active": true
            }            "main_image": "nOy7qXE3p8psSaVItuDxUJbBparc9mnAbX6hhErV.png",
            "barcode": null,
            "offer_end": "2018-02-01 00:00:00",
            "certificate": true,
            "return_details": "14 d",
            "purchase_count": 0,
            "rating": 0
        },
        {
            "id": 56,
            "name": "drop images test",
            "description": "some description",
            "attributes": null,
            "parameters": null,
            "regular_price": 10,
            "offer_price": 8,
            "tax": 1,
            "store_delivery": false,
            "local_delivery": {
                "distance": "100500",
                "active": true
            }            "main_image": "/tmp/phpBekMx3",
            "barcode": null,
            "offer_end": "2018-02-01 00:00:00",
            "certificate": true,
            "return_details": "14 d",
            "purchase_count": 0,
            "rating": 3.9
        },
        {
            "id": 57,
            "name": "drop images test",
            "description": "some description",
            "attributes": null,
            "parameters": null,
            "regular_price": 10,
            "offer_price": 8,
            "tax": 1,
            "store_delivery": false,
            "local_delivery": {
                "distance": "100500",
                "active": true
            }            "main_image": "P9H3sb7JKQ7iigPIABsN211LQCra8NRw4boQx1pS.jpeg",
            "barcode": null,
            "offer_end": "2018-02-01 00:00:00",
            "certificate": true,
            "return_details": "14 d",
            "purchase_count": 0,
            "rating": 0
        }
    ]
}
###
