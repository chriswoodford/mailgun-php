<?php

namespace TheTwelve\Mailgun;

class MessagesGateway extends EndpointGateway
{

    public function send()
    {

        $params = array(
        	'from' => '',
			'to' => '',
			'subject' => '',
			'text' => '',
        );

        $this->makeApiRequest('messages', $params, HttpClient::POST);

    }

}
