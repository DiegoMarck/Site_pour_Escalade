<?php

namespace App\Controller;

use App\Entity\Topo;
use App\Entity\Media;
use App\Form\TopoType;
use App\Repository\TopoRepository;
use App\Repository\MediaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/topo")
 */
class TopoController extends AbstractController
{
    /**
     * @Route("/", name="topo_index", methods={"GET"})
     */
    public function index(TopoRepository $topoRepository): Response
    {
        return $this->render('topo/index.html.twig', [
            'topos' => $topoRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/new", name="topo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $topo = new Topo();
        $form = $this->createForm(TopoType::class, $topo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on recupère les medias transmises
            $media = $form->get('topo')->getData();
            //on boucle sur les medias 
            foreach($media as $medi){
                //on génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $medi->guessExtension();
                //on copie le fichier dans le dossier img
                $medi->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //on stocke l'image dans la bdd
                $img = new Media();
                $img->setNom($fichier);
                $topo->addMedium($img);

            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($topo);
            $entityManager->flush();

            return $this->redirectToRoute('topo_index');
        }
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($topo);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('topo_index');
        // }

        return $this->render('topo/new.html.twig', [
            'topo' => $topo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="topo_show", methods={"GET"})
     * 
     */
    public function show(Topo $topo, MediaRepository $mediarepository, $id): Response
    {
        $media = $mediarepository->findBy(
            ['topo'=>$id]
        );
        return $this->render('topo/show.html.twig', [
            'topo' => $topo,
            'media' => $media,

        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="topo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Topo $topo): Response
    {
        $form = $this->createForm(TopoType::class, $topo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on recupère les medias transmises
            $media = $form->get('topo')->getData();
            //on boucle sur les medias 
            foreach($media as $medi){
                //on génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $medi->guessExtension();
                //on copie le fichier dans le dossier img
                $medi->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                //on stocke l'image dans la bdd
                $img = new Media();
                $img->setNom($fichier);
                $topo->addMedium($img);

            }
            
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('topo_index');
        }

        

        return $this->render('topo/edit.html.twig', [
            'topo' => $topo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="topo_delete", methods={"POST"})
     */
    public function delete(Request $request, Topo $topo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$topo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($topo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('topo_index');
    }
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/supprime/image/{id}", name="topos_delete_image", methods={"DELETE"})
     */
    public function deleteImage(Topo $topo, Request $request){
        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$topo->getId(), $data['_token'])){
            // On récupère le nom de l'image
            $nom = $topo->getTitre();
            // On supprime le fichier
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($topo);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}