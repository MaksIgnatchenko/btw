###
@api {get} /api/categories/{id} Get information about categories
@apiName Get information about categories. Available for guest
@apiGroup Categories
@apiVersion 0.1.0

@apiParam {String} id Required. Search categories where parent_category_id == $id. If no id - server will return root categories

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
    "categories": [
        {
            "id": 3,
            "name": "Bar",
            "parent_category_id": null,
            "is_final": "0",
            "attributes": null,
            "parameters": null
        },
        {
            "id": 32,
            "name": "Shop13",
            "parent_category_id": 10,
            "is_final": "0",
            "attributes": [
                "{\"name\":\"Some name\",\"type\":\"text\"}"
            ],
            "parameters": null
        },
        {
            "id": 33,
            "name": "NewCategory11",
            "parent_category_id": null,
            "is_final": "0",
            "attributes": [
                "{\"name\":\"color\",\"type\":\"text\"}"
            ],
            "parameters": null
        },
        {
            "id": 35,
            "name": "No final",
            "parent_category_id": null,
            "is_final": null,
            "attributes": null,
            "parameters": null
        },
        {
            "id": 36,
            "name": "Final",
            "parent_category_id": null,
            "is_final": "1",
            "attributes": [
                "{\"name\":\"Color\",\"type\":\"text\"}",
                "{\"name\":\"Some name\",\"type\":\"digits\"}"
            ],
            "parameters": [
                "{\"name\":\"count\"}",
                "{\"name\":\"barcode\"}",
                "{\"name\":\"other_restrictions\"}"
            ]
        }
    ]
}
###
