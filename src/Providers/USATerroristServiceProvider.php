<?php

namespace Jota\USATerroristList\Providers;

use Jota\USATerroristList\Classes\USATerroristList;
use Illuminate\Support\ServiceProvider;

class USATerroristServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('USATerroristList', function () {
            return new USATerroristList();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        $this->publishes([
            __DIR__ . '/../../config/usaterrorist.php' => config_path('usaterrorist.php'),
        ]);
    }
}
