<?php

namespace App\Controller;

use App\Entity\Affectation;
use App\Entity\Enseignant;
use App\Entity\Etudiant;

use App\Entity\Pfe;
use App\Form\AffectationType;
use App\Repository\AffectationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/affectation")
 */
class AffectationController extends AbstractController
{
    /**
     * @Route("/", name="affectation_index", methods={"GET"})
     */
    public function index(): Response
    {
        $affectations = $this->getDoctrine()
            ->getRepository(Affectation::class)
            ->findAll();
        $etudiant = $this->getDoctrine()
            ->getRepository(Etudiant::class)
            ->findAll();
        $enseignants = $this->getDoctrine()
            ->getRepository(Enseignant::class)
            ->findAll();
        return $this->render('affectation/index.html.twig', [
            'affectations' => $affectations,
            'etudiant'=>$etudiant,
            'enseignants'=>$enseignants,

        ]);
    }

    /**
     * @Route ("/recommandations",name="RecommandationResponsable", methods={"GET"})
     */
    public function recommandations(): Response
    {
        $Pfe = $this->getDoctrine()
            ->getRepository(Affectation::class)
            ->AfficherReommandationsEtudiantAencadrer();

        $etudiant = $this->getDoctrine()
            ->getRepository(Etudiant::class)
            ->findAll();
        $enseignants = $this->getDoctrine()
            ->getRepository(Enseignant::class)
            ->findAll();
        return $this->render('affectation/index.html.twig', [
            'Pfe' => $Pfe,
            'etudiant'=>$etudiant,
            'enseignants'=>$enseignants,

        ]);
    }

    /**
     * @Route("/new", name="affectation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $affectation = new Affectation();
        $form = $this->createForm(AffectationType::class, $affectation);
        $form->handleRequest($request);

        $idetudiant=$affectation->getIdEtudiant();
        $idenseignant=$affectation->getIdEnseignant();
        $sujetpfe=$affectation->getIdPfe();

        $AffectationEtudiant =$this->getDoctrine()->getRepository(Affectation::class)
            ->AffectationPfeEtdudiant($idetudiant,$idenseignant,$sujetpfe);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            if($affectation->getIdEnseignant()!='')
            {
                $etudiant=$entityManager->getRepository(Etudiant::class)->ChangerEtatEtudiant($idetudiant);

            }
            $pfe=$entityManager->getRepository(Pfe::class)->ChangerPfe($sujetpfe);
            $ChangerIdEtudiantDansPfe=$entityManager->getRepository(Affectation::class)
                ->ChangerIdEtudiantDansPfe($affectation->getIdEtudiant(),$affectation->getIdPfe());
            $entityManager->persist($affectation);

            $entityManager->flush();

            return $this->redirectToRoute('affectation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('affectation/new.html.twig', [
            'affectation' => $affectation,
            'AffectationEtudiant'=> $AffectationEtudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="affectation_show", methods={"GET"})
     */
    public function show(Affectation $affectation): Response
    {
        return $this->render('affectation/show.html.twig', [
            'affectation' => $affectation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="affectation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Affectation $affectation): Response
    {
        $form = $this->createForm(AffectationType::class, $affectation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('affectation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('affectation/edit.html.twig', [
            'affectation' => $affectation,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{idEtudiant}/{sujetPfee}/AffectationRecommandation", name="AffectationRecommandation", methods={"GET","POST"})
     */
    public function AffectationRecommandation(Request $request): Response
    {
        $affectation = new Affectation();
        $session=$request->getSession();
        $a=$session->get("email");
        $user2=$this->getDoctrine()->getRepository(\App\Entity\User::class)->findOneBy(
            ['email' => $a],
        );

        $idEtudiant = $request->get("idEtudiant");
        $idEnseignant = $user2->getCin();
        $sujetPfe = $request->get("sujetPfee");

        $AffectationEtudiant =$this->getDoctrine()->getRepository(Affectation::class)
            ->AffectationPfeEtdudiant($idEtudiant,$idEnseignant,$sujetPfe);


        $etudiant=$this->getDoctrine()->getRepository(Etudiant::class)->ChangerEtatEtudiant($idEtudiant);


            $pfe=$this->getDoctrine()->getRepository(Pfe::class)->ChangerPfe($sujetPfe);
            $ChangerIdEtudiantDansPfe=$this->getDoctrine()->getRepository(Affectation::class)
                ->ChangerIdEtudiantDansPfe($affectation->getIdEtudiant(),$affectation->getIdPfe());
        $this->getDoctrine()->getManager()->persist($affectation);

        $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gestionEtudiantEnseignant', [], Response::HTTP_SEE_OTHER);


    }

    /**
     * @Route("/{id}", name="affectation_delete", methods={"POST"})
     */
    public function delete(Request $request, Affectation $affectation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$affectation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($affectation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('affectation_index', [], Response::HTTP_SEE_OTHER);
    }
}
