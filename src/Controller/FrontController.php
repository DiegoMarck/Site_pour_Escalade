<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\CarouselRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function contact( Request $req, \Swift_Mailer $mailer){ //fait la requette de contact en rajoutant Request quand on valide il sera pris en compte. Informations renvoyé au code on veut que le formulaire soit post donc + methodes

        $form = $this->createForm(ContactType::class, null, [
            "user"=>$this->getUser()
        ] );

        $form->handleRequest($req);


        //validationform
        if($form->isSubmitted() && $form->isValid()){
            // dump("form validé");
            // dump($form->getData());
            // dump($form);
            $data=$form->getData();
            // dump($data);
            //recupérer les contenu des champsdans le tableau
            dump($data["email"]);
            //créer un email
            $message = new \Swift_Message("Demande de contact");
            $message->setFrom("admin@monsite.com")
                    // ->setTo($data["email"])
                    ->setTo(["diego@gmail.com", "test@gmail.com"])
                    ->setBody(
                        $this->renderView('email/contact.html.twig', [
                            "data"=>$data
                        ]), "text/html"
                    );

                    $mailer->send($message);//envoie le message
                    //message de notification
                    $this->addFlash(
                        'info', 
                        "Nous avons bien reçu votre message. Nous vous remercions de votre intéret."
                    );
                    return $this->redirectToRoute("front");
                    //redirige vers la page d'accueil
                    //affiche un petit message vous avez bien envoyé un petit message -> flash message
        }

        dump($form->createView());
        return $this->render("front/contact.html.twig", [
            "form"=>$form->createView()
        ]);
    }
}
