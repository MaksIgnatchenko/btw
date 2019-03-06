<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Models;

use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    public const PRODUCT_MIN_QUANTITY = 1;
    public const PRODUCT_DEFAULT_QUANTITY = 1;

    protected $fillable = [
        'customer_id',
        'product_id',
        'quantity',
    ];

    protected $casts = [
        'customer_id' => 'integer',
        'product_id'  => 'integer',
        'quantity'    => 'integer',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->withoutGlobalScope('status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
