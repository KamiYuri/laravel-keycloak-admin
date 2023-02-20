<?php
namespace Kamiyuri\LaravelKeycloakAdmin\Facades;

use Illuminate\Support\Facades\Facade;

class KeycloakAdmin extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'KeycloakAdmin';
    }

}
