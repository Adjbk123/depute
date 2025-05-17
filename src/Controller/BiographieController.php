<?php

namespace App\Controller;

use App\Entity\Biographie;
use App\Form\BiographieType;
use App\Repository\BiographieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/biographie')]
class BiographieController extends AbstractController
{
    #[Route('/', name: 'app_biographie_index', methods: ['GET'])]
    public function index(BiographieRepository $biographieRepository): Response
    {
        return $this->render('biographie/index.html.twig', [
            'biographies' => $biographieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_biographie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $biographie = new Biographie();
        $form = $this->createForm(BiographieType::class, $biographie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($biographie);
            $entityManager->flush();

            return $this->redirectToRoute('app_biographie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('biographie/new.html.twig', [
            'biographie' => $biographie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_biographie_show', methods: ['GET'])]
    public function show(Biographie $biographie): Response
    {
        return $this->render('biographie/show.html.twig', [
            'biographie' => $biographie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_biographie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Biographie $biographie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BiographieType::class, $biographie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_biographie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('biographie/edit.html.twig', [
            'biographie' => $biographie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_biographie_delete', methods: ['POST'])]
    public function delete(Request $request, Biographie $biographie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$biographie->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($biographie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_biographie_index', [], Response::HTTP_SEE_OTHER);
    }
}
