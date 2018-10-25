###
@api {get} /api/categories Get Categories tree
@apiName Get Categories tree
@apiGroup Category
@apiPermission Guest
@apiVersion 0.1.1

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "categories": [
        {
            "id": 1,
            "name": "Shop",
            "parent_category_id": null,
            "is_final": false,
            "icon": null,
            "attributes": null,
            "children": [
                {
                    "id": 4,
                    "name": "Electronics",
                    "parent_category_id": 1,
                    "is_final": false,
                    "icon": null,
                    "attributes": null,
                    "children": [
                        {
                            "id": 6,
                            "name": "Camera",
                            "parent_category_id": 4,
                            "is_final": true,
                            "icon": null,
                            "attributes": null,
                            "children": []
                        },
                        {
                            "id": 7,
                            "name": "Phones",
                            "parent_category_id": 4,
                            "is_final": true,
                            "icon": null,
                            "attributes": null,
                            "children": []
                        }
                    ]
                },
            ]
        },
    ]
}
###

###
@api {get} /api/categories/:id Get children tree for Category by ID
@apiName Get Content by Key
@apiGroup Category
@apiPermission Guest
@apiVersion 0.1.1

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "categories": [
        {
            "id": 11,
            "name": "Coffee & Deserts",
            "parent_category_id": 3,
            "is_final": false,
            "icon": null,
            "attributes": null,
            "children": [
                {
                    "id": 12,
                    "name": "Price Breaker",
                    "parent_category_id": 11,
                    "is_final": true,
                    "icon": null,
                    "attributes": null,
                    "children": []
                }
            ]
        }
    ]
}
###