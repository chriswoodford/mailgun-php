<?php

namespace TheTwelve\Mailgun\Message;

class EmailMessage
{

    /** @var string */
    protected $from;

    /** @var array */
    protected $to = array();

    /** @var array */
    protected $cc = array();

    /** @var array */
    protected $bcc = array();

    /** @var string */
    protected $subject;

    /** @var string */
    protected $text;

    /** @var string */
    protected $html;

    /** @var array */
    protected $attachments = array();

    /**
     * get an array representation of this email
     * @return array
     */
    public function toArray()
    {

        $values = array(
            'from' => $this->from,
            'to' => join(',', $this->to),
        );

        if (!empty($this->cc)) {
            $values['cc'] = join(',', $this->cc);
        }

        if (!empty($this->bcc)) {
            $values['bcc'] = join(',', $this->bcc);
        }

        if ($this->subject) {
            $values['subject'] = $this->subject;
        }

        if ($this->text) {
            $values['text'] = $this->text;
        }

        if ($this->html) {
            $values['html'] = $this->html;
        }

        foreach ($this->attachments as $key => $attachment) {
            $values['attachment[' . $key . ']'] = $attachment;
        }

        return $values;

    }

    /**
     * set the sender
     * @param string $emailAddress
     * @param string $name
     * @return EmailMessage
     */
    public function from($emailAddress, $name = null)
    {

        $template = "{$name} <{$emailAddress}>";
        $this->from = trim($template);
        return $this;

    }

    /**
     * add a receipient
     * @param string $emailAddress
     * @return EmailMessage
     */
    public function to($emailAddress)
    {

        $this->to[] = $emailAddress;
        return $this;

    }

    /**
     * add a cc receipient
     * @param string $emailAddress
     * @return EmailMessage
     */
    public function cc($emailAddress)
    {

        $this->cc[] = $emailAddress;
        return $this;

    }

    /**
     * add a bcc receipient
     * @param string $emailAddress
     * @return EmailMessage
     */
    public function bcc($emailAddress)
    {

        $this->bcc[] = $emailAddress;
        return $this;

    }

    /**
     * set the subject of this email
     * @param string $subject
     * @return EmailMessage
     */
    public function subject($subject)
    {

        $this->subject = $subject;
        return $this;
    }

    /**
     * set the text version of this email
     * @param string $text
     * @return EmailMessage
     */
    public function text($text)
    {

        $this->text = $text;
        return $this;

    }

    /**
     * set the html version of this email
     * will auto-generate a text version if one does not exist
     * @param string $html
     * @return EmailMessage
     */
    public function html($html)
    {

        $this->html = $html;

        if (!$this->text) {
            $this->text(strip_tags($html));
        }

        return $this;

    }

    /**
     * attach a file
     * @param string $attachment
     * @return EmailMessage
     */
    public function attach($attachment)
    {

        $key = empty($this->attachments) ? 1 : count($this->attachments) + 1;
        $this->attachments[$key] = $attachment;
        return $this;

    }

}
