<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.11.2017
 */

namespace App\Modules\Users\Merchant\Models;

use App\Modules\Users\Merchant\Models\Geography\GeographyCity;
use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Models\Geography\GeographyState;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Merchant extends Authenticatable
{
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
    ];

    protected $hidden = [
        'password',
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
     * @param array $data
     *
     * @return Merchant
     */
    public static function createWithRelations(array $data): Merchant
    {
        $data['country'] = GeographyCountry::find($data['country'])->sortname;
        $data['state'] = GeographyState::find($data['state'])->name;
        $data['city'] = GeographyCity::find($data['city'])->name;

        /** @var Merchant $merchant */
        $merchant = self::create($data);

        $merchant->address()->create($data);

        $storeData = array_merge($data, [
            'country' => GeographyCountry::find($data['store_country'])->sortname,
            'city' => $data['store_city'],
        ]);

        $merchant->store()->create($storeData);

        return $merchant;
    }
}
