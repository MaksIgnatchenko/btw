###
@api {get} /api/products/popular Get Popular Products
@apiName Get Categories tree
@apiGroup Product
@apiPermission Guest
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiParam {Integer} offset Optional. Result offset

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 21,
            "name": "Test Product #1",
            "category_id": 8,
            "attributes": {
                "color": {
                    "type": "text",
                    "value": "Red"
                },
                "length" {
                    "type": "digit",
                    "value": "120"
                }
            },
            "quantity": 8,
            "price": "238.67",
            "delivery_price": "10.05",
            "main_image": "demo.jpeg",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "is_in_wish_list": false
        },
        {
            "id": 22,
            "name": "Test Product #2",
            "category_id": 7,
            "attributes": {
                "color": {
                    "type": "text",
                    "value": "Red"
                },
                "length" {
                    "type": "digit",
                    "value": "120"
                }
            },
            "quantity": 10,
            "price": "171.43",
            "delivery_price": "10.05",
            "main_image": "demo.jpeg",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit",
            "is_in_wish_list": false
        },
        {
            "id": 23,
            "name": "Test Product #3",
            "category_id": 7,
            "attributes": null,
            "quantity": 3,
            "price": "115.52",
            "main_image": "demo.jpeg",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
            "is_in_wish_list": false
        }
    ]
}
###

###
@api {get} /api/products/search Get Products by search criterias
@apiName Get Products by search criterias
@apiGroup Product
@apiPermission Guest
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiParam {Integer} offset Optional. Result offset
@apiParam {String} keyword Optional. Search pattern
@apiParam {Integer} ffcd Optional. Filter <b>Days from adding less than</b>
@apiParam {Decimal} fplt Optional. Filter <b>Price less than</b>
@apiParam {Decimal} fpgt Optional. Filter <b>Price greater than</b>
@apiParam {String} order Optional. Available values: <code>lowest_price</code>, <code>highest_price</code>
@apiParam {Array} category[] Optional. Category IDs. One root category or many final categories can be set

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 30,
            "name": "Test Product #10",
            "description": "Test Product #10 Desc",
            "category_id": 6,
            "attributes": {
                "color": {
                    "type": "text",
                    "value": "Red"
                },
                "length" {
                    "type": "digit",
                    "value": "120"
                }
            },
            "quantity": 9,
            "price": "721.68",
            "delivery_price": "10.05",
            "main_image": "demo.jpeg",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41",
            "is_in_wish_list": false
        },
        {
            "id": 22,
            "name": "Test Product #2",
            "description": "Test Product #2 Desc",
            "category_id": 7,
            "attributes": {
                "color": {
                    "type": "text",
                    "value": "Red"
                },
                "length" {
                    "type": "digit",
                    "value": "120"
                }
            },
            "quantity": 10,
            "price": "171.43",
            "delivery_price": "10.05",
            "main_image": "demo.jpeg",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41",
            "is_in_wish_list": true
        },
        {
            "id": 23,
            "name": "Test Product #3",
            "description": "Test Product #3 Desc",
            "category_id": 7,
            "attributes": null,
            "quantity": 3,
            "price": "115.52",
            "delivery_price": "10.05",
            "main_image": "demo.jpeg",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41",
            "is_in_wish_list": false
        }
    ]
}
###

###
@api {get} /api/products/get/:id Get single Product by ID
@apiName Get single Product by ID
@apiGroup Product
@apiPermission Guest
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "product": {
        "id": 22,
        "name": "Test Product #2",
        "description": "Test Product #2 Desc",
        "category_id": 7,
        "attributes": {
            "color": {
                "type": "text",
                "value": "Red"
            },
            "length" {
                "type": "digit",
                "value": "120"
            }
        },
        "quantity": 10,
        "price": "171.43",
        "delivery_price": "10.05",
        "main_image": "demo.jpeg",
        "created_at": "2018-10-08 16:26:41",
        "updated_at": "2018-10-08 16:26:41",
        "is_in_wish_list": false,
        "rating": 3.5,
        "images": [],
        "category": {
            "id": 7,
            "name": "Phones"
        }
    }
}
###