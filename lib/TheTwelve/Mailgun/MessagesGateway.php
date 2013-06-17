<?php

namespace TheTwelve\Mailgun;

use Buzz\Exception\RuntimeException;

use TheTwelve\Mailgun\Message;

class MessagesGateway extends EndpointGateway
{

    /**
     * create a new email message
     * @return Message\EmailMessage
     */
    public function createMessage()
    {

        return new \TheTwelve\Mailgun\Message\EmailMessage();

    }

    /**
     * send an email
     * @param Message\EmailMessage $message
     */
    public function send(Message\EmailMessage $message)
    {

        $params = $message->toArray();
        $response = $this->makeApiRequest('messages', $params, HttpClient::POST);

        if ($response instanceof \stdClass) {
            return $response->message;
        }

        throw new \RuntimeException('Unable to queue message via mailgun');

    }

}
