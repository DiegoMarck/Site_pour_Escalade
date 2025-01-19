<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\CarouselRepository;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front")
     */
    public function index(CarouselRepository $repoCarousel): Response
    {  
        $carousel=$repoCarousel->findAll();
        return $this->render('front/index.html.twig', [
            'carousel'=> $carousel,
        ]);
        
    }

    /**
     * @Route("/form/contact", name="contact", methods={"GET", "POST"} )
     */
    public function contact(Request $req, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class, null, [
            "user" => $this->getUser()
        ]);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            $email = (new Email())
                ->from('admin@monsite.com')
                ->to('diego@gmail.com')
                ->addTo('test@gmail.com')
                ->subject('Demande de contact')
                ->html($this->renderView(
                    'emails/contact.html.twig',
                    [
                        'nom' => $data['nom'],
                        'prenom' => $data['prenom'],
                        'email' => $data['email'],
                        'message' => $data['message']
                    ]
                ));

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('front');
        }

        return $this->render('front/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
