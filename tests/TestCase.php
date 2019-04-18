<?php

namespace Tests;

use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
//    use DatabaseTransactions;


    protected function requestAuthorized(string $method, string $url, array $attr = [], $files = [], array $headers = [], string $token = null)
    {
        if (null === $token) {
            $token = auth()
                ->guard('customer')
                ->login(
                    factory(Customer::class)->create()
                );
        }
        $headers = array_merge(['Authorization' => "Bearer $token"], $headers);
        $server = $this->transformHeadersToServerVars($headers);

        return $this->call($method, $url, $attr, [], $files, $server);
    }

    protected function jsonAuthorized(string $method, string $url, array $data = [], array $headers = [], string $token = null)
    {
        $files = $this->extractFilesFromDataArray($data);

        $content = json_encode($data);

        $headers = array_merge([
            'CONTENT_LENGTH' => mb_strlen($content, '8bit'),
            'CONTENT_TYPE' => 'application/json',
            'Accept' => 'application/json',
        ], $headers);

        return $this->requestAuthorized($method, $url, $data, $files, $headers, $token);
    }
}
