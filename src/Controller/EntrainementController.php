<?php

namespace App\Controller;

use App\Entity\Entrainement;
use App\Form\EntrainementType;
use App\Repository\EntrainementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/entrainement')]
class EntrainementController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }

    #[Route('/', name: 'entrainement_index', methods: ['GET'])]
    public function index(EntrainementRepository $entrainementRepository): Response
    {
        return $this->render('entrainement/index.html.twig', [
            'entrainements' => $entrainementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'entrainement_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $entrainement = new Entrainement();
        $form = $this->createForm(EntrainementType::class, $entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($entrainement);
            $this->entityManager->flush();

            return $this->redirectToRoute('entrainement_index');
        }

        return $this->render('entrainement/new.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'entrainement_show', methods: ['GET'])]
    public function show(Entrainement $entrainement): Response
    {
        return $this->render('entrainement/show.html.twig', [
            'entrainement' => $entrainement,
        ]);
    }

    #[Route('/{id}/edit', name: 'entrainement_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Entrainement $entrainement): Response
    {
        $form = $this->createForm(EntrainementType::class, $entrainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('entrainement_index');
        }

        return $this->render('entrainement/edit.html.twig', [
            'entrainement' => $entrainement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'entrainement_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Entrainement $entrainement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entrainement->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($entrainement);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('entrainement_index');
    }
}
