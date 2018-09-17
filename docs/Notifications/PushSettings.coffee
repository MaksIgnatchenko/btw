###
@api {get} /api/push-settings Get push settings info
@apiName Get push settings info
@apiDescription Get push settings info. Available for active users
@apiGroup Notifications
@apiVersion 0.1.0

@apiSuccessExample Success-Merchant:
HTTP/1.1 200 OK
{
    "settings": {
        "enabled": false,
        "review": false,
        "wish_list": false,
        "new_transaction": false
    }
}

@apiSuccessExample Success-Customer:
HTTP/1.1 200 OK
{
    "settings": {
        "enabled": false,
        "new_posted_deal": false,
        "new_price_breaker": false,
        "redemption_reminder": false,
        "categories": [
            {
                "id": 5,
                "name": "Health & Beauty",
                "parent_category_id": 1,
                "is_final": false,
                "attributes": null,
                "parameters": null,
                "pivot": {
                    "push_customer_id": 1,
                    "category_id": 5,
                    "created_at": "2018-02-13 16:55:37",
                    "updated_at": "2018-02-13 16:55:38"
                }
            }
        ]
    }
}
###

###
@api {post} /api/push-settings Set push settings info
@apiName Set push settings info
@apiDescription Set push settings info. Available for active users
@apiGroup Notifications
@apiVersion 0.1.0

@apiParam {boolean} enabled Required
@apiParam {boolean} new_posted_deal Required for customer
@apiParam {boolean} new_price_breaker Required for customer
@apiParam {boolean} redemption_reminder Required for customer
@apiParam {integer} category_id[] For customer
@apiParam {boolean} review Required for merchant
@apiParam {boolean} wish_list Required for merchant
@apiParam {boolean} new_transaction Required for merchant

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###

