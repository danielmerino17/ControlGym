<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Prestamo;
use App\Observers\PrestamoObserver;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Prestamo::observe(PrestamoObserver::class);
    }
}