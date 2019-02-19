###
@api {get} /api/customer/recently-viewed Get Products that costumer recently viewed
@apiName Get recently viewed products
@apiGroup RecentlyViewed
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
            "id": 2,
            "name": "test product 1",
            "category_id": 1,
            "attributes": null,
            "quantity": 0,
            "price": 1,
            "delivery_price": 1,
            "main_image": "http://localhost/localhost/storage/images/products/main_images/original/1",
            "created_at": null,
            "updated_at": null,
            "description": "test",
            "store_id": 1,
            "is_in_wish_list": false,
            "merchant_id": 1,
            "rating": 0,
            "store": {
                "id": 1,
                "name": "Appus",
                "country": "UA",
                "city": "Kharkov",
                "info": "Some long text description",
                "merchant_id": 1,
                "created_at": "2019-02-19 12:26:44",
                "updated_at": "2019-02-19 12:26:44",
                "merchant": {
                    "id": 1,
                    "first_name": "Appus Merchant",
                    "last_name": "Tester",
                    "email": "merchant@wish.com",
                    "created_at": "2019-02-19 12:26:44",
                    "updated_at": "2019-02-19 12:26:44",
                    "avatar": null,
                    "background_img": null,
                    "phone": "123456789",
                    "rating": 0
                }
            }
        }
    ]
}
###
###
@api {delete} /api/customer/recently-viewed Clear recently viewed list
@apiName Clear recently viewed list
@apiGroup RecentlyViewed
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
@api {delete} /api/customer/recently-viewed/{product} Remove product from recently viewed list
@apiName Remove product from recently viewed list
@apiGroup RecentlyViewed
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
     "success": true

}
###