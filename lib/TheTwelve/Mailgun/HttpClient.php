<?php

namespace TheTwelve\Mailgun;

interface HttpClient
{

    const POST = 'post';
    const GET = 'get';

    /**
     * make a get request to the given uri
     * @param string $uri
     * @param array $params
     * @return mixed
     */
    public function get($uri, array $params = array());

    /**
     * make a post request to the given uri
     * @param string $uri
     * @param array $params
     * @return mixed
     */
    public function post($uri, array $params = array());

}
