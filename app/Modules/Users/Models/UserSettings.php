<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.11.2017
 */

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'settings',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    /** @var array */
    protected $attributes = [
        'settings' => '{}',
    ];

    /** @var array */
    protected $casts = [
        'settings' => 'array',
        'user_id'  => 'integer',
    ];

    /**
     * @param string $setting
     * @param bool $value
     */
    // TODO не только boolean??
    public function setSetting(string $setting, bool $value): void
    {
        $settings = $this->settings;
        $this->settings = array_merge($settings, [$setting => $value]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
