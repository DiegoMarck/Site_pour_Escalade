<?php

namespace App\Controller;

use App\Entity\Topo;
use App\Form\TopoType;
use App\Repository\TopoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/new", name="topo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $topo = new Topo();
        $form = $this->createForm(TopoType::class, $topo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($topo);
            $entityManager->flush();

            return $this->redirectToRoute('topo_index');
        }

        return $this->render('topo/new.html.twig', [
            'topo' => $topo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="topo_show", methods={"GET"})
     */
    public function show(Topo $topo): Response
    {
        return $this->render('topo/show.html.twig', [
            'topo' => $topo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="topo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Topo $topo): Response
    {
        $form = $this->createForm(TopoType::class, $topo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('topo_index');
        }

        return $this->render('topo/edit.html.twig', [
            'topo' => $topo,
            'form' => $form->createView(),
        ]);
    }

    /**
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
}
