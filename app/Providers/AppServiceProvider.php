<?php

namespace App\Providers;

use App\Models\MenuItem;
use App\Models\Setting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        URL::forceScheme('https');
        View::composer('*', function ($view) {

            if (request()->is('admin/*')) {
                return;
            }

            $menus = MenuItem::whereNull('parent_id')
                ->with(['children', 'page'])
                ->orderBy('order')
                ->get();
            // Ambil settings (tanpa cache)
            $settings = Setting::pluck('value', 'key')->toArray();

            // Kirim ke semua blade
            $view->with([
                'menus' => $menus,
                'settings' => $settings,
            ]);
        });
    }
}
