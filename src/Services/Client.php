<?php

namespace Kamiyuri\LaravelKeycloakAdmin\Services;

use GuzzleHttp\ClientInterface;
use Illuminate\Support\Arr;
use Kamiyuri\LaravelKeycloakAdmin\Auth\ClientAuthService;

class Client extends Service
{
    /**
     * @param ClientAuthService $auth
     * @param ClientInterface $http
     */
    public function __construct(ClientAuthService $auth , ClientInterface $http)
    {
        parent::__construct($auth, $http);

        $this->api = config('keycloakAdmin.api.client');
    }

    /**
     * @param $clientId
     * @return mixed
     */
    public function getByClientId($clientId)
    {
        $clients = Arr::where($this->all(), function ($client) use ($clientId){
            return $client['clientId'] === $clientId ;
        });

        return Arr::first($clients);
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
