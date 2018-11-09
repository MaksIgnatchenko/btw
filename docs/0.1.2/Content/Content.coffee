###
@api {get} /api/content/get/:key Get Content by Key. Available values: terms_and_conditions, privacy_policy, about_us
@apiName Get Content by Key
@apiGroup Content
@apiPermission Guest
@apiVersion 0.1.2

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "content": {
        "id": 5,
        "value": "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
          dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisiut aliquip ex ea
          commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillumdolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officiadeserunt mollit anim id est
          laborum.",
        "title": "Terms & Conditions"
    }
}

@apiErrorExample Wrong params:
HTTP/1.1 400 Bad Request
{
    "message": "No content with key terms_and_condition"
}
###