<?php

namespace Kamiyuri\LaravelKeycloakAdmin\Services;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use Kamiyuri\LaravelKeycloakAdmin\Auth\ClientAuthService;

abstract class Service
{
    /**
     * @var array
     */
    protected array $api = [];

    /**
     * @var ClientInterface
     */
    protected ClientInterface $http;

    /**
     * @var ClientAuthService
     */
    protected ClientAuthService $auth;

    /**
     * @param ClientAuthService $auth
     * @param ClientInterface $http
     */
    public function __construct(ClientAuthService $auth , ClientInterface $http)
    {
        $this->auth = $auth;
        $this->http = $http;
    }

    /**
     * @throws GuzzleException
     */
    public function __call($api, $args)
    {
        $args = Arr::collapse($args);

        [$url , $method] = $this->getApi($api, $args);

        $response = $this
            ->http
            ->request($method, $url, $this->createOptions($args));

        return $this->response($response);
    }

    /**
     * Creates guzzle http client options
     * @param array|null $params
     * @return array
     * @throws GuzzleException
     */
    public function createOptions(array $params = null) : array
    {
        return  [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->auth->getToken()
            ],
            'json' => $params['body'] ?? null,
        ];
    }

    /**
     * @param $apiName
     * @param $values
     * @return array
     */
    public function getApi($apiName, $values): array
    {
        return $this->initApi($apiName, $values) ;
    }

    /**
     * @param $apiName
     * @param $values
     * @return array
     */
    public function initApi($apiName, $values): array
    {
        $api = $this->api[$apiName]['api'];

        foreach($values as $name => $value) {
            if (is_string($value)) {
                $api = str_replace('{'.$name.'}', $value, $api);
            }
        }

        if (isset($values['query'])){
            $api = $api . '?' . http_build_query($values['query']);
        }

        return [$api ,$this->api[$apiName]['method']];
    }
}
