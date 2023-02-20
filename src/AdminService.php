<?php

namespace Kamiyuri\LaravelKeycloakAdmin;

use GuzzleHttp\Client as HttpClient;
use Kamiyuri\LaravelKeycloakAdmin\Auth\ClientAuthService;
use Kamiyuri\LaravelKeycloakAdmin\Services\Addon;
use Kamiyuri\LaravelKeycloakAdmin\Services\Client;
use Kamiyuri\LaravelKeycloakAdmin\Services\ClientRole;
use Kamiyuri\LaravelKeycloakAdmin\Services\Role;
use Kamiyuri\LaravelKeycloakAdmin\Services\User;

class AdminService
{
    /**
     * @var array
     */
    protected array $container = [];
    protected ClientAuthService $auth;

    /**
     * @param ClientAuthService $auth
     */
    function __construct(ClientAuthService $auth) {

        $this->auth = $auth;
        $this->registerServices();
    }

    /**
     * @param string $service
     * @return mixed
     */
    public function getService(string $service)
    {
        return new $this->container[$service]($this->auth , new HttpClient());
    }

    /**
     * @return void
     */
    public function registerServices() : void
    {
        $this->container =[
            'User' => User::class,
            'Role' => Role::class,
            'Client' => Client::class,
            'ClientRole' => ClientRole::class,
            'Addon' => Addon::class
        ];
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->getService('User');
    }

    /**
     * @return mixed
     */
    public function role()
    {
        return $this->getService('Role');
    }

    /**
     * @return mixed
     */
    public function client()
    {
        return $this->getService('Client');
    }

    /**
     * @return mixed
     */
    public function clientRole()
    {
        return $this->getService('ClientRole');
    }

    /**
     * @return mixed
     */
    public function addon()
    {
        return $this->getService('Addon');
    }
}
