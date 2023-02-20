<?php

namespace Kamiyuri\LaravelKeycloakAdmin\Services;

use Kamiyuri\LaravelKeycloakAdmin\Auth\ClientAuthService;
use GuzzleHttp\ClientInterface;

class Addon extends Service
{
    /**
     * @param ClientAuthService $auth
     * @param ClientInterface $http
     */
    public function __construct(ClientAuthService $auth , ClientInterface $http)
    {
        parent::__construct($auth, $http);
        $this->api = config('keycloakAdmin.api.addon');
    }

    /**
     * @param $response
     * @return mixed|true
     */
    public function response($response)
    {
        if (!empty( $location = $response->getHeader('location') )){

            $url = current($location) ;

            return $this->get([
                'id' => substr( $url , strrpos( $url , '/') + 1 )
            ]);
        }

        return json_decode($response->getBody()->getContents() , true) ?: true ;
    }
}
