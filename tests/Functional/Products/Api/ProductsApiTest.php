<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 01.12.2017
 */

namespace Tests\Unit\Products\Api;

use Tests\TestCase;

class ProductsApiTest extends TestCase
{
    // TODO разобраться с функциональными тестами
    public function testSetProductWithEmptyFields()
    {
        $response = $this->post('/api/products/set', [], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertEquals($content['message'], '');
        $this->assertEquals(401, $response->getStatusCode());
    }

    public function testGetProductWithEmptyFields()
    {
        $response = $this->get('/api/products/get', [], ['Accept' => 'application/json']);
        
        $this->assertEquals(401, $response->getStatusCode());
    }
}
