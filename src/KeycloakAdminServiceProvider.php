<?php

namespace Kamiyuri\LaravelKeycloakAdmin;

use Illuminate\Support\ServiceProvider;

class KeycloakAdminServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('KeycloakAdmin', function ($app) {
            return $app->make(AdminService::class);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Config/keycloakAdmin.php' => base_path() . '/config/keycloakAdmin.php',
        ], 'KeycloakAdmin');
    }
}
