###
@api {put} /api/customer/profile Update profile
@apiName Update profile
@apiGroup Profile
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>
@apiHeader {String} Content-Type <code>application/x-www-form-urlencoded</code>

@apiParam {String} first_name
@apiParam {String} last_name
@apiParam {String} email

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "status": "success"
}
###

###
@api {post} /api/customer/profile/avatar Upload avatar
@apiName Upload avatar
@apiGroup Profile
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiParam {File} avatar

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "avatar": avatar_full_url
}
###

###
@api {put} /api/customer/profile/delivery-information Change customers delivery information
@apiName Change customers delivery information
@apiGroup Profile
@apiPermission Customer
@apiVersion 0.1.2

@apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

@apiParam {string} country Available values: USA
@apiParam {string} street max 100 symbols
@apiParam {string} [apartment] min 2 max 100 symbols
@apiParam {string} city min 2 max 100 symbols
@apiParam {string} state  max 100 symbols
@apiParam {integer} zip 5 digits
@apiParam {string} [notes] max 100 symbols

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "country": "USA",
    "street": "wall street",
    "apartment": "123 room", // -Apt., Suite, Unit,  can be null
    "city": "New york",
    "state": "New york",
    "zip": "12345",
    "notes": "text" // can be null
}
###
