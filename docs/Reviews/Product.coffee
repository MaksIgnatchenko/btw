###
@api {post} /api/review/product Create product review
@apiName Create product review
@apiDescription Create product review. Only for active customers
@apiGroup Review
@apiVersion 0.1.0

@apiParam {String} review Required. Max 500 symbols
@apiParam {Integer} order_id Required. Order must belong to current customer and be picked up

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}

@apiErrorExample Wrong order status:
HTTP/1.1 400 OK
{
    "message": "Order with id {order_id} must be picked up before you can left review",
}

@apiErrorExample Order doesn't belongs to customer:
HTTP/1.1 400 OK
{
    "message": "Order with id {order_id} doesn't belongs to customer with id {customer_id}",
}
###
