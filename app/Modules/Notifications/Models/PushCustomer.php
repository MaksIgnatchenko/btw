<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 13.02.2018
 */

namespace App\Modules\Notifications\Models;

use App\Modules\Categories\Models\Category;
use App\Modules\Users\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PushCustomer extends Model implements PushSettingsInterface
{
    public $incrementing = false;

    protected $primaryKey = 'customer_id';
    protected $table = 'push_customer';

    protected $visible = [
        'enabled',
        'new_posted_deal',
        'new_price_breaker',
        'redemption_reminder',
        'categories',
        'customer',
    ];

    protected $fillable = [
        'customer_id',
        'enabled',
        'new_posted_deal',
        'new_price_breaker',
        'redemption_reminder',
    ];

    protected $casts = [
        'customer_id'         => 'integer',
        'enabled'             => 'boolean',
        'new_posted_deal'     => 'boolean',
        'new_price_breaker'   => 'boolean',
        'redemption_reminder' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this
            ->belongsToMany(Category::class, 'push_customer_categories', 'push_customer_id')
            ->withTimestamps();
    }
}
