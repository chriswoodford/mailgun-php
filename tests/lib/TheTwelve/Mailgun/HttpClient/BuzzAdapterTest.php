<?php

class TheTwelve_Mailgun_HttpClient_BuzzAdapterTest
    extends PHPUnit_Framework_TestCase
{

    public function testGetRequest()
    {

        $content = 'Hello World!';

        $browser = $this->getMock('\Buzz\Browser');
        $response = $this->getMock('\Buzz\Message\Response');
        $response->expects($this->once())
                 ->method('getContent')
                 ->will($this->returnValue($content));

    }

}
