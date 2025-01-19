<?php

namespace App\Controller;

use App\Entity\Site;
use App\Entity\Media;
use App\Form\SiteType;
use App\Repository\SiteRepository;
use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/site')]
class SiteController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private KernelInterface $kernel
    ) {
    }

    public function upload(): Response
    {
        $imagesDir = $this->kernel->getProjectDir().'/public/uploads';
        dump($imagesDir);
        return $this->render('site/show.html.twig');
    }

    #[Route('/api/sites', name: 'api_sites', methods: ['GET'])]
    public function apiSites(SiteRepository $siteRepository): JsonResponse
    {
        $sites = $siteRepository->findAll();
        $sitesData = [];

        foreach ($sites as $site) {
            $sitesData[] = [
                'id' => $site->getId(),
                'nom' => $site->getNom(),
                'latitude' => $site->getLatitude(),
                'longitude' => $site->getLongitude(),
                'description' => $site->getInfoSuplementaire(),
                'difficulte' => $site->getDifficulte(),
                'nombreVoies' => $site->getNombredeVoie(),
            ];
        }

        return new JsonResponse($sitesData);
    }

    #[Route('/', name: 'site_index', methods: ['GET'])]
    public function index(SiteRepository $siteRepository): Response
    {
        return $this->render('site/index.html.twig', [
            'sites' => $siteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'site_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $site = new Site();
        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $media = $form->get('site')->getData();
            foreach($media as $medi){
                $fichier = md5(uniqid()) . '.' . $medi->guessExtension();
                $medi->move(
                    $this->kernel->getProjectDir().'/public/uploads',
                    $fichier
                );
                $img = new Media();
                $img->setNom($fichier);
                $site->addMedium($img);
            }
            $this->entityManager->persist($site);
            $this->entityManager->flush();

            return $this->redirectToRoute('site_index');
        }

        return $this->render('site/new.html.twig', [
            'site' => $site,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/conv', name: 'site_converter')]
    public function converter():Response
    {
        return  $this->render('site/converter.html.twig');
    }

    #[Route('/{id}', name: 'site_show', methods: ['GET'])]
    public function show(Site $site, MediaRepository $mediaRepository): Response
    {
        $media = $mediaRepository->findBy(
            ['site'=>$site->getId()]
        );

        return $this->render('site/show.html.twig', [
            'site' => $site,
            'media' => $media,
        ]);
    }

    #[Route('/{id}/edit', name: 'site_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Site $site): Response
    {
        $form = $this->createForm(SiteType::class, $site);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $media = $form->get('site')->getData();
            foreach($media as $medi){
                $fichier = md5(uniqid()) . '.' . $medi->guessExtension();
                $medi->move(
                    $this->kernel->getProjectDir().'/public/uploads',
                    $fichier
                );
                $img = new Media();
                $img->setNom($fichier);
                $site->addMedium($img);
            }
            $this->entityManager->flush();

            return $this->redirectToRoute('site_index');
        }

        return $this->render('site/edit.html.twig', [
            'site' => $site,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'site_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Site $site): Response
    {
        if ($this->isCsrfTokenValid('delete'.$site->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($site);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('site_index');
    }

    #[Route('/supprime/image/{id}', name: 'site_delete_image', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteImage(Media $media, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete'.$media->getId(), $data['_token'])) {
            $nom = $media->getNom();

            unlink($this->kernel->getProjectDir().'/public/uploads/'.$nom);

            $this->entityManager->remove($media);
            $this->entityManager->flush();

            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
}