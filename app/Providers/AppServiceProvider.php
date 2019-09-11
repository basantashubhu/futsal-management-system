<?php

namespace App\Providers;

use App\Models\Fgp\Program;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        view()->composer('*', function ($view) {
            if(!auth()->id()) return;
            $userLayout = DB::table('layout_builders')->where("user_id", auth()->id())->where('is_deleted', 0)->get()->keyBy('setting_label')->toArray();
            $view->with('userLayout', $userLayout);
        });

        Blade::directive('canAccess', function ($expression) {
            return "<?php if( Auth::user()->checkPermission($expression) ): ?>";
        });

        Blade::directive('endcanAccess', function ($expression) {
            return "<?php endif; ?>";
        });

        view()->composer('*', function ($view) {
            $view->with('programWrapper', Program::class);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        #
    }
}
