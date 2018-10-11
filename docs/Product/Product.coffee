###
@api {get} /api/products/popular Get Popular Products
@apiName Get Categories tree
@apiGroup Product
@apiPermission Guest
@apiVersion 0.1.0

@apiParam {Integer} offset Optional. Result offset

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 21,
            "name": "Test Product #1",
            "price": "238.67",
            "main_image": "demo.jpeg",
            "quantity": 8,
            "attributes": null
        },
        {
            "id": 22,
            "name": "Test Product #2",
            "price": "171.43",
            "main_image": "demo.jpeg",
            "quantity": 10,
            "attributes": null
        },
        {
            "id": 23,
            "name": "Test Product #3",
            "price": "115.52",
            "main_image": "demo.jpeg",
            "quantity": 3,
            "attributes": null
        }
    ]
}
###

###
@api {get} /api/products/search Get Products by search criterias
@apiName Get Products by search criterias
@apiGroup Product
@apiPermission Guest
@apiVersion 0.1.0

@apiParam {Integer} offset Optional. Result offset
@apiParam {String} keyword Optional. Search pattern
@apiParam {Integer} ffcd Optional. Filter <b>Days from adding less than</b>
@apiParam {Decimal} fplt Optional. Filter <b>Price less than</b>
@apiParam {Decimal} fpgt Optional. Filter <b>Price greater than</b>
@apiParam {String} order Optional. Available values: <code>lowest_price</code>, <code>highest_price</code>
@apiParam {Integer} category Optional. Category ID

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 30,
            "name": "Test Product #10",
            "description": "Test Product #10 Desc",
            "category_id": 6,
            "attributes": null,
            "quantity": 9,
            "price": "721.68",
            "main_image": "demo.jpeg",
            "offer_end": "2018-12-03 16:26:41",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41"
        },
        {
            "id": 22,
            "name": "Test Product #2",
            "description": "Test Product #2 Desc",
            "category_id": 7,
            "attributes": null,
            "quantity": 10,
            "price": "171.43",
            "main_image": "demo.jpeg",
            "offer_end": "2018-12-06 16:26:41",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41"
        },
        {
            "id": 23,
            "name": "Test Product #3",
            "description": "Test Product #3 Desc",
            "category_id": 7,
            "attributes": null,
            "quantity": 3,
            "price": "115.52",
            "main_image": "demo.jpeg",
            "offer_end": "2018-11-22 16:26:41",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41"
        }
    ]
}
###

###
@api {get} /api/products/get/:id Get single Product by ID
@apiName Get single Product by ID
@apiGroup Product
@apiPermission Guest
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "product": {
        "id": 22,
        "name": "Test Product #2",
        "description": "Test Product #2 Desc",
        "category_id": 7,
        "attributes": null,
        "quantity": 10,
        "price": "171.43",
        "main_image": "demo.jpeg",
        "offer_end": "2018-12-06 16:26:41",
        "created_at": "2018-10-08 16:26:41",
        "updated_at": "2018-10-08 16:26:41",
        "images": [],
        "category": {
            "id": 7,
            "name": "Phones"
        }
    }
}
###