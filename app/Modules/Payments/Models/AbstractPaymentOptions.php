<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.11.2017
 */

namespace App\Modules\Payments\Models;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractPaymentOptions extends Model
{
    /**
     * @param array $data
     */
    abstract public function fillModel(array $data);
}
