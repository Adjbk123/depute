<?php

namespace App\Controller;

use App\Repository\DeputeRepository;
use App\Repository\GroupeParlementaireRepository;
use App\Repository\LegislatureRepository;
use App\Repository\MandatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(
        DeputeRepository $deputeRepository,
        LegislatureRepository $legislatureRepository,
        GroupeParlementaireRepository $groupeParlementaireRepository,
        MandatRepository $mandatRepository

    ): Response
    {
        // Nombre total de députés
        $nbDeputes = $deputeRepository->count([]);

        // Nombre total de législatures
        $nbLegislatures = $legislatureRepository->count([]);

        // Récupérer toutes les législatures
        $legislatures = $legislatureRepository->findAll();

  // Initialiser un tableau pour stocker le nombre de députés par législature
        $deputesParLegislature = [];

     // Parcourir chaque législature
        foreach ($legislatures as $legislature) {
            // Récupérer les mandats pour cette législature (en supposant que vous avez une méthode getMandats dans l'entité Législature)
            $mandats = $legislature->getMandats();

            // Initialiser un tableau pour compter les députés uniques
            $deputesUniques = [];

            // Parcourir les mandats pour compter les députés uniques
            foreach ($mandats as $mandat) {
                // Récupérer le député associé à ce mandat (en supposant que vous avez une méthode getDepute dans l'entité Mandat)
                $depute = $mandat->getDepute();

                // Vérifier si le député n'est pas déjà compté pour cette législature
                if ($depute && !in_array($depute->getId(), $deputesUniques)) {
                    $deputesUniques[] = $depute->getId();
                }
            }

            // Stocker le nombre de députés uniques pour cette législature dans le tableau
            $deputesParLegislature[$legislature->getLibelle()] = count($deputesUniques);
        }

        // Récupérer tous les groupes parlementaires
        $groupesParlementaires = $groupeParlementaireRepository->findAll();

// Initialiser un tableau pour stocker le nombre de députés par groupe parlementaire
        $deputesParGroupeParlementaire = [];

// Parcourir chaque groupe parlementaire
        foreach ($groupesParlementaires as $groupeParlementaire) {
            // Récupérer les mandats pour ce groupe parlementaire (en supposant que vous avez une méthode getMandats dans l'entité GroupeParlementaire)
            $mandats = $groupeParlementaire->getMandats();

            // Initialiser un tableau pour compter les députés uniques
            $deputesUniques = [];

            // Parcourir les mandats pour compter les députés uniques
            foreach ($mandats as $mandat) {
                // Récupérer le député associé à ce mandat (en supposant que vous avez une méthode getDepute dans l'entité Mandat)
                $depute = $mandat->getDepute();

                // Vérifier si le député n'est pas déjà compté pour ce groupe parlementaire
                if ($depute && !in_array($depute->getId(), $deputesUniques)) {
                    $deputesUniques[] = $depute->getId();
                }
            }

            // Stocker le nombre de députés uniques pour ce groupe parlementaire dans le tableau
            $deputesParGroupeParlementaire[$groupeParlementaire->getLibelle()] = count($deputesUniques);
        }


        // Nombre de mandats en cours (avec date de fin non renseignée)
        $mandatsEnCours = $mandatRepository->findBy(['finMandat' => null]);
        $nbMandatsEnCours = count($mandatsEnCours);

        // Répartition par genre des députés (hypothétique)
        // À adapter en fonction de votre modèle de données
        $nbDeputesHommes = $deputeRepository->count(['genre' => 'M']);
        $nbDeputesFemmes = $deputeRepository->count(['genre' => 'F']);


        return $this->render('admin/index.html.twig', [
            'nbDeputes' => $nbDeputes,
            'nbLegislatures' => $nbLegislatures,
            'deputesParLegislature' => $deputesParLegislature,
            'deputesParGroupeParlementaire' => $deputesParGroupeParlementaire,
            'nbMandatsEnCours' => $nbMandatsEnCours,
            'nbDeputesHommes' => $nbDeputesHommes,
            'nbDeputesFemmes' => $nbDeputesFemmes,
        ]);
    }
}
