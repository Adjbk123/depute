<?php

namespace App\Controller;

use App\Entity\GroupeParlementaire;
use App\Form\GroupeParlementaireType;
use App\Repository\GroupeParlementaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/groupe/parlementaire')]
class GroupeParlementaireController extends AbstractController
{
    #[Route('/', name: 'app_groupe_parlementaire_index', methods: ['GET'])]
    public function index(GroupeParlementaireRepository $groupeParlementaireRepository): Response
    {
        return $this->render('groupe_parlementaire/index.html.twig', [
            'groupe_parlementaires' => $groupeParlementaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_groupe_parlementaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $groupeParlementaire = new GroupeParlementaire();
        $form = $this->createForm(GroupeParlementaireType::class, $groupeParlementaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($groupeParlementaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_groupe_parlementaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('groupe_parlementaire/new.html.twig', [
            'groupe_parlementaire' => $groupeParlementaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_groupe_parlementaire_show', methods: ['GET'])]
    public function show(GroupeParlementaire $groupeParlementaire): Response
    {
        return $this->render('groupe_parlementaire/show.html.twig', [
            'groupe_parlementaire' => $groupeParlementaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_groupe_parlementaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GroupeParlementaire $groupeParlementaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GroupeParlementaireType::class, $groupeParlementaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_groupe_parlementaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('groupe_parlementaire/edit.html.twig', [
            'groupe_parlementaire' => $groupeParlementaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_groupe_parlementaire_delete', methods: ['POST'])]
    public function delete(Request $request, GroupeParlementaire $groupeParlementaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupeParlementaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($groupeParlementaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_groupe_parlementaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
