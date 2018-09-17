<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 05.01.2018
 */

namespace App\Modules\Products\Models;

use App\Modules\Products\Enums\CartSourceEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    public const PRODUCT_MIN_QUANTITY = 1;
    public const PRODUCT_DEFAULT_QUANTITY = 1;

    protected $table = 'cart';

    protected $fillable = [
        'customer_id',
        'product_id',
        'product',
        'quantity',
        'source',
        'delivery_option',
    ];

    protected $casts = [
        'customer_id' => 'integer',
        'product_id'  => 'integer',
        'product'     => 'array',
        'quantity'    => 'integer',
        'source'      => 'string',

        'delivery_option' => 'string',
    ];

    /**
     * @return mixed
     */
    public function scopeOnlyProductSource()
    {
        return $this->where('source', CartSourceEnum::PRODUCT);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productRelation(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
