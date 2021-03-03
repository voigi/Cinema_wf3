<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class Mailer{

    private $mailer;

    public function __construct(MailerInterface $mailer){
        
        $this->mailer=$mailer;
    }

public function sendContact($email, $demande,$message, $pseudo){
        $orderid = uniqid();
        //envoie d'un mails de confirmation
        $email = (new TemplatedEmail())
            ->from('registration@gamearea.com')//l'email de notre site
            ->to(new Address($email))//l'email du support
            ->subject('demande n°'.$orderid)
        
            // path of the Twig template to render
            ->htmlTemplate('Email/contact.html.twig')
        
            // pass variables (name => value) to the template
            ->context([
                'demande' => $demande,
                'message' => $message,
                'pseudo' => $pseudo,
        ]);
    $this->mailer->send($email);
    }
}