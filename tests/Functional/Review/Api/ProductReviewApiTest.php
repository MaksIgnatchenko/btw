<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace Tests\Unit\Review\Api;

use Tests\TestCase;

class ProductReviewApiTest extends TestCase
{
    public function testCreateReviewWithEmptyFields()
    {
        $response = $this->post('/api/review/product/', [], ['Accept' => 'application/json']);

        $content = $response->getOriginalContent();

        $this->assertEquals($content['message'], 'Unauthenticated.');
        $this->assertEquals(401, $response->getStatusCode());
    }
}
