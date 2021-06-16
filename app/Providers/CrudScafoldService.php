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
        $this->publishes();
    }
}
