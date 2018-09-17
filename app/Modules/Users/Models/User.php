<?php
/**
 * Created by Artem Petrov, Appus Studio on 10/31/17.
 */

namespace App\Modules\Users\Models;

use App\Modules\Rbac\Enum\RolesEnum;
use App\Modules\Users\Notifications\MailResetPasswordToken;
use App\Modules\Users\Repositories\CustomerRepository;
use App\Modules\Users\Repositories\MerchantRepository;
use App\Modules\Users\Repositories\UserTypeRepositoryAbstract;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Laratrust\Traits\LaratrustUserTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use LaratrustUserTrait;
    use SoftDeletes;

    public const MERCHANT = 'merchant';
    public const CUSTOMER = 'customer';

    public const PASSWORD_REGEXP = '/^(?=.*[\D])(?=.*\d)[\D\d!$%@#£€*?&_!%\-]{8,50}$/';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
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
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    /**
     * @param string $password
     */
    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return HasOne
     */
    public function merchant(): HasOne
    {
        return $this->hasOne(Merchant::class)->select([
            'id',
            'user_id',
            'business_name',
            'telephone',
            'ein',
            'contact',
            'payment_option',
            'check',
            'status',
            'address',
            'longitude',
            'latitude',
        ]);
    }

    /**
     * @return HasOne
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class)->select([
            'id',
            'user_id',
            'first_name',
            'last_name',
            'status',
        ]);
    }

    /**
     * @return HasOne
     */
    public function userSetting(): HasOne
    {
        return $this->hasOne(UserSettings::class);
    }

    /**
     * @return HasOne
     */
    public function device(): HasOne
    {
        return $this->hasOne(Device::class);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        if ($this->merchant) {
            return $this->merchant->status;
        }

        return $this->customer->status;
    }

    /**
     * @return Collection
     */
    public function getRoles(): Collection
    {
        return $this->roles->mapWithKeys(function ($role) {
            return ['name' => $role['name']];
        });
    }

    /**
     * @return UserTypeAbstract
     */
    public function getCurrentUserTypeModel(): UserTypeAbstract
    {
        $roles = $this->getRoles();

        if (RolesEnum::MERCHANT === $roles['name']) {
            return $this->merchant;
        }

        return $this->customer;
    }

    /**
     * @return UserTypeRepositoryAbstract
     */
    public function getUserTypeRepository(): UserTypeRepositoryAbstract
    {
        $roles = $this->getRoles();

        if (RolesEnum::MERCHANT === $roles['name']) {
            return app()[MerchantRepository::class];
        }

        return app()[CustomerRepository::class];
    }

    /**
     * @return int
     */
    public function getUserTypeId(): int
    {
        $roles = $this->getRoles();

        if (RolesEnum::MERCHANT === $roles['name']) {
            return $this->merchant->id;
        }

        return $this->customer->id;
    }
}
