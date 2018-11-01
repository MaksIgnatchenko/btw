###
@api {get} /api/customer/wishlist Get Customer`s WishList
@apiName Get Customer WishList
@apiGroup WishList
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiParam {Integer} offset Optional. Result offset
@apiParam {String} keyword Optional. Search pattern

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 21,
            "name": "Test Product #1",
            "description": "Test Product #1 Desc",
            "category_id": 8,
            "attributes": null,
            "quantity": 8,
            "price": "238.67",
            "main_image": "demo.jpeg",
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
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41"
        },
        {
            "id": 27,
            "name": "Test Product #7",
            "description": "Test Product #7 Desc",
            "category_id": 8,
            "attributes": null,
            "quantity": 19,
            "price": "921.23",
            "main_image": "demo.jpeg",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41"
        }
    ]
}
###

###
@api {post} /api/customer/wishlist/add/:id Add Product to Customer`s WishList
@apiName Add Product to Customer`s WishList
@apiGroup WishList
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "status": "success"
}
###

###
@api {post} /api/customer/wishlist/remove/:id Remove Product from Customer`s WishList
@apiName Remove Product from Customer`s WishList
@apiGroup WishList
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "status": "success"
}
###