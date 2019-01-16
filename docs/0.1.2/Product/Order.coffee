###
@api {get} /api/orders Get Customer`s Orders
@apiName Get Customer`s Orders
@apiGroup Order
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiParam {String} filter Required. Available filters: all, in_process, shipped, delivered, picked_up

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "orders": [
         {
                    "id": 5,
                    "merchant_id": 2,
                    "transaction_id": "5",
                    "product": {
                        "id": 315,
                        "name": "Test product",
                        "price": 3,
                        "store": {
                            "id": 2,
                            "name": "Test Store",
                            "merchant_id": 2
                        },
                        "main_image": "http://wish.appus.work/storage/images/products/main_images/original/2/lJeeIh2fuyzUAtZbMm8IaXPDZKLA2R1HzZdwg7BV.jpeg",
                        "main_image_thumb": "http://wish.appus.work/storage/images/products/main_images/thumbs/2/lJeeIh2fuyzUAtZbMm8IaXPDZKLA2R1HzZdwg7BV.jpeg",
                        "description": "Test product description"
                    },
                    "quantity": 1,
                    "created_at": "2018-11-16 16:06:30",
                    "updated_at": "2018-11-16 16:06:30",
                    "status": "in_process"
                },
                {
                    "id": 6,
                    "merchant_id": 2,
                    "transaction_id": "5",
                    "product": {
                        "id": 318,
                        "name": "Test product 2",
                        "price": 4,
                        "store": {
                            "id": 2,
                            "name": "Test Store",
                            "merchant_id": 2
                        },
                        "main_image": "http://wish.appus.work/storage/images/products/main_images/original/2/lJeeIh2fuyzUAtZbMm8IaXPDZKLA2R1HzZdwg7BV.jpeg",
                        "main_image_thumb": "http://wish.appus.work/storage/images/products/main_images/thumbs/2/lJeeIh2fuyzUAtZbMm8IaXPDZKLA2R1HzZdwg7BV.jpeg",
                        "description": "Test product description"
                    },
                    "quantity": 1,
                    "created_at": "2018-11-16 16:06:30",
                    "updated_at": "2018-11-21 13:56:48",
                    "status": "shipped"
                }
    ]
}

@apiErrorExample Error-Response:
HTTP/1.1 422 Unprocessable Entity
{
    "message": "The given data was invalid.",
    "errors": {
        "filter": [
            "Wrong value. Available values - in_process,shipped,delivered,picked_up,all"
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
                     "id": 5,
                     "merchant_id": 2,
                     "transaction_id": "5",
                     "product": {
                         "id": 315,
                         "name": "Test product",
                         "price": 3,
                         "store": {
                             "id": 2,
                             "name": "Test Store",
                             "merchant_id": 2
                         },
                         "main_image": "http://wish.appus.work/storage/images/products/main_images/original/2/lJeeIh2fuyzUAtZbMm8IaXPDZKLA2R1HzZdwg7BV.jpeg",
                         "main_image_thumb": "http://wish.appus.work/storage/images/products/main_images/thumbs/2/lJeeIh2fuyzUAtZbMm8IaXPDZKLA2R1HzZdwg7BV.jpeg",
                         "description": "Test product description"
                     },
                     "quantity": 1,
                     "created_at": "2018-11-16 16:06:30",
                     "updated_at": "2018-11-16 16:06:30",
                     "status": "in_process"
                 }
}

@apiErrorExample Error-Response:
HTTP/1.1 400 Bad Request
{
    "message": "There is no such order"
}
###