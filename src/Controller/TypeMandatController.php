<?php

namespace App\Controller;

use App\Entity\TypeMandat;
use App\Form\TypeMandatType;
use App\Repository\TypeMandatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/type/mandat')]
class TypeMandatController extends AbstractController
{
    #[Route('/', name: 'app_type_mandat_index', methods: ['GET'])]
    public function index(TypeMandatRepository $typeMandatRepository): Response
    {
        return $this->render('type_mandat/index.html.twig', [
            'type_mandats' => $typeMandatRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_mandat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeMandat = new TypeMandat();
        $form = $this->createForm(TypeMandatType::class, $typeMandat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeMandat);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_mandat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_mandat/new.html.twig', [
            'type_mandat' => $typeMandat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_mandat_show', methods: ['GET'])]
    public function show(TypeMandat $typeMandat): Response
    {
        return $this->render('type_mandat/show.html.twig', [
            'type_mandat' => $typeMandat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_mandat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeMandat $typeMandat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeMandatType::class, $typeMandat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_mandat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_mandat/edit.html.twig', [
            'type_mandat' => $typeMandat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_mandat_delete', methods: ['POST'])]
    public function delete(Request $request, TypeMandat $typeMandat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeMandat->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typeMandat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_mandat_index', [], Response::HTTP_SEE_OTHER);
    }
}
