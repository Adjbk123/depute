<?php

namespace App\Controller;

use App\Entity\Suppleant;
use App\Form\SuppleantType;
use App\Repository\SuppleantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/suppleant')]
class SuppleantController extends AbstractController
{
    #[Route('/', name: 'app_suppleant_index', methods: ['GET'])]
    public function index(SuppleantRepository $suppleantRepository): Response
    {
        return $this->render('suppleant/index.html.twig', [
            'suppleants' => $suppleantRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_suppleant_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $suppleant = new Suppleant();
        $form = $this->createForm(SuppleantType::class, $suppleant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($suppleant);
            $entityManager->flush();

            return $this->redirectToRoute('app_suppleant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('suppleant/new.html.twig', [
            'suppleant' => $suppleant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_suppleant_show', methods: ['GET'])]
    public function show(Suppleant $suppleant): Response
    {
        return $this->render('suppleant/show.html.twig', [
            'suppleant' => $suppleant,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_suppleant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Suppleant $suppleant, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SuppleantType::class, $suppleant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_suppleant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('suppleant/edit.html.twig', [
            'suppleant' => $suppleant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_suppleant_delete', methods: ['POST'])]
    public function delete(Request $request, Suppleant $suppleant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$suppleant->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($suppleant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_suppleant_index', [], Response::HTTP_SEE_OTHER);
    }
}
