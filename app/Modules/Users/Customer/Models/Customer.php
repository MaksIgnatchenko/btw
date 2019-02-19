<?php
/**
 * Created by Artem Petrov, Appus Studio on 20.09.18
 */

namespace App\Modules\Users\Customer\Models;

use App\Modules\Products\Models\Product;
use App\Modules\Users\Customer\Mails\ResetPasswordMail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * @property int id
 */
class Customer extends Authenticatable implements JWTSubject
{
    use Notifiable, LaratrustUserTrait;

    /**
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
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
        if ($value) {
            return Storage::url(join('/', [config('wish.storage.customers.avatar_path'), $value]));
        }

        return null;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return ucwords($this->attributes['first_name'] . ' ' . $this->attributes['last_name']);
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

    /**
     * Merchant to delivery information relation.
     *
     * @return HasOne
     */
    public function deliveryInformation(): HasOne
    {
        return $this->hasOne(CustomerDeliveryInformation::class);
    }

    /**
     * Sends the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordMail($token, $this));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function recentlyViewed() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'recently_viewed_products')
            ->as('recentlyViewedPivot')
            ->withTimestamps();
    }
}
