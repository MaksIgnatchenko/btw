<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 24.04.2019
 */

namespace Tests\Functional\Orders;


use App\Modules\Orders\Enums\OrderFilterEnum;
use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Exceptions\WrongFilterException;
use App\Modules\Orders\Models\Order;
use App\Modules\Products\Enums\ProductStatusEnum;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Models\Transaction;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    /**
     * @dataProvider indexDataProvider
     *
     */
    public function testIndexPositive($orderStatus, $fixture)
    {
        $order = $this->mockOrder(['status' => $orderStatus]);
        $response = $this->jsonAuthorized(
          'GET',
          route('orders.index'),
          $fixture['request']
        );
        $order = json_decode(json_encode($order), true);
        $response->assertStatus(200)->assertJson([
            'orders' => [$order],
        ]);
    }

    public function testShowPositive()
    {
        $order = $this->mockOrder();
        $response = $this->jsonAuthorized(
            'GET',
            route('orders.show', ['id' => $order->id])
        );

        $order = json_decode(json_encode($order), true);

        $response->assertStatus(200)->assertJson(['order' => $order]);

    }
    public function testShowNotFound()
    {
        $response = $this->jsonAuthorized(
            'GET',
            route('orders.show', ['id' => 5])
        );

        $response->assertStatus(400);

    }

    public function testIndexFilterException()
    {
        /**
         * @var Product $product
         */
        $product = $this->mockProducts(['quantity' => 10])[0];
        $transaction = (new Transaction())->createTransaction($this->authCustomer->id, 150);
        $order = Order::create([
            'customer_id' => $this->authCustomer->id,
            'merchant_id' => $product->store->merchant->id,
            'transaction_id' => $transaction->id,
            'product' => $product->toArrayWithOrigins(['main_image']),
            'quantity' => 5,
            'status' => OrderStatusEnum::IN_PROCESS,
        ])->refresh();
        $response = $this->jsonAuthorized(
            'GET',
            route('orders.index'),
            [
                'offset' => 0,
                'filter' => 'wrong filter'
            ]
        );

        $response->assertStatus(422);
    }

    public function mockOrder(array $attr = [])
    {
         /**
          * @var Product $product
          */
        $product = $this->mockProducts(['quantity' => 10])[0];
        $transaction = (new Transaction())->createTransaction($this->authCustomer->id, 150);

        $default = [ 'customer_id' => $this->authCustomer->id,
            'merchant_id' => $product->store->merchant->id,
            'transaction_id' => $transaction->id,
            'product' => $product->toArrayWithOrigins(['main_image']),
            'quantity' => 5,
            'status' => OrderStatusEnum::IN_PROCESS,
        ];
        $attr = array_merge($default, $attr);
        return  Order::create(
            $attr
        )->refresh();

    }
    public function indexDataProvider() : array
    {
        return [
            'positive set in_process' => [
                'order_status' => OrderStatusEnum::IN_PROCESS,
                'fixture' => [
                    'request' => [
                        'offset' => 0,
                        'filter' => OrderFilterEnum::IN_PROCESS,
                    ]
                ],
            ],
            'positive set delivered' => [
                'order_status' => OrderStatusEnum::DELIVERED,
                'fixture' => [
                    'request' => [
                        'offset' => 0,
                        'filter' => OrderFilterEnum::DELIVERED,
                    ]
                ],
            ],
            'positive set picked_up' => [
                'order_status' => OrderStatusEnum::PICKED_UP,
                'fixture' => [
                    'request' => [
                        'offset' => 0,
                        'filter' => OrderFilterEnum::PICKED_UP,
                    ]
                ],
            ],
            'positive set shipped' => [
                'order_status' => OrderStatusEnum::SHIPPED,
                'fixture' => [
                    'request' => [
                        'offset' => 0,
                        'filter' => OrderFilterEnum::SHIPPED,
                    ]
                ],
            ],
            'positive set all' => [
                'order_status' => OrderStatusEnum::IN_PROCESS,
                'fixture' => [
                    'request' => [
                        'offset' => 0,
                        'filter' => OrderFilterEnum::ALL,
                    ]
                ],
            ],
        ];
    }
}