<?php

namespace TheTwelve\Mailgun;

interface HttpClient
{

    const POST = 'post';
    const GET = 'get';

    /**
     * make a get request to the given uri
     * @param string $uri
     * @param string $resource
     * @param array $params
     * @return mixed
     */
    public function get($uri, $resource, array $params = array());

    /**
     * make a post request to the given uri
     * @param string $uri
     * @param string $resource
     * @param array $params
     * @return mixed
     */
    public function post($uri, $resource, array $params = array());

    /**
     * set the basic authentication credentials
     * @param string $username
     * @param string $password
     */
    public function setBasicAuth($username, $password);

}
