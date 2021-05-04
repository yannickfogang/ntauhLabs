<?php


namespace App\FrontOffice\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FrontOfficeServiceProvider extends ServiceProvider
{



    public function register()
    {
        parent::register();

        $this->loadViewsFrom(app_path('FrontOffice/resources/views'), 'front');

        $this->mergeConfigFrom(__DIR__ . '../../config/front.php', 'front');

        Route::group([
            'prefix' => config('front.prefix'),
            'middleware' => config('front.middleware')
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '../../routes/web.php');
        });
    }

    public function boot(): void {

    }

}
