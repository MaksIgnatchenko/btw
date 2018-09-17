###
@api {post} /api/declined-wish Add wish to declined
@apiName Add wish to declined
@apiDescription Add wish to declined. Available for active merchants
@apiGroup Bidding
@apiVersion 0.1.0

@apiParam {Integer} wish_id Required.

@apiSuccessExample Success-response:
HTTP/1.1 200 OK
{
    "success": true
}

@apiErrorExample Already declined:
HTTP/1.1 422 Unprocessable Entity
{
    "message": "The given data was invalid.",
    "errors": {
        "wish_id": [
            "You are already declined this wish."
        ]
    }
}

@apiErrorExample Wrong wish end:
HTTP/1.1 422 Unprocessable Entity
{
    "message": "The given data was invalid.",
    "errors": {
        "wish_id": [
            "Wish end date should be in future."
        ]
    }
}
###
