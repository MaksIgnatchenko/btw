###
@api {get} /api/settings/get Get user settings
@apiName Get current user settings
@apiDescription By default all settings will be set in false
@apiGroup UserSettings
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "settings": {
        "touchId": false
    }
}
###

###
@api {post} /api/settings/set Set setting to user
@apiName Set setting to current user
@apiGroup UserSettings
@apiVersion 0.1.0

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###

###
@api {post} /api/settings/push-token Set push token
@apiName Set push token to current user\
@apiDescription Client should set push token while every login
@apiGroup UserSettings
@apiVersion 0.1.0

@apiParam {String} push_token Required. Max 255 symbols
@apiParam {String} device_type Required. Available values: Android, Ios

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "success": true
}
###