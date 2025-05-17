<?php

namespace App\Controller;

use App\Entity\Legislature;
use App\Repository\GroupeParlementaireRepository;
use App\Repository\LegislatureRepository;
use App\Repository\MandatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(LegislatureRepository $legislatureRepository, MandatRepository $mandatRepository, GroupeParlementaireRepository $groupeParlementaireRepository): Response
    {


        $legislatures = $legislatureRepository->findAll();

        // Récupérer la dernière législature en cours
        $legislatureEnCours = $legislatureRepository->findOneBy([], ['dateDebut' => 'DESC']);


        if (!$legislatureEnCours) {
            throw $this->createNotFoundException('Aucune législature en cours trouvée.');
        }

        // Récupérer les groupes parlementaires associés à cette législature
        $groupesParlementaires = $groupeParlementaireRepository->findBy(['legislature' => $legislatureEnCours]);


        $mandatsParGroupes = [];
        foreach ($groupesParlementaires as $groupeParlementaire) {
            $mandats = $groupeParlementaire->getMandats(); // Supposons que cette méthode existe dans l'entité GroupeParlementaire

            // Pour chaque mandat, récupérer les candidats
            $mandatsParGroupes[$groupeParlementaire->getLibelle()] = $mandats;


        }

        return $this->render('accueil/index.html.twig', [
            'legislatures' => $legislatures,
            'mandatsParGroupes' => $mandatsParGroupes,

        ]);
    }
    #[Route('/legislature/{id}/depute', name: 'app_legislature_depute')]
    public function indexLegislatureDepute(LegislatureRepository $legislatureRepository, MandatRepository $mandatRepository, GroupeParlementaireRepository $groupeParlementaireRepository, Legislature $legislature): Response
    {

        $legislatures = $legislatureRepository->findAll();


        // Récupérer les groupes parlementaires associés à cette législature
        $groupesParlementaires = $groupeParlementaireRepository->findBy(['legislature' => $legislature]);


        $mandatsParGroupes = [];
        foreach ($groupesParlementaires as $groupeParlementaire) {
            $mandats = $groupeParlementaire->getMandats(); // Supposons que cette méthode existe dans l'entité GroupeParlementaire

            // Pour chaque mandat, récupérer les candidats
            $mandatsParGroupes[$groupeParlementaire->getLibelle()] = $mandats;


        }

        return $this->render('accueil/indexLegislature.html.twig', [
            'legislatures' => $legislatures,
            'mandatsParGroupes' => $mandatsParGroupes,
            'legislatureAffichee' => $legislature,

        ]);
    }
    #[Route('/menu', name: 'app_menu_legislature')]
    public function menuLegislature(LegislatureRepository $legislatureRepository): Response
    {
        // Récupérer les législatures depuis la base de données
        $legislatures = $legislatureRepository->findAll();

        return $this->render('partials/landing/header.html.twig', [
            'legislatures' => $legislatures,
        ]);
    }
}
