<?php

namespace TheTwelve\Mailgun;

use TheTwelve\Mailgun\Message;

class MessagesGateway extends EndpointGateway
{

    const EMAIL_QUEUED_SUCCESS_MESSAGE = 'Queued. Thank you.';

    /**
     * create a new email message
     * @return Message\EmailMessage
     */
    public function createMessage()
    {

        return new \TheTwelve\Mailgun\Message\EmailMessage();

    }

    /**
     * send an email. throws an exception if a successful connection
     * is not made with mailgun. returns true if the email is queued
     * successfully. false otherwise.
     * @param Message\EmailMessage $message
     * @return boolean
     * @throws \RuntimeException
     */
    public function send(Message\EmailMessage $message)
    {

        $params = $message->toArray();
        $response = $this->makeApiRequest('messages', $params, HttpClient::POST);

        if (!$response instanceof \stdClass) {
            throw new \RuntimeException('Unable to queue message via mailgun');
        }

        if ($response->message != self::EMAIL_QUEUED_SUCCESS_MESSAGE) {
            return false;
        }

        return true;

    }

}
