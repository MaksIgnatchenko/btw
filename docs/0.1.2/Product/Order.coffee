###
@api {get} /api/orders Get Customer`s Orders
@apiName Get Customer`s Orders
@apiGroup Order
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiParam {String} filter Required. Available filters: all, in_process, shipped

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "orders": [
        {
            "id": 1,
            "customer_id": 2,
            "merchant_id": 3,
            "transaction_id": "5",
            "product": {
                "id": 313,
                "name": "Test Product",
                "price": 2,
                "store": {
                    "id": 2,
                    "city": "Some city",
                    "info": "Some store info",
                    "name": "Test Store",
                    "country": "DK",
                    "merchant": {
                        "id": 2,
                        "email": "merchant@gmail.com",
                        "phone": "",
                        "avatar": null,
                        "last_name": "First Name",
                        "created_at": "2018-10-31 11:22:33",
                        "first_name": "Last Name",
                        "updated_at": "2018-10-31 11:22:33",
                        "background_img": null
                    },
                    "created_at": "2018-10-31 11:22:33",
                    "updated_at": "2018-10-31 11:22:33",
                    "merchant_id": 2
                },
                "quantity": 253,
                "store_id": 2,
                "attributes": [],
                "created_at": "2018-11-16 15:00:01",
                "main_image": "http://localhost:8050/storage/images/products/main_images/original/2/AiA1hnhRo3nwZxmC6xO8MMsKCbfr88724aa9l79F.jpeg",
                "updated_at": "2018-11-16 16:06:30",
                "category_id": 7,
                "description": "Some nice product"
            },
            "quantity": 1,
            "status": "in_process",
            "created_at": "2018-11-16 16:06:30",
            "updated_at": "2018-11-16 16:06:30"
        },
        {
            "id": 2,
            "customer_id": 2,
            "merchant_id": 2,
            "transaction_id": "5",
            "product": {
                "id": 314,
                "name": "Elephant",
                "price": 68,
                "store": {
                    "id": 2,
                    "city": "Some city",
                    "info": "Some store info",
                    "name": "Test Store",
                    "country": "DK",
                    "merchant": {
                        "id": 2,
                        "email": "merchant@gmail.com",
                        "phone": "",
                        "avatar": null,
                        "last_name": "First Name",
                        "created_at": "2018-10-31 11:22:33",
                        "first_name": "Last Name",
                        "updated_at": "2018-10-31 11:22:33",
                        "background_img": null
                    },
                    "created_at": "2018-10-31 11:22:33",
                    "updated_at": "2018-10-31 11:22:33",
                    "merchant_id": 2
                },
                "quantity": 29,
                "store_id": 2,
                "attributes": [],
                "created_at": "2018-11-16 15:00:51",
                "main_image": "http://localhost:8050/storage/images/products/main_images/original/2/My4bv9OuVDugj97kIxow5IfePRBKpvX5khiNJ9UG.jpeg",
                "updated_at": "2018-11-16 16:06:30",
                "category_id": 6,
                "description": "Some nice elephant"
            },
            "quantity": 1,
            "status": "in_process",
            "created_at": "2018-11-16 16:06:30",
            "updated_at": "2018-11-16 16:06:30"
        },

    ]
}

@apiErrorExample Error-Response:
HTTP/1.1 422 Unprocessable Entity
{
    "message": "The given data was invalid.",
    "errors": {
        "filter": [
            "Wrong value. Available values - in_process,shipped,all"
        ]
    }
}
###
###
@api {get} /api/orders/:id Get Customer`s Order
@apiName Get Customer`s Order
@apiGroup Order
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "order": {
        "id": 2,
        "merchant_id": 2,
        "transaction_id": "5",
        "product": {
            "id": 314,
            "name": "Elephant",
            "price": 68,
            "store": {
                "id": 2,
                "city": "Some city",
                "info": "Some store info",
                "name": "Test Store",
                "country": "DK",
                "merchant": {
                    "id": 2,
                    "email": "merchant@gmail.com",
                    "phone": "",
                    "avatar": null,
                    "last_name": "First Name",
                    "created_at": "2018-10-31 11:22:33",
                    "first_name": "Last Name",
                    "updated_at": "2018-10-31 11:22:33",
                    "background_img": null
                },
                "created_at": "2018-10-31 11:22:33",
                "updated_at": "2018-10-31 11:22:33",
                "merchant_id": 2
            },
            "quantity": 29,
            "store_id": 2,
            "attributes": [],
            "created_at": "2018-11-16 15:00:51",
            "main_image": "http://localhost:8050/storage/images/products/main_images/original/2/My4bv9OuVDugj97kIxow5IfePRBKpvX5khiNJ9UG.jpeg",
            "updated_at": "2018-11-16 16:06:30",
            "category_id": 6,
            "description": "Some nice elephant"
        },
        "quantity": 1,
        "status": "in_process",
        "created_at": "2018-11-16 16:06:30",
        "updated_at": "2018-11-16 16:06:30"
    }
}

@apiErrorExample Error-Response:
HTTP/1.1 400 Bad Request
{
    "message": "There is no such order"
}
###