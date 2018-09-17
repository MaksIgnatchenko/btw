###
@api {get} /api/content/get/{key} Get content
@apiName Get content by key. Available for guest
@apiGroup Content
@apiVersion 0.1.0

@apiParam {String} key Required. Available keys: terms-customer, terms-merchant

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    'content': {
        'title': 'Privacy & Policy',
        'value': 'Come privacy text',
    }
}

@apiErrorExample Error-Response:
HTTP/1.1 400 Bad request
{
    "message": 'No content with key {key}',
}
###
