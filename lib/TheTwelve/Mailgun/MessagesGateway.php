<?php

namespace TheTwelve\Mailgun;

class MessagesGateway extends EndpointGateway
{

    /**
     * send an email
     * @param Message $email
     */
    public function send(Message $email)
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
