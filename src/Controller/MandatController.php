<?php

namespace App\Controller;

use App\Entity\Mandat;
use App\Form\MandatType;
use App\Repository\MandatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/mandat')]
class MandatController extends AbstractController
{
    #[Route('/', name: 'app_mandat_index', methods: ['GET'])]
    public function index(MandatRepository $mandatRepository): Response
    {
        return $this->render('mandat/index.html.twig', [
            'mandats' => $mandatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mandat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mandat = new Mandat();
        $form = $this->createForm(MandatType::class, $mandat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mandat);
            $entityManager->flush();

            return $this->redirectToRoute('app_mandat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mandat/new.html.twig', [
            'mandat' => $mandat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mandat_show', methods: ['GET'])]
    public function show(Mandat $mandat): Response
    {
        return $this->render('mandat/show.html.twig', [
            'mandat' => $mandat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mandat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mandat $mandat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MandatType::class, $mandat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_mandat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('mandat/edit.html.twig', [
            'mandat' => $mandat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mandat_delete', methods: ['POST'])]
    public function delete(Request $request, Mandat $mandat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mandat->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($mandat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_mandat_index', [], Response::HTTP_SEE_OTHER);
    }
}
