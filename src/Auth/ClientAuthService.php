<?php

namespace Kamiyuri\LaravelKeycloakAdmin\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
class ClientAuthService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return mixed
     * @throws GuzzleException
     */
    public function getToken()
    {
        return $this->getAuthorizationToken()['access_token'];
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    public function getAuthorizationToken() : array
    {
        $api = config('keycloakAdmin.api.client.token');

        if (Cache::has('keycloak-admin-credentials')) {
            return Cache::get('keycloak-admin-credentials');
        }

        $response = $this->client->post($api, $this->getOptions());

        $credentials = json_decode($response->getBody()->getContents(),true);

        return tap($credentials, function ($credentials) {
            Cache::put('keycloak-admin-credentials', $credentials, $credentials['expires_in']);
        });
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $options = [

            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => config('keycloakAdmin.client.id'),
                'client_secret' => config('keycloakAdmin.client.secret') ,
            ]
        ];
    }
}
