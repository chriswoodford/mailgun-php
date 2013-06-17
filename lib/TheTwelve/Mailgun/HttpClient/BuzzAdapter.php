<?php

namespace TheTwelve\Mailgun\HttpClient;

class BuzzAdapter implements \TheTwelve\Mailgun\HttpClient
{

    /** @var \Buzz\Browser */
    protected $client;

    /** @var array */
    protected $headers;

    /**
     * initialize the adapter
     * @param \Buzz\Browser $client
     */
    public function __construct(\Buzz\Browser $client)
    {

        $this->client = $client;
        $this->headers = array();

    }

    /**
     * (non-PHPdoc)
     * @see TheTwelve\Mailgun.HttpClient::setBasicAuth()
     */
    public function setBasicAuth($credentials)
    {

        $this->headers['Authorization'] = "Basic " . base64_encode($credentials);

    }

    /**
     * (non-PHPdoc)
     * @see TheTwelve\Mailgun.HttpClient::get()
     */
    public function get($uri, array $params = array())
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
    public function post($uri, array $params = array())
    {

        $response = $this->client->post($uri, $this->headers, http_build_query($params));

        if ($response->isOk()) {
            return $response->getContent();
        }

        return null;

    }

}
