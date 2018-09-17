###
@api {get} /api/merchants/categories/get Get merchant categories
@apiName Get merchant categories
@apiDescription Only for active merchants
@apiGroup MerchantCategories
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "categories": [ // can be empty array
        1,
        26
    ]
}
###

###
@api {post} /api/merchants/categories/set Set merchant categories
@apiName set merchant categories
@apiDescription Only for active merchants
@apiGroup MerchantCategories
@apiVersion 0.1.0

@apiParam {Array} categories[] Required. Example: categories[]: 1, categories[]: 100500. Each category as separate field

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###
