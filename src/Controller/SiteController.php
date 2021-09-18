<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\Media;
use App\Form\SiteType;
use App\Repository\SiteRepository;
use App\Repository\MediaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/site")
 */
class SiteController extends AbstractController
{
 
    public function upload( KernelInterface $kernel): Response
    {
 
       $imagesDir = $kernel->getProjectDir().'/public/uploads'; // équivalent à $this->getParameter('images_directory')
       dump($imagesDir) ;
        return $this->render('site/show.html.twig');
    }
    /**
     * @Route("/", name="site_index", methods={"GET"})
     */
    public function index(SiteRepository $siteRepository): Response
    {
        
        return $this->render('site/index.html.twig', [
            'sites' => $siteRepository->findAll(),
              
        ]);
        
    }

    /**
     * @Route("/new", name="site_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $site = new Site();
        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on recupère les medias transmises
            $media = $form->get('site')->getData();
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
                $site->addMedium($img);

            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($site);
            $entityManager->flush();

            return $this->redirectToRoute('site_index');
        }

        return $this->render('site/new.html.twig', [
            'site' => $site,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/conv", name="site_converter")
     */
    public function converter():Response
    {
        return  $this->render('site/converter.html.twig');
    }

    /**
     * @Route("/{id}", name="site_show", methods={"GET"})
     * 
     */
    public function show(Site $site, MediaRepository $mediarepository, $id): Response
    {
        $media = $mediarepository->findBy(
            ['site'=>$id]
        );

        return $this->render('site/show.html.twig', [
            'site' => $site,
            'media' => $media,

        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}/edit", name="site_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Site $site): Response
    {
        $form = $this->createForm(SiteType::class, $site);//j'appelle le form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on recupère les medias transmises
            $media = $form->get('site')->getData();
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
                $site->addMedium($img);

            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('site_index');
        }

        return $this->render('site/edit.html.twig', [
            'site' => $site,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/{id}", name="site_delete", methods={"POST"})
     */
    public function delete(Request $request, Site $site): Response
    {
        if ($this->isCsrfTokenValid('delete'.$site->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($site);
            $entityManager->flush();
        }

        return $this->redirectToRoute('site_index');
    }

    // /**
    //  * @Route("/supprime/image/{id}", name="annonce_delete_image", methods={"DELETE"})
    //  */
    // public function deleteImage(Site $site, Request $request){
    //     $data = json_decode($request->getContent(), true);
    //     // on vérifie si le token est valide
    //     if($this->isCsrfTokenValid('delete').$site->getId(), $data['_token'])){
    //         // on récupère le nom de l'image et on supprime le fichier
    //         $nom = $site->getNom();
    //         unlink($this->getParameter('images_directory').'/'.$nom);

    //         $em = $this->getDoctrine()->getManager();
    //         $em->remove($site);
    //         $em->flush();
    //         //on répond en json
    //         return new JsonResponse(['succes' =>1]);
    //     }else{
    //         return new JsonResponse(['error' => 'Token Invalide'], 400);
    //     }
        
    // }
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/supprime/image/{id}", name="sites_delete_image", methods={"DELETE"})
     */
    public function deleteImage(Site $site, Request $request){
        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$site->getId(), $data['_token'])){
            // On récupère le nom de l'image
            $nom = $site->getNom();
            // On supprime le fichier
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($site);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}