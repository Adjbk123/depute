<?php

namespace App\Controller;

use App\Entity\DeputeGroupeParlementaire;
use App\Form\DeputeGroupeParlementaireType;
use App\Repository\DeputeGroupeParlementaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/depute/groupe/parlementaire')]
class DeputeGroupeParlementaireController extends AbstractController
{
    #[Route('/', name: 'app_depute_groupe_parlementaire_index', methods: ['GET'])]
    public function index(DeputeGroupeParlementaireRepository $deputeGroupeParlementaireRepository): Response
    {
        return $this->render('depute_groupe_parlementaire/index.html.twig', [
            'depute_groupe_parlementaires' => $deputeGroupeParlementaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_depute_groupe_parlementaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $deputeGroupeParlementaire = new DeputeGroupeParlementaire();
        $form = $this->createForm(DeputeGroupeParlementaireType::class, $deputeGroupeParlementaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($deputeGroupeParlementaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_depute_groupe_parlementaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depute_groupe_parlementaire/new.html.twig', [
            'depute_groupe_parlementaire' => $deputeGroupeParlementaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depute_groupe_parlementaire_show', methods: ['GET'])]
    public function show(DeputeGroupeParlementaire $deputeGroupeParlementaire): Response
    {
        return $this->render('depute_groupe_parlementaire/show.html.twig', [
            'depute_groupe_parlementaire' => $deputeGroupeParlementaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_depute_groupe_parlementaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DeputeGroupeParlementaire $deputeGroupeParlementaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DeputeGroupeParlementaireType::class, $deputeGroupeParlementaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_depute_groupe_parlementaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('depute_groupe_parlementaire/edit.html.twig', [
            'depute_groupe_parlementaire' => $deputeGroupeParlementaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_depute_groupe_parlementaire_delete', methods: ['POST'])]
    public function delete(Request $request, DeputeGroupeParlementaire $deputeGroupeParlementaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$deputeGroupeParlementaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($deputeGroupeParlementaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_depute_groupe_parlementaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
