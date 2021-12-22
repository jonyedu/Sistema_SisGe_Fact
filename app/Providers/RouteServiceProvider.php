<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::middleware('banco')
                ->namespace($this->namespace)
                ->group(base_path('routes/banco.php'));

            Route::middleware('inventario')
                ->namespace($this->namespace)
                ->group(base_path('routes/inventario.php'));

            Route::middleware('persona')
                ->namespace($this->namespace)
                ->group(base_path('routes/persona.php'));

            Route::middleware('reporte')
                ->namespace($this->namespace)
                ->group(base_path('routes/reporte.php'));

            Route::middleware('seguridad')
                ->namespace($this->namespace)
                ->group(base_path('routes/seguridad.php'));

            Route::middleware('transaccion')
                ->namespace($this->namespace)
                ->group(base_path('routes/transaccion.php'));

            Route::middleware('parametrizacion')
                ->namespace($this->namespace)
                ->group(base_path('routes/parametrizacion.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
