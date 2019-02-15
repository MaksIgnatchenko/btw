<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Models;

use App\Modules\Products\Models\Product;
use App\Modules\Reviews\Traits\CommonReviewTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * @property string status
 */
class ProductReview extends Model
{
    use CommonReviewTrait;

    /**
     * @var array
     */
    protected $fillable = [
        'rating',
        'comment',
        'status',
        'customer_id',
        'order_id',
        'product_id',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'status',
    ];


    /**
     * @return BelongsTo
     */
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
