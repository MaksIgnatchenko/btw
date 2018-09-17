<?php

namespace App\Modules\Users\Models;

use App\Modules\Categories\Models\Category;
use App\Modules\Notifications\Models\PushCustomer;
use App\Modules\Notifications\Models\PushSettingsInterface;
use App\Modules\Notifications\Models\UserTypePushSettingsInterface;
use App\Modules\Notifications\Repositories\PushCustomerRepository;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends UserTypeAbstract implements UserTypePushSettingsInterface
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /** @var array */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
    ];

    protected $casts = [
        'first_name' => 'string',
        'last_name'  => 'string',
    ];

    /**
     * @return PushSettingsInterface
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function getPushSettings(): PushSettingsInterface
    {
        $settings = $this->pushSettings;
        if (null === $settings) {
            /** @var PushCustomer $settings */
            $settings = app(PushCustomer::class);
            $settings->fill([
                'customer_id'         => $this->id,
                'enabled'             => false,
                'new_posted_deal'     => false,
                'new_price_breaker'   => false,
                'redemption_reminder' => false,
            ]);
            $settings->save();
        }

        return $settings;
    }

    /**
     * @param array $input
     */
    public function updatePushSettings(array $input): void
    {
        /** @var PushCustomerRepository $pushCustomerRepository */
        $pushCustomerRepository = app(PushCustomerRepository::class);
        $pushCustomer = $pushCustomerRepository->find($this->id);
        $pushCustomer->fill($input);
        $categories = [];
        if (isset($input['category_id'])) {
            $categories = $input['category_id'];
        }
        $pushCustomer->categories()->sync($categories);

        $pushCustomerRepository->save($pushCustomer);
    }

    /**
     * @return bool
     */
    public function checkNewDealsPushEnabled(): bool
    {
        $pushSettings = $this->pushSettings;
        if ($pushSettings->enabled && $pushSettings->new_posted_deal) {
            return true;
        }

        return false;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(CustomerAddress::class, 'id', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deliveryAddress(): BelongsTo
    {
        return $this->belongsTo(CustomerDeliveryAddress::class, 'id', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_customer')->withTimestamps();
    }

    /**
     * @return HasOne
     */
    public function pushSettings(): HasOne
    {
        return $this->hasOne(PushCustomer::class)->with('categories');
    }
}
