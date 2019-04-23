<?php


use App\Modules\Categories\Models\Category;
use App\Modules\Products\Enums\ProductOrdersEnum;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
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
    public function showPositive()
    {
        $product = $this->mockProduct()[0];
        $this->assertDatabaseHas('products', ['id' => $product->id]);
        $response = $this->jsonAuthorized('GET', route('api.products.show', ['id' => $product->id]));
        $response->assertStatus(200)->assertJson([
            'product' => $product->toArray()
        ]);
    }

    /**
     * @test
     */
    public function showNegative()
    {
        $product = $this->mockProduct()[0];
        $this->assertDatabaseHas('products', ['id' => $product->id]);
        $response = $this->jsonAuthorized('GET', route('api.products.show', ['id' => $product->id + 1]));
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function popular()
    {
        $products = $this->mockProduct([], 5)->reverse();
        $response = $this->jsonAuthorized('GET', route('api.products.popular'));
        $response->assertStatus(200)
            ->assertJson([
                'products' => $products->toArray()
            ]);
    }
    /**
     * @test
     * @dataProvider customerSearchProvider
     * @param array $input
     * @param array $expected
     */
    public function customerSearchPositive(array $input, array $expected)
    {
        $product = $this->mockProduct($input['product'])[0];
        $response = $this->jsonAuthorized('GET', route('api.products.search'), $input['request']);
        if($response->getStatusCode() !== 200)
            dd($input, $expected, $response->getContent());
        $response->assertStatus(200)
            ->assertJson($expected);
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
            'category ids' => [
                'input' => [
                    'product' => [
                        'price' => $greaterPrice,
                        'created_at' => Carbon::now()->subDays(3),
                        'category_id' => 8,
                    ],
                    'request' => [
                        'category' => [8],
                    ]

                ],
                'expected' => [
                    'products' => [
                        [
                            'price' => $greaterPrice,
                            'created_at' => Carbon::now()->subDays(3),
                            'category_id' => 8,
                        ]
                    ]
                ]
            ],
            'order' => [
                'input' => [
                    'product' => [
                        'price' => $greaterPrice,
                        'created_at' => Carbon::now()->subDays(3)
                    ],
                    'request' => [
                        'order' => ProductOrdersEnum::RATING_LOWEST,
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
            'keywords' => [
                'input' => [
                    'product' => [
                        'name' => 'Test product',
                        'price' => $greaterPrice,
                        'created_at' => Carbon::now()->subDays(3),
                    ],
                    'request' => [
                        'keyword' => 'test',
                    ]

                ],
                'expected' => [
                    'products' => [
                        [
                            'name' => 'Test product',
                            'price' => $greaterPrice,
                            'created_at' => Carbon::now()->subDays(3),
                        ]
                    ]
                ]
            ],
        ];
    }
}