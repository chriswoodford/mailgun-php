<?php

namespace TheTwelve\Mailgun\HttpClient;

class BuzzAdapter implements \TheTwelve\Mailgun\HttpClient
{

    /** @var \Buzz\Client\Curl */
    protected $client;

    /** @var string */
    protected $credentials;

    /**
     * initialize the adapter
     * @param \Buzz\Browser $client
     */
    public function __construct(\Buzz\Client\Curl $client)
    {

        $this->client = $client;

    }

    /**
     * (non-PHPdoc)
     * @see TheTwelve\Mailgun.HttpClient::setBasicAuth()
     */
    public function setBasicAuth($username, $password)
    {

        $this->credentials = $username . ':' . $password;

    }

    /**
     * (non-PHPdoc)
     * @see TheTwelve\Mailgun.HttpClient::get()
     */
    public function get($uri, $resource, array $params = array())
    {

        $uri = rtrim($uri, '?') . '?' . http_build_query($params);
        $response = $this->client->get($uri, $this->headers);

        if ($response->isOk()) {
            return $response->getContent();
        }

        return null;

    }

    /**
     * (non-PHPdoc)
     * @see TheTwelve\Mailgun.HttpClient::post()
     */
    public function post($uri, $resource, array $params = array())
    {

        $request = $this->createRequest(self::POST, $resource, $uri);
        $response = $this->createResponse();

        $options = array(
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPSD => $this->credentials,

        );

        $this->client->send($request, $response, $options);

        if ($response->isOk()) {
            return $response->getContent();
        }

        return null;

    }

    protected function createRequest($method, $resource = '/', $host = null)
    {

        return new \Buzz\Message\Request($method, $resource, $host);

    }

    protected function createResponse()
    {

        return new \Buzz\Message\Response();

    }

}
