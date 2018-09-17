###
@api {get} /api/notifications Get notifications
@apiName Get notifications
@apiDescription Get notifications. Page limit - 50. Available for active users
@apiGroup Notifications
@apiVersion 0.1.0

@apiParam {integer} offset Default - 0


@apiSuccessExample Success:
HTTP/1.1 200 OK
{
    "notifications": [
        {
            "id": 70,
            "message": "You have review!",
            "is_read": false,
            "created_at": "2018-02-15 13:32:47",
            "title": "Review"
        },
        {
            "id": 70,
            "message": "You have review!",
            "is_read": false,
            "created_at": "2018-02-15 13:32:18",
            "title": "Review"
        },
        {
            "id": 70,
            "message": "You have new product review!",
            "is_read": false,
            "created_at": "2018-02-15 13:31:39",
            "title": "Product review"
        },
        {
            "id": 70,
            "message": "You have review!",
            "is_read": false,
            "created_at": "2018-02-15 11:16:07",
            "title": ""
        },
        {
            "id": 70,
            "message": "You have new product review!",
            "is_read": true,
            "created_at": "2018-02-15 11:06:10",
            "title": ""
        }
    ]
}
###

###
@api {delete} /api/notifications/{key} Delete notification
@apiName Delete notification
@apiDescription Delete notification. User can delete only his notifications
@apiGroup Notifications
@apiVersion 0.1.0


@apiSuccessExample Success:
HTTP/1.1 200 OK
{
    "success": true
}

@apiErrorExample No such :
HTTP/1.1 400 Bad request
{
    "message": "No such notification"

}

@apiErrorExample No permissions:
HTTP/1.1 403 Forbidden
{
    "message": "You can delete only your own notifications"

}
###