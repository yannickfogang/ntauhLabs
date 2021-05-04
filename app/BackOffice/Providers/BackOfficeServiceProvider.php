<?php


namespace App\BackOffice\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BackOfficeServiceProvider extends ServiceProvider
{

    public function register()
    {
        parent::register();

        $this->loadViewsFrom(app_path('BackOffice/resources/views'), 'back');

        $this->mergeConfigFrom(__DIR__ . '../../config/back.php', 'back');

        Route::group([
            'prefix' => config('back.prefix'),
            'middleware' => config('back.middleware')
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '../../routes/web.php');
        });
    }

    public function boot(): void {

    }

}
