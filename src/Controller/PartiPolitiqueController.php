<?php

namespace App\Controller;

use App\Entity\PartiPolitique;
use App\Form\PartiPolitiqueType;
use App\Repository\PartiPolitiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/parti/politique')]
class PartiPolitiqueController extends AbstractController
{
    #[Route('/', name: 'app_parti_politique_index', methods: ['GET'])]
    public function index(PartiPolitiqueRepository $partiPolitiqueRepository): Response
    {
        return $this->render('parti_politique/index.html.twig', [
            'parti_politiques' => $partiPolitiqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parti_politique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $partiPolitique = new PartiPolitique();
        $form = $this->createForm(PartiPolitiqueType::class, $partiPolitique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['photo']->getData();
            if ($file){
                $directory = "uploads";
                $nomFichier= $file->getClientOriginalName();
                $file->move($directory, $nomFichier);
                $partiPolitique->setPhoto($nomFichier);

            }


            $entityManager->persist($partiPolitique);
            $entityManager->flush();

            return $this->redirectToRoute('app_parti_politique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parti_politique/new.html.twig', [
            'parti_politique' => $partiPolitique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parti_politique_show', methods: ['GET'])]
    public function show(PartiPolitique $partiPolitique): Response
    {
        return $this->render('parti_politique/show.html.twig', [
            'parti_politique' => $partiPolitique,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parti_politique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PartiPolitique $partiPolitique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PartiPolitiqueType::class, $partiPolitique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form['photo']->getData();

            if ($file != null){
                $directory = "uploads";
                $nomFichier= $file->getClientOriginalName();
                $file->move($directory, $nomFichier);
                $partiPolitique->setPhoto($nomFichier);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_parti_politique_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parti_politique/edit.html.twig', [
            'parti_politique' => $partiPolitique,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parti_politique_delete', methods: ['POST'])]
    public function delete(Request $request, PartiPolitique $partiPolitique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partiPolitique->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($partiPolitique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parti_politique_index', [], Response::HTTP_SEE_OTHER);
    }
}
