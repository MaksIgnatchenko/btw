<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 13.02.2019
 */

namespace App\Modules\Reviews\Models;

use App\Modules\Reviews\Traits\CommonReviewTrait;
use App\Modules\Users\Merchant\Models\Merchant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string status
 * @property integer rating
 * @property string comment
 * @property integer id
 * @property Merchant merchant
 * @property Carbon created_at
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
        'customer',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'customer_name',
    ];

    /**
     * @return BelongsTo
     */
    public function merchant() : BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}
