<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
        $contact = new Contact();
        $user = $this->getUser();
        
        $form = $this->createForm(ContactType::class, $contact, [
            'user' => $user
        ]);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();
            
            // Envoyer l'email
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('votre-email@example.com') // Remplacez par votre email
                ->subject('Nouveau message de contact')
                ->html($this->renderView(
                    'email/contact.html.twig',
                    ['contact' => $contact]
                ));
            
            $mailer->send($email);
            
            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('app_contact');
        }
        
        return $this->render('front/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
