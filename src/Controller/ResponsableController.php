<?php

namespace App\Controller;

use App\Entity\Affectation;
use App\Entity\Enseignant;
use App\Entity\Pfe;
use App\Entity\Responsable;
use App\Entity\Societe;
use App\Entity\User;
use App\Form\ResponsableType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/responsable")
 */
class ResponsableController extends AbstractController
{
    /**
     * @Route("/", name="responsable_index", methods={"GET"})
     */
    public function index(): Response
    {
        $responsables = $this->getDoctrine()
            ->getRepository(Responsable::class)
            ->findAll();
        $enseignant= $this->getDoctrine()
        ->getRepository(Enseignant::class)
        ->findAll();
        return $this->render('responsable/index.html.twig', [
            'responsables' => $responsables,
            'enseignant'=>$enseignant,
        ]);
    }


    /**
     * @Route("/recommandationPfeResponsable", name="recommandationPfeResponsable", methods={"GET"})
     */
    public function recommandationPfeResponsable(Request $request): Response
    {
        $session=$request->getSession();
        $a=$session->get("email");
        $user2=$this->getDoctrine()->getRepository(\App\Entity\User::class)->findOneBy(
            ['email' => $a],
        );

        /*   $CinEtudiants = $this->getDoctrine()
               ->getRepository(Affectation::class)
               ->AfficherEtudiantGererParchaqueEnseignant($user2->getCin());
        */

        $idEnseignant=$this->getDoctrine()->getRepository(Affectation::class)->getEnseignantId($a);
        $spe=$this->getDoctrine()->getRepository(Affectation::class)->selectionnerSpeEnseignant($idEnseignant);


        $nombredetudiantencadre=$this->getDoctrine()->getRepository(\App\Entity\Affectation::class)->NombreDetudiantsEncadreParEnseignant($idEnseignant);


        $etudiants=$this->getDoctrine()
            ->getRepository(Affectation::class)
            ->AfficherReommandationsEtudiantAencadrer();

        $enseignant=$this->getDoctrine()
            ->getRepository(User::class)
            ->findBy(array('email' => $a));

        $pfe=$this->getDoctrine()
            ->getRepository(Pfe::class)
            ->findAll();
        $societe=$this->getDoctrine()
            ->getRepository(Societe::class)
            ->findAll();
        return $this->render('responsable/recomandationPfe.html.twig', [
            'spe'=>$spe,
            'etudiants' => $etudiants,
            'enseignant'=>$enseignant,
            'pfe'=>$pfe,
            'societe'=>$societe,
            'nombredetudiantencadre'=>$nombredetudiantencadre,
        ]);
    }



    /**
     * @Route("/ListeEtudiant", name="GestionEtudiantEnseignantResponsable", methods={"GET"})
     */
    public function gestionEtudiantEnseignant(Request $request): Response
    {
        $session=$request->getSession();
        $a=$session->get("email");
        $user2=$this->getDoctrine()->getRepository(\App\Entity\User::class)->findOneBy(
            ['email' => $a],
        );

        /*   $CinEtudiants = $this->getDoctrine()
               ->getRepository(Affectation::class)
               ->AfficherEtudiantGererParchaqueEnseignant($user2->getCin());
        */

        $etudiants=$this->getDoctrine()
            ->getRepository(Affectation::class)
            ->AfficherEtudiantGererParchaqueEnseignant2($user2->getCin());

        $enseignant=$this->getDoctrine()
            ->getRepository(Enseignant::class)
            ->findAll();
        $pfe=$this->getDoctrine()
            ->getRepository(Pfe::class)
            ->findAll();
        $societe=$this->getDoctrine()
            ->getRepository(Societe::class)
            ->findAll();
        return $this->render('responsable/GestionEtudiantEnseignantResponsable.html.twig', [
            'etudiants' => $etudiants,
            'enseignant'=>$enseignant,
            'pfe'=>$pfe,
            'societe'=>$societe,
        ]);
    }
    /**
     * @Route("/new", name="responsable_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserRepository $userrep): Response
    {
        $responsable = new Responsable();
        $form = $this->createForm(ResponsableType::class, $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ChangerEtatUser=$userrep->ModifierEtatResponsable($responsable->getIdenseignant());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($responsable);
            $entityManager->flush();

            return $this->redirectToRoute('responsable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('responsable/new.html.twig', [
            'responsable' => $responsable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="responsable_show", methods={"GET"})
     */
    public function show(Responsable $responsable): Response
    {
        return $this->render('responsable/show.html.twig', [
            'responsable' => $responsable,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="responsable_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Responsable $responsable): Response
    {
        $form = $this->createForm(ResponsableType::class, $responsable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('responsable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('responsable/edit.html.twig', [
            'responsable' => $responsable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="responsable_delete", methods={"POST","GET"})
     */
    public function delete(Request $request): Response
    {
        $id = $request->get("id");
        $pfe = $this->getDoctrine()->getRepository(Responsable::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($pfe);
        $em->flush();


        return $this->redirectToRoute('responsable_index', [], Response::HTTP_SEE_OTHER);
    }
}
