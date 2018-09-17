<?php
/**
 * Created by Artem Petrov, Appus Studio on 10/31/17.
 */

namespace App\Modules\Users\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Сопоставления политик для приложения.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Регистрация всех сервисов аутентификации / авторизации.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

//        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang/en/', 'validation');
    }
}