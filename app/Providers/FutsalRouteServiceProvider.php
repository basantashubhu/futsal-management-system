<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route as IlluminateRoute;
use Illuminate\Support\ServiceProvider;

class FutsalRouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        IlluminateRoute::middleware('web')
            ->namespace($this->namespace . '\Court')
            ->group(base_path('routes/courts/route_courts.php'));

        IlluminateRoute::middleware('web')
            ->namespace($this->namespace . '\Organization')
            ->group(base_path('routes/organization/route_organization.php'));

        IlluminateRoute::middleware('web')
            ->namespace($this->namespace . '\Schedule')
            ->group(base_path('routes/schedule.php'));

        IlluminateRoute::middleware('web')
            ->namespace($this->namespace . '\Booking')
            ->group(base_path('routes/booking/route_bookings.php'));
    }
}
