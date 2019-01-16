###
@api {get} /api/cart Get Customer`s Cart
@apiName Get Customer`s Cart
@apiGroup Cart
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "cart": [
        {
            "id": 2,
            "quantity": 5,
            "customer_id": 1,
            "product_id": 22,
            "created_at": "2018-10-30 16:13:11",
            "updated_at": "2018-10-31 14:06:23",
            "product": {
                "id": 22,
                "name": "Test Product #2",
                "category_id": 7,
                "attributes": null,
                "quantity": 10,
                "price": "171.43",
                "delivery_price": "10.05",
                "main_image": "demo.jpeg",
                "created_at": "2018-10-08 16:26:41",
                "updated_at": "2018-10-08 16:26:41",
                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do \n        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation \n        ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit \n        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui \n        officia deserunt mollit anim id est laborum."
            }
        },
        {
            "id": 3,
            "quantity": 3,
            "customer_id": 1,
            "product_id": 23,
            "created_at": "2018-10-30 16:13:27",
            "updated_at": "2018-10-30 16:54:27",
            "product": {
                "id": 23,
                "name": "Test Product #3",
                "category_id": 7,
                "attributes": null,
                "quantity": 3,
                "price": "115.52",
                "delivery_price": "10.05",
                "main_image": "demo.jpeg",
                "created_at": "2018-10-08 16:26:41",
                "updated_at": "2018-10-08 16:26:41",
                "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do \n        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation \n        ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit \n        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui \n        officia deserunt mollit anim id est laborum."
            }
        }
    ]
}
###

###
@api {post} /api/cart Add Product to Cart
@apiName Add Product to Cart
@apiGroup Cart
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiParam {Integer} product_id Product ID
@apiParam {Integer} quantity Optional. Product quantity

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###

###
@api {put} /api/cart/:id Update quantity of Product in Cart
@apiName Update quantity of Product in Cart
@apiGroup Cart
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>
@apiHeader {String} Content-Type <code>application/x-www-form-urlencoded</code>

@apiParam {Integer} quantity Product quantity

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###

###
@api {delete} /api/cart/:id Delete Product from Cart
@apiName Delete Product from Cart
@apiGroup Cart
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###

###
@api {get} /api/cart/check Check possibility to purchase the Cart
@apiName Check possibility to purchase the Cart
@apiGroup Cart
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###