<?php

class TheTwelve_Mailgun_EndpointGatewayTest
    extends PHPUnit_Framework_TestCase
{

    public function testMessagesGateway()
    {

        $client = $this->getHttpClient();
        $user = 'api';
        $key = 'XDERFVGTYHGHYUJNMKJU';

        $gateway = new \TheTwelve\Mailgun\EndpointGateway($client);
        $gateway->setApiCredentials($user, $key);

        $this->assertTrue($gateway instanceof \TheTwelve\Mailgun\EndpointGateway);
        $this->assertAttributeEquals($client, 'httpClient', $gateway);
        $this->assertAttributeEquals($user, 'apiUser', $gateway);
        $this->assertAttributeEquals($key, 'apiKey', $gateway);

    }

    protected function getHttpClient()
    {

        return $this->getMock(
        	'TheTwelve\Mailgun\HttpClient'
        );

    }

}
