<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 24.04.2019
 */

namespace Tests\Functional\Customer;


use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    public function testUpdate()
    {
        $updatedFields = [
          'first_name' => $this->authCustomer->first_name . 'new',
          'last_name' => $this->authCustomer->last_name . 'new',
          'email' => $this->authCustomer->email . 'new',
        ];
        $response = $this->jsonAuthorized(
            'PUT',
            route('api.customer.profile.update'),
            $updatedFields
        );

        $response->assertStatus(200)
            ->assertJson([
               'status' => 'success',
            ]);

        $this->assertDatabaseHas('customers',['id' => $this->authCustomer->id] + $updatedFields);
    }

    public function testUploadAvatar()
    {
        $response = $this->jsonAuthorized(
            'POST',
            route('api.customer.avatar.upload'),
            [
                'avatar' => UploadedFile::fake()->image('avatar.jpg')->size(55),
            ]
        );
        $response->assertStatus(200);
    }

    public function testDeliveryInformationUpdate()
    {
        $newDeliveryData = [
            'country' => 'USA',
            'city' => 'CityNew',
            'apartment' => 'apt2',
            'street' => 'StreetNew',
            'state' => 'StateBew',
            'zip' => '11155',
            'notes' => 'NotesNew',
            'phone' => '88005553536',
        ];
        $response = $this->jsonAuthorized(
            'PUT',
            route('api.customer.delivery.update'),
            $newDeliveryData
        );

        $response->assertStatus(200)
            ->assertJson($newDeliveryData);

        $this->assertDatabaseHas(
            'customer_delivery_information',
            ['customer_id' => $this->authCustomer->id] + $newDeliveryData
        );
    }
}