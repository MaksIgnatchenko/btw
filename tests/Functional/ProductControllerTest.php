<?php


use App\Modules\Categories\Models\Category;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Models\Store;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 17.04.2019
 */

class ProductControllerTest extends TestCase
{


    /**
     * @test
     */
    public function show()
    {
        $product = $this->mockProduct();
        $this->assertDatabaseHas('products', ['id' => $product->id]);
        $response = $this->jsonAuthorized('GET', route('api.product.show', ['id' => $product->id]));
        $response->assertStatus(200)->assertJson([
            'product' => $product->toArray()
        ]);
    }

    /**
     * @test
     * @dataProvider customerSearchProvider
     */
    public function customerSearch(array $input, array $expected)
    {
        $product = $this->mockProduct($input['product']);

        $response = $this->jsonAuthorized('GET', route('api.product.search'), $input['request']);
        $response->assertStatus(200)
            ->assertJson($expected);
    }



    /**
     * @param array $attr
     * @return Product
     */
    public function mockProduct(array $attr = [])
    {
        $merchant = factory(App\Modules\Users\Merchant\Models\Merchant::class)->create();
        $store = factory(Store::class)->create([
            'merchant_id' => $merchant->id,
        ]);
        $category = factory(Category::class)->create();

        $attr = array_merge($attr, [
            'store_id' => $store->id,
            'category_id' => $category->id,
        ]);
        return factory(Product::class)->create($attr);
    }

    /**
     * @return array
     */
    public function customerSearchProvider()
    {
        $lessPrice = 50;
        $greaterPrice = 150;

        return [
            'fplt' => [
              'input' => [
                  'product' => [
                      'price' => $lessPrice,
                  ],
                  'request' => [
                      'fplt' => $lessPrice + 1,
                  ]

              ],
               'expected' => [
                       'products' => [
                           [
                               'price' => $lessPrice
                           ]
                       ]
               ]
            ],
            'fpgt' => [
                'input' => [
                    'product' => [
                        'price' => $greaterPrice,
                    ],
                    'request' => [
                        'fpgt' => $greaterPrice - 1,
                    ]

                ],
                'expected' => [
                    'products' => [
                        [
                            'price' => $greaterPrice
                        ]
                    ]
                ]
            ],
            'ffcd empty result' => [
                'input' => [
                    'product' => [
                        'price' => $greaterPrice,
                        'created_at' => Carbon::now()->subDays(3)
                    ],
                    'request' => [
                        'ffcd' => 1,
                    ]

                ],
                'expected' => [
                    'products' => [

                    ]
                ]
            ],
            'ffcd with product' => [
                'input' => [
                    'product' => [
                        'price' => $greaterPrice,
                        'created_at' => Carbon::now()->subDays(3)
                    ],
                    'request' => [
                        'ffcd' => 4,
                    ]

                ],
                'expected' => [
                    'products' => [
                        [
                            'price' => $greaterPrice,
                            'created_at' => Carbon::now()->subDays(3),
                        ]
                    ]
                ]
            ],
        ];
    }
}