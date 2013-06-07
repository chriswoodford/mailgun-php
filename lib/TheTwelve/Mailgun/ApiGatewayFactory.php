<?php

namespace TheTwelve\Mailgun;

class ApiGatewayFactory
{

    /** @var \TheTwelve\Mailgun\HttpClient */
    protected $httpClient;

    /** @var string */
    protected $version = 'v2';

    /** @var string */
    protected $endpointUri = 'https://api.mailgun.net';

    /** @var string */
    protected $apiUser;

    /** @var string */
    protected $apiKey;

    /** @var string */
    protected $domainName;

    /** @var string */
    protected $requestUri;

    /**
     * initialize the gateway
     * @param \TheTwelve\Mailgun\HttpClient $httpClient
     */
    public function __construct(HttpClient $httpClient)
    {

        $this->httpClient = $httpClient;

    }

    /**
     * set the api endpoint uri
     * @param string $uri
     * @return \TheTwelve\Mailgun\ApiGatewayFactory
     */
    public function setEndpointUri($uri)
    {

        $this->endpointUri = $uri;
        return $this;

    }

    /**
     * tell the factory to use the supplied version
     * @param integer $version
     * @return \TheTwelve\Mailgun\ApiGatewayFactory
     */
    public function useVersion($version)
    {

        $this->version = 'v' . $version;
        return $this;

    }

    /**
     * set the api credentials
     * @param string $user
     * @param string $key
     * @return \TheTwelve\Mailgun\ApiGatewayFactory
     */
    public function setApiCredentials($user, $key)
    {

        $this->apiUser = $user;
        $this->apiKey = $key;
        return $this;

    }

    /**
     * set the domain name to be used in the request uri
     * @param string $domain
     * @return \TheTwelve\Mailgun\ApiGatewayFactory
     */
    public function setDomainName($domain)
    {

        $this->domainName = $domain;
        return $this;

    }

    /**
     * get the messsages gateway
     * @return \TheTwelve\Mailgun\MessagesGateway
     */
    public function getMessagesGateway()
    {

        $gateway = new MessagesGateway($this->httpClient);
        $gateway->setApiCredentials($this->apiUser, $this->apiKey);
        $gateway->setRequestUri($this->getRequestUri());

        return $gateway;

    }

    /**
     * get the uri to make requests to
     * @return string
     */
    protected function getRequestUri()
    {

        if (!$this->requestUri) {
            $this->requestUri = rtrim($this->endpointUri, '/')
                . '/' . $this->version
                . '/' . $this->domainName;
        }

        return $this->requestUri;

    }

}
