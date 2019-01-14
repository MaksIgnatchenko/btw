<?php
/**
 * Created by PhpStorm.
 * User: artem.petrov
 * Date: 2019-01-14
 * Time: 15:06
 */

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface AddressInterface
{
    /**
     * @return HasOne
     */
    public function address(): HasOne;
}