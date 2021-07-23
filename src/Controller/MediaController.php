<?php

namespace App\Controller;

use App\Entity\Media;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/media")
 */
class MediaController extends AbstractController
{
    /**
     * @Route("/", name="media_index", methods={"GET"})
     */
    public function index(MediaRepository $mediaRepository): Response
    {
        return $this->render('media/index.html.twig', [
            'media' => $mediaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="media_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medium = new Media();
        $form = $this->createForm(MediaType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medium);
            $entityManager->flush();

            return $this->redirectToRoute('media_index');
        }

        return $this->render('media/new.html.twig', [
            'medium' => $medium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="media_show", methods={"GET"})
     */
    public function show(Media $medium): Response
    {
        return $this->render('media/show.html.twig', [
            'medium' => $medium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="media_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Media $medium): Response
    {
        $form = $this->createForm(MediaType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('media_index');
        }

        return $this->render('media/edit.html.twig', [
            'medium' => $medium,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="media_delete", methods={"POST"})
     */
    public function delete(Request $request, Media $medium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('media_index');
    }
    // /**
    //  * @Route("/supprime/media/{id}, name="siteDeleteImage", methods={"DELETE"})//cette methode récupère info envoyée permet de surpimer l'image  -ajax
    //  */
    // public function deleteImage(Media $medi, Request $request){
    //     $data = json_decode($request->getContent(), true);
        
    //     // on vérifie si le token est valide
    //     if ($this->isCsrfTokenValid('delete' .$medi->getId(), $data['_token'])) {
    //         //on récupère le nom de l'image
    //         $nom = $medi->getNom();
    //         //puis on supprime le fichier
    //         unlink($this->getParameter('images_directory').'/'.$nom);
    //         // on supprime l'entrée de la base
    //         $em=$this->getDoctrine()->getManager();
    //         $em->remove($medi);
    //         $em->flush();

    //         // on répond en json
    //         return new JsonResponse(['succes' => 1]);
    //     }else{
    //         return new JsonResponse(['error' => 'Token Invalide'], 400);
    //     }
    // }
}
