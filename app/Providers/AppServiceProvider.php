<?php

namespace App\Providers;

use App\Http\Override\HeadingRowFormatterNew;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        HeadingRowFormatterNew::extend('slug', function($value) {
            return $value;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Specified key was too long error, Laravel News post:
        Schema::defaultStringLength(191);
    }
}
