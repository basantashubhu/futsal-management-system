<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
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
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));

        Route::middleware('web')
            ->namespace('App\Http\Controllers\User')
            ->group(base_path('routes/route_user.php'));

        /**
         * Note
         */
        Route::middleware('web')
            ->namespace($this->namespace . '\Note')
            ->group(base_path('routes/route_note.php'));

        //Route For Lookup
        Route::middleware('web')
            ->namespace($this->namespace . '\Settings')
            ->group(base_path('routes/route_lookup.php'));

        //Route For Zip Code
        Route::middleware('web')
            ->namespace($this->namespace . '\Settings')
            ->group(base_path('routes/route_zip_code.php'));

        //Route For Validation
        Route::middleware('web')
            ->namespace($this->namespace . '\Settings')
            ->group(base_path('routes/route_validation.php'));

        //Route For Role Management
        Route::middleware('web', 'canAccess:role management,view')
            ->namespace($this->namespace . '\RoleManagement')
            ->group(base_path('routes/route_roleManagement.php'));

        //Route For Email Log
        Route::middleware('web')
            ->namespace($this->namespace . '\Email_Log')
            ->group(base_path('routes/route_email_log.php'));
        Route::middleware('web')
            ->namespace($this->namespace . '\Notification')
            ->group(base_path('routes/route_notification.php'));

        Route::middleware('web')
            ->namespace($this->namespace . '\Settings')
            ->group(base_path('routes/route_usersettings.php'));

        //Route For Email Template
        Route::middleware('web', 'canAccess:template,view')
            ->namespace($this->namespace . '\Template')
            ->group(base_path('routes/route_email_template.php'));

        Route::middleware('web')
            ->namespace($this->namespace . '\Layout')
            ->group(base_path('routes/route_layout.php'));

        //Route for Print
        Route::middleware('web')
            ->namespace($this->namespace . '\Prints')
            ->group(base_path('routes/route_print.php'));

        //Route For Site Settings
        Route::middleware('web')
            ->namespace($this->namespace . '\SiteSettings')
            ->group(base_path('routes/route_site_settings.php'));

        //Route for Report
        Route::middleware('web')
            ->namespace($this->namespace . '\Report')
            ->group(base_path('routes/route_report.php'));

        Route::middleware('web')
            ->namespace($this->namespace . '\Report')
            ->group(base_path('routes/route_mailLetter.php'));

        //Route for database backup_and_restore
        Route::middleware('web')
            ->namespace($this->namespace . '\Session')
            ->group(base_path('routes/route_userlog.php'));

        //Route for queue
        Route::middleware('web')
            ->namespace($this->namespace . '\Importer')
            ->group(base_path('routes/route_importer.php'));

        //route for developer note
        Route::middleware('web')
            ->namespace($this->namespace . '\DeveloperNote')
            ->group(base_path('routes/route_developernote.php'));


        //Route for Legacy
        Route::middleware('web')
            ->namespace($this->namespace . '\Legacy')
            ->group(base_path('routes/route_legacy.php'));

        //Route for Budget
        Route::middleware('web')
            ->namespace($this->namespace . '\GlobalEmailSend')
            ->group(base_path('routes/route_global_email_send.php'));

        //Route for front web
        Route::middleware('web')
            ->prefix('web')
            ->namespace($this->namespace . '\Web')
            ->group(base_path('routes/route_web.php'));

        //Route for front web
        Route::middleware('web')
            ->namespace($this->namespace . '\Support')
            ->group(base_path('routes/route_support.php'));

        //Route for Support REport
        Route::middleware('web')
            ->namespace($this->namespace . '\Report')
            ->group(base_path('routes/route_supportReport.php'));

        //Route for Draft
        Route::middleware('web')
            ->namespace($this->namespace . '\Draft')
            ->group(base_path('routes/route_draft.php'));
       

        //Route for FGP
        Route::middleware('web')
            ->namespace($this->namespace . '\Fgp')
            ->group(base_path('routes/fgp/route_maintenance.php'));

        Route::middleware('web')
            ->namespace($this->namespace . '\Fgp\Location')
            ->group(base_path('routes/fgp/route_locations.php'));

        Route::middleware('web')
            ->namespace($this->namespace . '\Fgp\calendar')
            ->group(base_path('routes/fgp/route_calendar.php'));

        // program setup
        Route::middleware('web')
            ->namespace($this->namespace . '\Fgp\Program')
            ->group(base_path('routes/fgp/route_program.php'));

    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
