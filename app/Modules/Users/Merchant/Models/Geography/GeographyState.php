<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Models\Geography;

use Illuminate\Database\Eloquent\Model;

class GeographyState extends Model implements GeographyInterface
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(GeographyState::class);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}