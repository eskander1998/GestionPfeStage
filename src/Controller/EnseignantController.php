<?php

namespace App\Controller;

use App\Entity\Affectation;
use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Pfe;
use App\Entity\Societe;
use App\Entity\User;
use App\Form\EnseignantType;
use App\Form\UserType;
use App\Repository\EnseignantRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/enseignant")
 */
class EnseignantController extends AbstractController
{
    /**
     * @Route("/", name="enseignant_index", methods={"GET"})
     */
    public function index(): Response
    {
        $enseignants = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy(array('type' => 'enseignant'));

        return $this->render('enseignant/index.html.twig', [
            'enseignants' => $enseignants,
        ]);
    }

    /**
     * @Route("/recommandationPfe", name="recommandationPfe", methods={"GET"})
     */
    public function recommandationPfe(Request $request): Response
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

        $nombredetudiantencadre=$this->getDoctrine()->getRepository(\App\Entity\Affectation::class)->NombreDetudiantsEncadreParEnseignant($user2->getCin());


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
        return $this->render('enseignant/recomandationPfe.html.twig', [
            'spe'=>$spe,
            'etudiants' => $etudiants,
            'enseignant'=>$enseignant,
            'pfe'=>$pfe,
            'societe'=>$societe,
            'nombredetudiantencadre'=>$nombredetudiantencadre,

        ]);
    }

    /**
     * @Route("/new", name="enseignant_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserRepository $userrep): Response
    {
        $enseignant = new User(0,"","","","","","");

        $form = $this->createForm(UserType::class, $enseignant);
        $form->handleRequest($request);

        $cin=$enseignant->getCin();
        $email=$enseignant->getEmail();
        $nom=$enseignant->getNom();
        $prenom=$enseignant->getPrenom();
        $pass=$enseignant->getPassword();
        $type='enseignant';
        $etat='inscrit';

        if ($form->isSubmitted() && $form->isValid()) {
           // $user = new User($cin,$email,$nom,$prenom,$pass,$type,$etat);
            $enseignant->setType("enseignant");
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enseignant);
          //  $entityManager->persist($user);

            $entityManager->flush();

            return $this->redirectToRoute('enseignant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('enseignant/new.html.twig', [
            'enseignant' => $enseignant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enseignant_show", methods={"GET"})
     */
    public function show(User $enseignant): Response
    {
        return $this->render('enseignant/show.html.twig', [
            'enseignant' => $enseignant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enseignant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $enseignant): Response
    {
        $form = $this->createForm(UserType::class, $enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enseignant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('enseignant/edit.html.twig', [
            'enseignant' => $enseignant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enseignant_delete", methods={"POST"})
     */
    public function delete(Request $request, User $enseignant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseignant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enseignant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enseignant_index', [], Response::HTTP_SEE_OTHER);
    }
}
