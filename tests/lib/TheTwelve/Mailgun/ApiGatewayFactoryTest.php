<?php

class TheTwelve_Mailgun_ApiGatewayFactoryTest
    extends PHPUnit_Framework_TestCase
{

    public function testProperties()
    {

        $client = $this->getHttpClient();
        $user = 'api';
        $key = 'XDERFVGTYHGHYUJNMKJU';

        $factory = new \TheTwelve\Mailgun\ApiGatewayFactory($client);
        $factory->setApiCredentials($user, $key);

        $this->assertAttributeEquals($client, 'httpClient', $factory);
        $this->assertAttributeEquals($user, 'apiUser', $factory);
        $this->assertAttributeEquals($key, 'apiKey', $factory);

    }

    public function testMessagesGateway()
    {

        $client = $this->getHttpClient();
        $user = 'api';
        $key = 'XDERFVGTYHGHYUJNMKJU';

        $factory = new \TheTwelve\Mailgun\ApiGatewayFactory($client);
        $factory->setApiCredentials($user, $key);

        $gateway = $factory->getMessagesGateway();

        $this->assertTrue($gateway instanceof \TheTwelve\Mailgun\MessagesGateway);
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
