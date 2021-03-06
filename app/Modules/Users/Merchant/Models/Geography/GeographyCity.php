<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Models\Geography;

use Illuminate\Database\Eloquent\Model;

class GeographyCity extends Model implements GeographyInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}