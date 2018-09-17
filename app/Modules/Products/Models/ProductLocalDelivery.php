<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLocalDelivery extends Model
{
    protected $table = 'product_local_delivery';

    /** @var array */
    public $fillable = [
        'product_id',
        'active',
        'distance',
    ];

    public $casts = [
        'product_id' => 'integer',
        'active'     => 'boolean',
        'distance'   => 'string',
    ];

    public $hidden = [
        'id',
        'product_id',
        'created_at',
        'updated_at',
    ];
}
