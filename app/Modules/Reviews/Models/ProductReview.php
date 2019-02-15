<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Models;

use App\Modules\Orders\Models\Order;
use App\Modules\Products\Models\Product;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Reviews\Traits\CommonReviewsScopesTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string status
 */
class ProductReview extends Model
{
    use CommonReviewsScopesTrait;

    protected $fillable = [
        'rating',
        'comment',
        'status',
        'customer_id',
        'order_id',
        'product_id'
    ];

    protected $dates = [
        'created_at'
    ];



    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function isActive() : bool
    {
        return $this->status === ReviewStatusEnum::ACTIVE;
    }

    /**
     * @return BelongsTo
     */
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeOfProduct($query, $product)
    {
        return $query->where('product_id', $product->id);
    }
}
