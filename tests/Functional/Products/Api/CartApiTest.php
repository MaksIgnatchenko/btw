<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace Tests\Unit\Products\Api;

use Tests\TestCase;

class CartApiTest extends TestCase
{
    public function testAddToCartWithEmptyFields()
    {
        $response = $this->post('/api/cart/', [], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertEquals($content['message'], 'Unauthenticated.');
        $this->assertEquals(401, $response->getStatusCode());
    }
}
