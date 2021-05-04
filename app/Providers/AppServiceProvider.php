<?php

namespace App\Providers;

use App\BackOffice\Providers\BackOfficeServiceProvider;
use App\FrontOffice\Providers\FrontOfficeServiceProvider;
use Illuminate\Support\ServiceProvider;
use NtauhLabs\SharedService\LaravelHashPassword;
use NtauhLabs\SharedService\PasswordHash;
use NtauhLabs\User\Domain\Entity\UserRepository;
use NtauhLabs\User\Infrastructure\Repositories\EloquentUserRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->register(FrontOfficeServiceProvider::class);
        $this->app->register(BackOfficeServiceProvider::class);

        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(PasswordHash::class, LaravelHashPassword::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
