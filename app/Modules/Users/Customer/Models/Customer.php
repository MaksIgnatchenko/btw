<?php
/**
 * Created by Artem Petrov, Appus Studio on 20.09.18
 */

namespace App\Modules\Users\Customer\Models;

use App\Modules\Products\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class Customer extends Authenticatable implements JWTSubject
{
    use Notifiable, LaratrustUserTrait;

    protected $hidden = [
        'password',
    ];

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'address',
        'avatar',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @param string $password
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @param $value
     *
     * @return null|string
     */
    public function getAvatarAttribute($value): ?string
    {
        if($value) {
            return Storage::url($value);
        }

        return null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlist()
    {
        return $this->belongsToMany(Product::class, 'wishlists')
            ->as('wishPivot')
            ->withTimestamps();
    }
}
