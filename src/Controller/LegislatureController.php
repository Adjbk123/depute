<?php

namespace App\Controller;

use App\Entity\Legislature;
use App\Form\LegislatureType;
use App\Repository\LegislatureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/legislature')]
class LegislatureController extends AbstractController
{
    #[Route('/', name: 'app_legislature_index', methods: ['GET'])]
    public function index(LegislatureRepository $legislatureRepository): Response
    {
        return $this->render('legislature/index.html.twig', [
            'legislatures' => $legislatureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_legislature_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $legislature = new Legislature();
        $form = $this->createForm(LegislatureType::class, $legislature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($legislature);
            $entityManager->flush();

            return $this->redirectToRoute('app_legislature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('legislature/new.html.twig', [
            'legislature' => $legislature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_legislature_show', methods: ['GET'])]
    public function show(Legislature $legislature): Response
    {
        return $this->render('legislature/show.html.twig', [
            'legislature' => $legislature,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_legislature_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Legislature $legislature, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LegislatureType::class, $legislature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_legislature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('legislature/edit.html.twig', [
            'legislature' => $legislature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_legislature_delete', methods: ['POST'])]
    public function delete(Request $request, Legislature $legislature, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$legislature->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($legislature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_legislature_index', [], Response::HTTP_SEE_OTHER);
    }
}
