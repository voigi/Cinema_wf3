<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ContactMeType;
use App\Form\MailerType;
use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ContactController extends AbstractController
{
    
    /**
     * @Route("/contact", name="contact_me")
     */
    public function ContactMe(Request $request, Mailer $mailer)
    {
        $user=$this->getUser();
        $form = $this->createForm(MailerType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $data=$form->getData();
            $mailer->sendContact("lesorceleurdunord@gmail.com", $data['demand'], $data['contenu'], $user->getUserName());
            $this->addFlash('success', 'Votre message a bien était envoyé');
            return $this->redirectToRoute('contact_me');
        }

        return $this->render('Email/contactForm.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}