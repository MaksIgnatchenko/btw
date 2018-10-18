<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.11.2017
 */

namespace App\Modules\Users\Merchant\Models;

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
}
