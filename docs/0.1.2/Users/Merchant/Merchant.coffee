###
@api {get} /api/merchant/:id Get Merchant data
@apiName Get Merchant data
@apiGroup Merchant
@apiPermission Guest
@apiVersion 0.1.2

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "merchant": {
        "id": 11,
        "first_name": "kjhkjh",
        "last_name": "khkjhkjh",
        "email": "admin@fanajeen.com",
        "created_at": "2018-10-22 13:46:00",
        "updated_at": "2018-10-22 13:46:00",
        "avatar": null,
        "background_img": null,
        "store": {
            "id": 1,
            "name": "gfhgfhgfhg",
            "country": "AR",
            "city": "fhfghfhgfhgfhg",
            "info": "cbbcvbbvcbvbvcbvc",
            "merchant_id": 11,
            "created_at": "2018-10-22 13:46:01",
            "updated_at": "2018-10-22 13:46:01"
        }
    }
}
###

###
@api {get} /api/merchant/:id/products Get Merchant Products
@apiName Get Merchant Products
@apiGroup Merchant
@apiPermission Guest
@apiVersion 0.1.2

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "products": [
        {
            "id": 21,
            "name": "Test Product #1",
            "category_id": 8,
            "attributes": null,
            "quantity": 3,
            "price": "238.67",
            "main_image": "demo.jpeg",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do \n        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation \n        ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit \n        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui \n        officia deserunt mollit anim id est laborum.",
            "store_id": 1,
            "merchant_id": 11
        },
        {
            "id": 22,
            "name": "Test Product #2",
            "category_id": 7,
            "attributes": null,
            "quantity": 10,
            "price": "171.43",
            "main_image": "demo.jpeg",
            "created_at": "2018-10-08 16:26:41",
            "updated_at": "2018-10-08 16:26:41",
            "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do \n        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation \n        ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit \n        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui \n        officia deserunt mollit anim id est laborum.",
            "store_id": 1,
            "merchant_id": 11
        }
    ]
}
###