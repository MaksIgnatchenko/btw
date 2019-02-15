<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Models;

use App\Modules\Reviews\Traits\CommonReviewTrait;
use App\Modules\Users\Merchant\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string status
 * @method static inactive()
 * @method static active() MerchantReview
 */
class MerchantReview extends Model
{
    use CommonReviewTrait;

    public const PER_PAGE = 10;

    /**
     * @var array
     */
    protected $fillable = [
        'rating',
        'comment',
        'order_id',
        'customer_id',
        'merchant_id',
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
    public function merchant() : BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
