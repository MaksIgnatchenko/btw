###
@api {post} /api/bid Make bid
@apiName Make bid
@apiDescription Make bid. Available for active merchants
@apiGroup Bidding
@apiVersion 0.1.0

@apiParam {Integer} wish_id Required. Product should be active (offer end > now)
@apiParam {Float} price Required. Price with tax shouldn't be more than wishes max price. Max 999999.99
@apiParam {Float} tax Required. 1 - 100 available values

@apiSuccessExample Success-response:
HTTP/1.1 200 OK
{
    "success": true
}

@apiErrorExample Too big price:
HTTP/1.1 422 Unprocessable Entity
{
    "message": "The given data was invalid.",
    "errors": {
        "desired_price": [
            "The sum of bid price and tax should be less or equal to Maximum price."
        ],
    }
}

@apiErrorExample Wrong wish end:
HTTP/1.1 422 Unprocessable Entity
{
    "message": "The given data was invalid.",
    "errors": {
        "wish_id": [
            "Wish end date should be in future.",
        ]
    }
}

@apiErrorExample Already bid:
HTTP/1.1 422 Unprocessable Entity
{
    "message": "The given data was invalid.",
    "errors": {
        "wish_id": [
            "You already bid this wish"
        ]
    }
}
###
