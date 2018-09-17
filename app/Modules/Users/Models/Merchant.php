<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.11.2017
 */

namespace App\Modules\Users\Models;

use App\Modules\Categories\Models\Category;
use App\Modules\Notifications\Models\PushMerchant;
use App\Modules\Notifications\Models\PushSettingsInterface;
use App\Modules\Notifications\Models\UserTypePushSettingsInterface;
use App\Modules\Notifications\Repositories\PushMerchantRepository;
use App\Modules\Payments\Models\AbstractPaymentOptions;
use App\Modules\Payments\Models\PayPalOption;
use App\Modules\Payments\Models\WireTransferOption;
use App\Modules\Review\Models\MerchantReview;
use App\Modules\Review\Repositories\MerchantReviewRepository;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Users\Enums\MerchantStatusEnum;
use App\Modules\Users\Enums\PaymentOptionsEnum;
use App\Modules\Users\Repositories\MerchantRepository;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Merchant extends UserTypeAbstract implements UserTypePushSettingsInterface
{
    /** @var array */
    protected $fillable = [
        'user_id',
        'business_name',
        'address',
        'telephone',
        'ein',
        'contact',
        'check',
        'payment_option',
        'longitude',
        'latitude',
    ];

    protected $casts = [
        'check'     => 'boolean',
        'address'   => 'string',
        'longitude' => 'float',
        'latitude'  => 'float',
    ];

    /**
     * @param $value
     *
     * @return string
     */
    // TODO remake it? no text in model!!
    public function getCheckAttribute($value): string
    {
        return $value ? 'Yes' : 'No';
    }

    /**
     * @return PushSettingsInterface
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function getPushSettings(): PushSettingsInterface
    {
        $settings = $this->pushSettings;
        if (null === $settings) {
            /** @var PushMerchant $settings */
            $settings = app(PushMerchant::class);
            $settings->fill([
                'merchant_id'     => $this->id,
                'enabled'         => false,
                'review'          => false,
                'wish_list'       => false,
                'new_transaction' => false,
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
        /** @var PushMerchantRepository $pushMerchantRepository */
        $pushMerchantRepository = app(PushMerchantRepository::class);
        $pushMerchant = $pushMerchantRepository->find($this->id);
        $pushMerchant->fill($input);
        $pushMerchantRepository->save($pushMerchant);
    }

    /**
     * @return bool
     */
    public function checkReviewPushEnabled(): bool
    {
        $pushSettings = $this->pushSettings;
        if ($pushSettings->enabled && $pushSettings->review) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function checkTransactionPushEnabled(): bool
    {
        $pushSettings = $this->pushSettings;
        if ($pushSettings->enabled && $pushSettings->new_transaction) {
            return true;
        }

        return false;
    }

    /**
     * Set status depends on checked on not merchant
     */
    public function setStatus()
    {
        if ('Yes' === $this->check) {
            $this->status = MerchantStatusEnum::ACTIVE;
        } else {
            $this->status = MerchantStatusEnum::PENDING;
        }
    }

    /**
     * @return AbstractPaymentOptions
     */
    public function getPaymentData(): ?AbstractPaymentOptions
    {
        if (PaymentOptionsEnum::WIRE === $this->payment_option) {
            return $this->wire;
        }
        if (PaymentOptionsEnum::PAYPAL === $this->payment_option) {
            return $this->paypal;
        }

        return null;
    }

    /**
     * @param int $merchantId
     *
     * @return Merchant|null
     */
    public function getMerchantWithRatingById(int $merchantId): ?Merchant
    {
        /** @var MerchantReviewRepository $merchantReviewRepository */
        $merchantReviewRepository = app()[MerchantReviewRepository::class];
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app()[MerchantRepository::class];

        $merchant = $merchantRepository->findById($merchantId);

        if (null !== $merchant) {
            $rating = $merchantReviewRepository->getAvgRatingByMerchantId($merchantId) ?? 0.0;
            $merchant->rating = $rating;
        }

        return $merchant;
    }

    /**
     * @return Collection
     */
    public function getMarkers(): Collection
    {
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app(MerchantRepository::class);
        $merchants = $merchantRepository->all();

        $markers = collect();
        foreach ($merchants as $merchant) {
            $markers[] = [
                'latLng' => [
                    $merchant->latitude,
                    $merchant->longitude,
                ],
                'name'   => $merchant->business_name,
            ];
        }

        return $markers;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app(MerchantRepository::class);

        return $merchantRepository->all()->count();
    }

    /**
     * @return mixed
     */
    public function getPendingCount()
    {
        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app(MerchantRepository::class);

        return $merchantRepository->findWhere(['status' => MerchantStatusEnum::PENDING])->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_merchant')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paypal(): BelongsTo
    {
        return $this->belongsTo(PayPalOption::class, 'id', 'merchant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wire(): BelongsTo
    {
        return $this->belongsTo(WireTransferOption::class, 'id', 'merchant_id');
    }

    /**
     * @return HasOne
     */
    public function pushSettings(): HasOne
    {
        return $this->hasOne(PushMerchant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function merchantsReviews(): HasMany
    {
        return $this->hasMany(MerchantReview::class)
            ->where(['status' => ReviewStatusEnum::ACTIVE])
            ->with([
                'customer' => function ($query) {
                    $query->select(['id', 'first_name', 'last_name']);
                }
            ]);
    }

    public function rating()
    {
        return $this->hasMany(MerchantReview::class)
            ->where(['status' => ReviewStatusEnum::ACTIVE])
            ->selectRaw('merchant_id, AVG(rate) AS avg')
            ->groupBy('merchant_id');
    }
}
