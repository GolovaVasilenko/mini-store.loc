<?php

namespace Core\Components\Mailer;


class Mailer
{
    protected $mailer;

    protected $message;

    public function __construct()
    {
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465))
            ->setUsername('vasilenko@lanars.com')
            ->setPassword('alex75vas');

        $this->mailer = new \Swift_Mailer($transport);

    }

    public function createMessage($from, $fromName, $to, $body)
    {
        $this->message = (new \Swift_Message('Meesage from site Aleksey Vasilenko'))
            ->setFrom([$from => $fromName])
            ->setTo($to)
            ->setBody($body);
    }

    public function send()
    {
        $this->mailer->send($this->message);
    }
}
