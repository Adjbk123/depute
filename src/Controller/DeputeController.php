<?php

namespace App\Controller;

use App\Entity\Depute;
use App\Form\DeputeType;
use App\Repository\DeputeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/depute')]
class DeputeController extends AbstractController
{
    #[Route('/', name: 'app_depute_index', methods: ['GET'])]
    public function index(DeputeRepository $deputeRepository): Response
    {
        return $this->render('depute/index.html.twig', [
            'deputes' => $deputeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_depute_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $depute = new Depute();
        $form = $this->createForm(DeputeType::class, $depute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($depute);
            $entityManager->flush();

            return $this->redirectToRoute('app_depute_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depute/new.html.twig', [
            'depute' => $depute,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depute_show', methods: ['GET'])]
    public function show(Depute $depute): Response
    {
        return $this->render('depute/show.html.twig', [
            'depute' => $depute,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_depute_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Depute $depute, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeputeType::class, $depute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_depute_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depute/edit.html.twig', [
            'depute' => $depute,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depute_delete', methods: ['POST'])]
    public function delete(Request $request, Depute $depute, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$depute->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($depute);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_depute_index', [], Response::HTTP_SEE_OTHER);
    }
}
