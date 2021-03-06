<?php

namespace TheTwelve\Mailgun\HttpClient;

class BuzzAdapter implements \TheTwelve\Mailgun\HttpClient
{

    /** @var \Buzz\Client\Curl */
    protected $client;

    /** @var string */
    protected $credentials;

    /**
     * @var string
     * @see http://curl.haxx.se/docs/caextract.html
     */
    protected $certificatePath;

    /**
     * initialize the adapter
     * @param \Buzz\Browser $client
     * @param string $certificatePath
     */
    public function __construct(\Buzz\Client\Curl $client, $certificatePath = null)
    {

        $this->client = $client;
        $this->certificatePath = $certificatePath;

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

        $request = $this->createRequest(self::POST, $resource, $uri);
        $request->setContent($params);

        $response = $this->createResponse();

        $this->client->send($request, $response, $this->getOptions());

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
        $request->setContent($params);

        $response = $this->createResponse();

        $this->client->send($request, $response, $this->getOptions());

        if ($response->isOk()) {
            return $response->getContent();
        }

        return null;

    }

    protected function createRequest($method, $resource = '', $host = null)
    {

        return new \Buzz\Message\Request($method, '/' . $resource, $host);

    }

    protected function createResponse()
    {

        return new \Buzz\Message\Response();

    }

    protected function getOptions()
    {

        return array(
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => $this->credentials,
            CURLOPT_CAINFO => $this->certificatePath,
        );

    }

}
