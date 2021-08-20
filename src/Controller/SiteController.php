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
        // $site = $siteRepository->findAll();
        // $sites = [];
        // foreach($site as $siteEsc ){
        //     $sites [] = [
        //         'id' => $siteEsc->getId(),
        //         'nom' => $siteEsc->getNom(),
        //     ];
        // }
        // $data = json_encode($sites);
        // return $this->render('site/index.html.twig',
        // compact('data') );
        return $this->render('site/index.html.twig', [
            'sites' => $siteRepository->findAll(),
              
        ]);
        // return $this->json([
        //     ['nom' => 'Site 1', 'latitude' => 46.56, 'longitude', 7.3],
        //     ['nom' => 'Site 2', 'latitude' => 44.38, 'longitude', 6.89],
        // ]);
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

    
}
