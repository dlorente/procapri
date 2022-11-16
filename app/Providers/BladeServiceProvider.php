<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // pass
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('setActiveAba', function ($aba) {
            return "<?php echo session('active_aba') == $aba ? 'show' : ''; ?>";
        });
        Blade::directive('setActiveMenu', function ($route_name) {
            return "<?php echo Route::currentRouteName() == $route_name ? 'active' : ''; ?>";
        });
        Blade::if('admin', fn () => is_super_admin());

        Blade::directive('activeTab', fn ($name) => "<?php echo active_tab($name); ?>");
        Blade::directive('date', fn ($date) => "<?php echo $date->format('Y-m-d H:i'); ?>");
    }
}
