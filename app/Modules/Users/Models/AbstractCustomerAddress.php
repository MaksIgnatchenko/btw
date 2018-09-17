<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.12.2017
 */

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

abstract class AbstractCustomerAddress extends Model
{
    protected $primaryKey = 'customer_id';

    /** @var array */
    protected $fillable = [
        'customer_id',
        'address',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'customer_id' => 'integer',
        'address'     => 'string',
        'latitude'    => 'float',
        'longitude'   => 'float',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
