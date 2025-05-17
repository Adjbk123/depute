<?php

namespace App\Controller;

use App\Entity\AffiliationPartiPolitique;
use App\Form\AffiliationPartiPolitiqueType;
use App\Repository\AffiliationPartiPolitiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/affiliation/parti/politique')]
class AffiliationPartiPolitiqueController extends AbstractController
{
    #[Route('/', name: 'app_affiliation_parti_politique_index', methods: ['GET'])]
    public function index(AffiliationPartiPolitiqueRepository $affiliationPartiPolitiqueRepository): Response
    {
        return $this->render('affiliation_parti_politique/index.html.twig', [
            'affiliation_parti_politiques' => $affiliationPartiPolitiqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_affiliation_parti_politique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $affiliationPartiPolitique = new AffiliationPartiPolitique();
        $form = $this->createForm(AffiliationPartiPolitiqueType::class, $affiliationPartiPolitique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($affiliationPartiPolitique);
            $entityManager->flush();

            return $this->redirectToRoute('app_affiliation_parti_politique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('affiliation_parti_politique/new.html.twig', [
            'affiliation_parti_politique' => $affiliationPartiPolitique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_affiliation_parti_politique_show', methods: ['GET'])]
    public function show(AffiliationPartiPolitique $affiliationPartiPolitique): Response
    {
        return $this->render('affiliation_parti_politique/show.html.twig', [
            'affiliation_parti_politique' => $affiliationPartiPolitique,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_affiliation_parti_politique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AffiliationPartiPolitique $affiliationPartiPolitique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AffiliationPartiPolitiqueType::class, $affiliationPartiPolitique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_affiliation_parti_politique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('affiliation_parti_politique/edit.html.twig', [
            'affiliation_parti_politique' => $affiliationPartiPolitique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_affiliation_parti_politique_delete', methods: ['POST'])]
    public function delete(Request $request, AffiliationPartiPolitique $affiliationPartiPolitique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$affiliationPartiPolitique->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($affiliationPartiPolitique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_affiliation_parti_politique_index', [], Response::HTTP_SEE_OTHER);
    }
}
