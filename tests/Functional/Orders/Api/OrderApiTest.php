<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace Tests\Unit\Products\Api;

use Tests\TestCase;

class OrderApiTest extends TestCase
{
    public function testGetOrdersWithEmptyFields()
    {
        $response = $this->post('/api/order/', [], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertEquals($content['message'], 'Unauthenticated.');
        $this->assertEquals(401, $response->getStatusCode());
    }
}
