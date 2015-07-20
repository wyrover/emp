<?php

namespace App\Providers;

use App\Employee;
use App\Estar\Eloquent\RepoEmployee;
use App\Estar\Eloquent\RepoPosition;
use App\Position;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
