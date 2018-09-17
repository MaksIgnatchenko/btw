###
@api {post} /api/merchants/update/address Change merchant address
@apiName Change customer address
@apiDescription Change merchant address. Only for active merchant
@apiGroup MerchantChanges
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