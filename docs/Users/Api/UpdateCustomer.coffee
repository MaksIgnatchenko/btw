###
@api {post} /api/customers/update/address Change customer address
@apiName Change customer address
@apiDescription Change customer address. Only for active customers
@apiGroup CustomerChanges
@apiVersion 0.1.0

@apiParam {String} address Required. Max 2000 symbols
@apiParam {Float} latitude Required
@apiParam {Float} longitude Required

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": "true"
}
###

###
@api {post} /api/customers/update/delivery-address Change delivery address
@apiDescription Change user delivery address. Only for active customers
@apiGroup CustomerChanges
@apiVersion 0.1.0

@apiParam {String} address Required. Max 2000 symbols
@apiParam {Float} latitude Required
@apiParam {Float} longitude Required

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": "true"
}
###
