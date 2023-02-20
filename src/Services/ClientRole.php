<?php

namespace Kamiyuri\LaravelKeycloakAdmin\Services;

use GuzzleHttp\ClientInterface;
use Kamiyuri\LaravelKeycloakAdmin\Auth\ClientAuthService;

class ClientRole extends Service
{
    /**
     * @param ClientAuthService $auth
     * @param ClientInterface $http
     */
    function __construct(ClientAuthService $auth , ClientInterface $http)
    {
        parent::__construct($auth, $http);

        $this->api = config('keycloakAdmin.api.client_roles');
    }

    /**
     * @param $response
     * @return mixed|true
     */
    public function response($response)
    {
        if (!empty( $location = $response->getHeader('location') )){

            $url = current($location) ;

            return $this->getByName([
                'role' => substr( $url , strrpos( $url , '/') + 1 )
            ]);
        }

        return json_decode($response->getBody()->getContents() , true) ?: true;
    }
}
