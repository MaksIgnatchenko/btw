###
  @api {post} /api/reviews Add Review to Product and Merchant
  @apiName Add Review to Product and Merchant
  @apiGroup Reviews
  @apiPermission Customer
  @apiVersion 0.1.2

  @apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

  @apiParam {Integer} order_id Order ID
  @apiParam {Integer} merchant_rating Merchant rating. Min: 1, Max: 5
  @apiParam {String}  merchant_comment Optional. Merchant comment
  @apiParam {Integer} merchant_rating Product rating. Min: 1, Max: 5
  @apiParam {String}  product_comment Optional. Product comment

  @apiSuccessExample Success-Response:
  HTTP/1.1 200 OK
  {
    "success": true
  }
###
###
  @api {get} /api/reviews/product/:id Get active reviews by Product ID
  @apiName Get list of active reviews by Product ID
  @apiGroup Reviews
  @apiPermission Customer
  @apiVersion 0.1.2

  @apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

  @apiParam {Integer}  offset Optional. Result offset

  @apiSuccessExample Success-Response:
  HTTP/1.1 200 OK
  {
    "reviews": [
        {
            "id": 16,
            "order_id": 1,
            "customer_id": 1,
            "product_id": 1,
            "rating": 3,
            "comment": "product review test 1",
            "status": "active",
            "created_at": "2019-02-15 10:38:59",
            "updated_at": "2019-02-15 10:38:59"
        },
        {
            "id": 17,
            "order_id": 1,
            "customer_id": 1,
            "product_id": 1,
            "rating": 4,
            "comment": "product review test 2",
            "status": "active",
            "created_at": "2019-02-15 10:39:19",
            "updated_at": "2019-02-15 10:39:19"
        }
    ]
  }
###
###
  @api {get} /api/reviews/merchant/:id Get active reviews by Merchant ID
  @apiName Get list of active reviews by Merchant ID
  @apiGroup Reviews
  @apiPermission Customer
  @apiVersion 0.1.2

  @apiHeader {String} Authorization <code><b>token_type</b> <b>access_token</b></code>

  @apiParam {Integer}  offset Optional. Result offset

  @apiSuccessExample Success-Response:
  HTTP/1.1 200 OK
  {
    "reviews": [
        {
            "id": 29,
            "order_id": 1,
            "customer_id": 1,
            "merchant_id": 2,
            "rating": 2,
            "comment": "test merchant comment",
            "created_at": "2019-02-15 10:38:59",
            "updated_at": "2019-02-15 10:38:59"
        },
        {
            "id": 30,
            "order_id": 1,
            "customer_id": 1,
            "merchant_id": 2,
            "rating": 5,
            "comment": "test merchant comment",
            "created_at": "2019-02-15 10:39:19",
            "updated_at": "2019-02-15 10:39:19"
        }
    ]
  }
###