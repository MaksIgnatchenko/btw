###
@api {get} /api/web-offers/ Get web offers
@apiName Get cart
@apiDescription Get web offers. Return 5 items. Available for guest
@apiGroup WebOffers
@apiVersion 0.1.0

@apiParam {String} name Max 500 symbols
@apiParam {String} upc Max 20 symbols
@apiParam {Integer} category_id

@apiSuccessExample Success-Response:
HTTP/1.1 200 OK
{
  "items": [
    {
      "name": "Event-line Light Up Iphone7+ Case",
      "merchant": "Zilingo AU",
      "price": 41.85,
      "imageUrl": "https://images.viglink.com/product/250x250/dj7u9rvtp3yka-cloudfront-net/a3516ce34fc8fe1306fd49aa1b659e479403a77b.jpg?url=https%3A%2F%2Fdj7u9rvtp3yka.cloudfront.net%2Fproducts%2FPIM-1495029743962-7e95beb3-5f7e-4458-bc3d-61be4e26ca2b_v1-large.jpg",
      "url": "http://redirect.viglink.com?u=https%3A%2F%2Fzilingo.com%2Fth-th%2Fproduct%2Fdetails%2FPRO6834928085%3Fcolor%3Dno_color&key=830496bd6157c66cb64fe9101a8fca7d&type=FE"
      "rating": "4.5"
  },
    {
      "name": "Tempered Glass Screen protedtion/iPhone7+",
      "merchant": "Saks Fifth Avenue OFF 5TH",
      "price": 12.99,
      "imageUrl": "https://images.viglink.com/product/250x250/image-s5a-com/b19436a32c61634c0a9561370eef8502a943ae21.jpg?url=http%3A%2F%2Fimage.s5a.com%2Fis%2Fimage%2Fsaksoff5th%2F0400093777250_300x400.jpg",
      "url": "http://redirect.viglink.com?u=http%3A%2F%2Fwww.saksoff5th.com%2Fmain%2FProductDetail.jsp%3FPRODUCT%3C%3Eprd_id%3D845524442212917&key=830496bd6157c66cb64fe9101a8fca7d&type=FE"
      "rating": "4.5"
  },
    {
      "name": "Event-line Light Up Iphone7+ Case 2",
      "merchant": "Zilingo AU",
      "price": 41.85,
      "imageUrl": "https://images.viglink.com/product/250x250/dj7u9rvtp3yka-cloudfront-net/a3516ce34fc8fe1306fd49aa1b659e479403a77b.jpg?url=https%3A%2F%2Fdj7u9rvtp3yka.cloudfront.net%2Fproducts%2FPIM-1495029743962-7e95beb3-5f7e-4458-bc3d-61be4e26ca2b_v1-large.jpg",
      "url": "http://redirect.viglink.com?u=https%3A%2F%2Fzilingo.com%2Fth-th%2Fproduct%2Fdetails%2FPRO7724560412%3Fcolor%3Dno_color&key=830496bd6157c66cb64fe9101a8fca7d&type=FE",
      "rating": "4.5"
    },
    {
      "name": "Event-line Light Up Iphone7+ Case 3",
      "merchant": "Zilingo AU",
      "price": 41.85,
      "imageUrl": "https://images.viglink.com/product/250x250/dj7u9rvtp3yka-cloudfront-net/b98b10a063d63921a687979bfc2df0a8ee414ba3.jpg?url=https%3A%2F%2Fdj7u9rvtp3yka.cloudfront.net%2Fproducts%2FPIM-1495029744870-e030fc59-6d1b-49c4-902b-84b76998beaf_v1-large.jpg",
      "url": "http://redirect.viglink.com?u=https%3A%2F%2Fzilingo.com%2Fth-th%2Fproduct%2Fdetails%2FPRO2404295059%3Fcolor%3Dno_color&key=830496bd6157c66cb64fe9101a8fca7d&type=FE",
      "rating": "4"
    },
  ]
}
###