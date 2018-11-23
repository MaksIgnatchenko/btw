<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.11.2017
 */

namespace App\Modules\Users\Merchant\Models;

use App\Modules\Products\Models\Product;
use App\Modules\Users\Merchant\Helpers\GeographyHelper;
use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Repositories\MerchantRepository;
use App\Modules\Users\Merchant\Repositories\StoreRepository;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laratrust\Traits\LaratrustUserTrait;

class Merchant extends Authenticatable
{
    use Notifiable, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'avatar',
        'background_img',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Password attribute mutator.
     *
     * @param string $password
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Merchant full name mutator.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Return phone without country code
     *
     * @return string
     */
    public function getShortPhoneAttribute(): string
    {
        $geographyService = app(GeographyServiceInterface::class);
        $country = $geographyService->getCountryByShortName($this->address->country);

        return str_replace($country->phoneCode, '', $this->phone);
    }

    /**
     * @param $value
     *
     * @return null
     */
    public function getAvatarAttribute($value)
    {
        if ($value) {
            return Storage::url(join('/', [config('wish.storage.merchants.avatar_path'), $value]));
        }

        return null;
    }

    /**
     * @param $value
     *
     * @return null
     */
    public function getBackgroundImgAttribute($value)
    {
        if ($value) {
            return Storage::url(join('/', [config('wish.storage.merchants.background_path'), $value]));
        }

        return null;
    }

    /**
     * Merchant to address relation.
     *
     * @return HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * Merchant to company relation.
     *
     * @return HasOne
     */
    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    /**
     * @return HasManyThrough
     */
    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, Store::class);
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function updateAccountInfo(array $data): self
    {
        GeographyHelper::resolveGeographyNames($data);

        $this->address->update($data);

        $merchantRepository = app(MerchantRepository::class);
        $merchantRepository->update($data, $this->id);

        return $this;
    }

    /**
     * @param array $data
     *
     * @return Merchant
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function createWithRelations(array $data): Merchant
    {
        GeographyHelper::resolveGeographyNames($data);

        /** @var MerchantRepository $merchantRepository */
        $merchantRepository = app(MerchantRepository::class);

        /** @var Merchant $merchant */
        $merchant = $merchantRepository->create(array_merge($data, [
            'phone' => $data['phone_code'] . $data['phone_number'],
        ]));

        $merchant->address()->create($data);

        $storeData = array_merge($data, [
            'country' => GeographyCountry::find($data['store_country'])->sortname,
            'city' => $data['store_city'],
            'name' => $data['store'],
        ]);

        /** @var StoreRepository $storeRepository */
        $storeRepository = app(StoreRepository::class);

        /** @var Store $store */
        $store = $storeRepository->create($storeData);
        $store->merchant()->associate($store);
        $store->categories()->attach($data['categories']);

        return $merchant;
    }
}
