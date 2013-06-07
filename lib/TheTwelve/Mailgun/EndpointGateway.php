<?php

namespace TheTwelve\Mailgun;

class EndpointGateway
{

    /** @var \TheTwelve\Mailgun\HttpClient */
    protected $httpClient;

    /** @var string */
    protected $requestUri;

    /** @var string */
    protected $apiUser;

    /** @var string */
    protected $apiKey;

    /**
     * initialize the gateway
     * @param \TheTwelve\Mailgun\HttpClient $client
     */
    public function __construct(HttpClient $httpClient)
    {

        $this->httpClient = $httpClient;

    }

    /**
     * set the api credentials
     * @param string $user
     * @param string $key
     * @return \TheTwelve\Mailgun\EndpointGateway
     */
    public function setApiCredentials($user, $key)
    {

        $this->apiUser = $user;
        $this->apiKey = $key;
        return $this;

    }

    /**
     * set the request uri
     * @param string $requestUri
     * @return \TheTwelve\Mailgun\EndpointGateway
     */
    public function setRequestUri($requestUri)
    {

        $this->requestUri = rtrim($requestUri, '/');
        return $this;

    }

    /**
     * make a generic request to the api
     * @param string $resource
     * @param array $params
     * @param string $method
     * @return \stdClass
     */
    protected function makeApiRequest($resource, array $params = array(), $method = 'GET')
    {

        $uri = $this->requestUri . '/' . ltrim($resource, '/');

        $this->httpClient->setBasicAuth($this->apiUser . ':' . $this->apiKey);

        switch ($method) {
            case HttpClient::GET:
                $response = json_decode($this->httpClient->get($uri, $params));
                break;
            case HttpClient::POST:
                $response = json_decode($this->httpClient->post($uri, $params));
                break;
            default:
                throw new \RuntimeException('Currently only HTTP methods "GET" and "POST" are supported.');
        }

        return $response;

    }

}
