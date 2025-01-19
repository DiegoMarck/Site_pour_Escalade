<?php

namespace App\Controller;

use App\Entity\Topo;
use App\Entity\Media;
use App\Form\TopoType;
use App\Repository\TopoRepository;
use App\Repository\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/topo')]
class TopoController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private KernelInterface $kernel
    ) {
    }

    #[Route('/', name: 'topo_index', methods: ['GET'])]
    public function index(TopoRepository $topoRepository): Response
    {
        return $this->render('topo/index.html.twig', [
            'topos' => $topoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'topo_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request): Response
    {
        $topo = new Topo();
        $form = $this->createForm(TopoType::class, $topo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $media = $form->get('topo')->getData();
            foreach($media as $medi){
                $fichier = md5(uniqid()) . '.' . $medi->guessExtension();
                $medi->move(
                    $this->kernel->getProjectDir().'/public/uploads',
                    $fichier
                );
                $img = new Media();
                $img->setNom($fichier);
                $topo->addMedium($img);
            }

            $this->entityManager->persist($topo);
            $this->entityManager->flush();

            return $this->redirectToRoute('topo_index');
        }

        return $this->render('topo/new.html.twig', [
            'topo' => $topo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'topo_show', methods: ['GET'])]
    public function show(Topo $topo, MediaRepository $mediaRepository): Response
    {
        $media = $mediaRepository->findBy(['topo' => $topo->getId()]);

        return $this->render('topo/show.html.twig', [
            'topo' => $topo,
            'media' => $media,
        ]);
    }

    #[Route('/{id}/edit', name: 'topo_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Topo $topo): Response
    {
        $form = $this->createForm(TopoType::class, $topo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $media = $form->get('topo')->getData();
            foreach($media as $medi){
                $fichier = md5(uniqid()) . '.' . $medi->guessExtension();
                $medi->move(
                    $this->kernel->getProjectDir().'/public/uploads',
                    $fichier
                );
                $img = new Media();
                $img->setNom($fichier);
                $topo->addMedium($img);
            }

            $this->entityManager->flush();

            return $this->redirectToRoute('topo_index');
        }

        return $this->render('topo/edit.html.twig', [
            'topo' => $topo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'topo_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Topo $topo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$topo->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($topo);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('topo_index');
    }

    #[Route('/supprime/image/{id}', name: 'topo_delete_image', methods: ['DELETE'])]
    #[IsGranted('ROLE_USER')]
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