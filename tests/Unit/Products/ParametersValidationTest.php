<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 06.12.2017
 */

namespace Tests\Unit\Products;

use App\Modules\Products\Dto\Parameters\ParametersFactory;
use Tests\TestCase;

class ParametersValidationTest extends TestCase
{
    public function testValidationOtherRestrictions()
    {
        $otherRestrictionsDto = ParametersFactory::get('other_restrictions', '5 days return');
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);

        $values = \GuzzleHttp\json_decode('{"wrong_field":"5 days return"}');
        $otherRestrictionsDto = ParametersFactory::get('other_restrictions', $values);
        $result = $otherRestrictionsDto->validate();
        $this->assertFalse($result);
    }

    public function testValidDateValid()
    {
        $values = \GuzzleHttp\json_decode('{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "09.00 AM", "valid_time_to": "08.00 PM"}');
        $otherRestrictionsDto = ParametersFactory::get('valid_date', $values);
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);
    }

    /**
     * @expectedException App\Modules\Products\Exceptions\WrongParametersFormatException
     */
    public function testValidDateNotValid()
    {
        $values = \GuzzleHttp\json_decode('{"wrong_field":"5 days return"}');
        $otherRestrictionsDto = ParametersFactory::get('valid_date', $values);
        $otherRestrictionsDto->validate();
    }

    /**
     * @expectedException App\Modules\Products\Exceptions\WrongParametersFormatException
     */
    public function testValidDateWrongValidDayFrom()
    {
        $values = \GuzzleHttp\json_decode('{"valid_day_from": "wrong", "valid_day_to":"Fri", "valid_time_from": "09.00 AM", "valid_time_to": "08.00 PM"}');
        $otherRestrictionsDto = ParametersFactory::get('valid_date', $values);
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);
    }

    /**
     * @expectedException App\Modules\Products\Exceptions\WrongParametersFormatException
     */
    public function testValidDateWrongValidTimeFrom()
    {
        $values = \GuzzleHttp\json_decode('{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "100.00 AM", "valid_time_to": "08.00 PM"}');
        $otherRestrictionsDto = ParametersFactory::get('valid_date', $values);
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);
    }

    /**
     * @expectedException App\Modules\Products\Exceptions\WrongParametersFormatException
     */
    public function testValidDateWrongValidTimeTo()
    {
        $values = \GuzzleHttp\json_decode('{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "12.00 AM", "valid_time_to": "08.00 dfghdf"}');
        $otherRestrictionsDto = ParametersFactory::get('valid_date', $values);
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);
    }

    /**
     * @expectedException App\Modules\Products\Exceptions\WrongParametersFormatException
     */
    public function testValidDateWrongValidDayTo()
    {
        $values = \GuzzleHttp\json_decode('{"valid_day_from": "wrong", "valid_day_to":"Wro", "valid_time_from": "09.00 AM", "valid_time_to": "08.00 PM"}');
        $otherRestrictionsDto = ParametersFactory::get('valid_date', $values);
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);
    }


    /**
     * @expectedException App\Modules\Products\Exceptions\WrongParametersFormatException
     */
    public function testValidationCertificate()
    {
        ParametersFactory::get('certificate', 'true');
    }

    public function testValidationQuantity()
    {
        $otherRestrictionsDto = ParametersFactory::get('quantity', '123');
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);

        $otherRestrictionsDto = ParametersFactory::get('quantity', 'wrong');
        $result = $otherRestrictionsDto->validate();
        $this->assertFalse($result);

        $otherRestrictionsDto = ParametersFactory::get('quantity', 123);
        $result = $otherRestrictionsDto->validate();
        $this->assertFalse($result);
    }

    public function testValidationOfferNotValidOnHolidays()
    {
        $otherRestrictionsDto = ParametersFactory::get('not_valid_on_holidays', 'true');
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);

        $otherRestrictionsDto = ParametersFactory::get('not_valid_on_holidays', 'false');
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);

        $otherRestrictionsDto = ParametersFactory::get('not_valid_on_holidays', 'wrong');
        $result = $otherRestrictionsDto->validate();
        $this->assertFalse($result);
    }

    public function testValidationOfferDate()
    {
        $otherRestrictionsDto = ParametersFactory::get('valid_date', \GuzzleHttp\json_decode('{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "09.00 AM", "valid_time_to": "08.00 PM"}'));
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);

        $otherRestrictionsDto = ParametersFactory::get('valid_date', \GuzzleHttp\json_decode('{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "00.00 AM", "valid_time_to": "08.00 PM"}'));
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);

        $otherRestrictionsDto = ParametersFactory::get('valid_date', \GuzzleHttp\json_decode('{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "11.59 AM", "valid_time_to": "08.00 PM"}'));
        $result = $otherRestrictionsDto->validate();
        $this->assertTrue($result);
    }

    /**
     * @expectedException App\Modules\Products\Exceptions\WrongParametersFormatException
     */
    public function testValidationOfferDateWrongDay()
    {
        $otherRestrictionsDto = ParametersFactory::get('valid_date', \GuzzleHttp\json_decode('{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "29.00 AM", "valid_time_to": "08.00 PM"}'));
        $result = $otherRestrictionsDto->validate();
    }

    /**
     * @expectedException App\Modules\Products\Exceptions\WrongParametersFormatException
     */
    public function testValidationOfferDateWrongDay2()
    {
        $otherRestrictionsDto = ParametersFactory::get('valid_date', \GuzzleHttp\json_decode('{"valid_day_from": "Mon", "valid_day_to":"Fri", "valid_time_from": "00.99 AM", "valid_time_to": "08.00 PM"}'));
        $result = $otherRestrictionsDto->validate();
    }

}
