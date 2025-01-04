<?php

namespace App\Providers;

use App\Models\PeriodePendidikan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $dataperiode = PeriodePendidikan::query()
                ->get();
            $view->with('dataperiode', $dataperiode);
        });
    }
}
