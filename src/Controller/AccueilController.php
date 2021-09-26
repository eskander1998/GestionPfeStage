<?php

namespace App\Controller;

use App\Entity\Affectation;
use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Form\AffectationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accueil")
 */
class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil_index", methods={"GET"})
     */
    public function index(): Response
    {
        $affectations = $this->getDoctrine()
            ->getRepository(Affectation::class)
            ->findAll();
        $etudiants = $this->getDoctrine()
            ->getRepository(Etudiant::class)
            ->findAll();
        $enseignants = $this->getDoctrine()
            ->getRepository(Enseignant::class)
            ->findAll();
        return $this->render('affectation/accueil.html.twig', [
            'affectations' => $affectations,
            'etudiants'=>$etudiants,
            'enseignants'=>$enseignants,

        ]);
    }


}
