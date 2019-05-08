<?php

namespace Tests;

use App\Modules\Categories\Models\Category;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\Models\Customer;
use App\Modules\Users\Merchant\Models\Merchant;
use App\Modules\Users\Merchant\Models\Store;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Class TestCase
 * @package Tests
 */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
   // use DatabaseTransactions;

    /**
     * @var Customer
     */
    protected $authCustomer;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        Storage::fake('public');
        $this->authCustomer = factory(Customer::class)->create();
        $this->authCustomer->deliveryInformation()->create([
            'country' => 'en',
            'city' => 'City',
            'apartment' => 'apt',
            'street' => 'Street',
            'state' => 'State',
            'zip' => 'zip',
            'notes' => 'Notes',
            'phone' => '88005553535',
        ]);

        $this->fakeBraintree();
    }

    /**
     * @return string|null
     */
    protected function apiAuthToken() : ?string
    {
        if (null === $this->authCustomer) {
            return null;
        }

        return auth()->guard('customer')->login($this->authCustomer);
    }


    /**
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $files
     * @param array $headers
     * @param string|null $content
     * @param string|null $token
     * @return TestResponse
     */
    protected function requestAuthorized(string $method, string $url, array $data = [], $files = [], array $headers = [], string $content = null, string $token = null) : TestResponse
    {
        $server = $this->transformHeadersToServerVars(
            $this->addAuthHeader($headers, $token)
        );

        return $this->call($method, $url, $data, [], $files, $server, $content);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $headers
     * @param string|null $token
     * @return TestResponse
     */
    protected function jsonAuthorized(string $method, string $url, array $data = [], array $headers = [], string $token = null) : TestResponse
    {
        $files = $this->extractFilesFromDataArray($data);
        $content = json_encode($data);
        $headers = $this->addJsonHeaders($headers);
        return $this->requestAuthorized(
            $method, $url, [], $files, $headers, $content, $token
        );
    }


    /**
     * @param array $attr
     * @param int $count
     * @return Collection
     */
    protected function mockProducts(array $attr = [], int $count = 1) : Collection
    {

        $merchant = factory(Merchant::class)->create();
        $store = factory(Store::class)->create([
            'merchant_id' => $merchant->id,
        ]);
        if (array_key_exists('category_id', $attr)) {
            $category = factory(Category::class)->create(['id' => $attr['category_id']]);
        } else {
            $category = factory(Category::class)->create();
        }

        $attr = array_merge($attr, [
            'store_id' => $store->id,
            'category_id' => $category->id,
        ]);
        return factory(Product::class, $count)->create($attr);
    }

    /**
     * @param array $headers
     * @return array
     */
    protected function addJsonHeaders(array $headers) : array
    {
        return array_merge([
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ], $headers);
    }

    /**
     * @param array $headers
     * @param string|null $token
     * @return array
     */
    protected function addAuthHeader(array $headers, string $token = null) : array
    {
        if (null === $token) {
            $token = $this->apiAuthToken();
        }

        return array_merge(['Authorization' => "Bearer " . $token], $headers);
    }

    //bind fake transaction provider instead of braintree
    public function fakeBraintree()
    {
        $this->app->bind(\Braintree_Gateway::class, function($app) {
            return new class {
                public function clientToken()
                {
                    return new class {
                        public function generate()
                        {
                            return 'test token';
                        }
                    };
                }

                public function transaction()
                {
                    return new class {
                        public function sale($data)
                        {
                            $result = new \StdClass;
                            $result->transaction = new \StdClass;
                            $result->transaction->id = random_int(1, 999);
                            $result->message = 'Test message';
                            $result->success = $data['paymentMethodNonce'] === 'success';
                            return $result;
                        }
                    };
                }
            };
        });
    }
}
