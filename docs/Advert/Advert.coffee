###
@api {get} /api/advert Get advert info
@apiName Get advert info
@apiDescription Get advert info. Path for images: storage/images/adverts/origin/. Available for guests
@apiGroup Advert
@apiVersion 0.1.0

@apiSuccessExample Custom mode:
HTTP/1.1 200 OK
{
    "advert": {
        "link": "http://amazon.com",
        "image": "ZArDumNPq0jlOkkS1EONB1GE6uaN1c58aeZaNvEN.jpeg"
    },
    "mode": "custom"
}

@apiSuccessExample Admob mode:
HTTP/1.1 200 OK
{
    "advert": null,
    "mode": "admob"
}

@apiErrorExample No available banners when custom mode:
HTTP/1.1 400 Error
{
    "message": "There is no active banners!",
}
###
