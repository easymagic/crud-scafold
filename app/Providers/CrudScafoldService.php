<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CrudScafoldService extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * App\Providers\CrudScafoldService
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        //
        $this->publishes([
                __DIR__ . '/../../app/Services/'=>base_path('app/Services/'),
                __DIR__ . '/../../app/Console/Commands/'=>base_path('app/Console/Commands/'),
                __DIR__ . '/../../config/filesystems.php'=>base_path('config/filesystems.php')
        ]);


    }
}
