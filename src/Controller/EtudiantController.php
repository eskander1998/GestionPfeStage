<?php

namespace App\Controller;

use App\Entity\Affectation;
use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Pfe;
use App\Entity\Societe;
use App\Entity\User;
use App\Form\EtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/etudiant")
 */
class EtudiantController extends AbstractController
{
    /**
     * @Route("/", name="etudiant_index", methods={"GET"})
     */
    public function index(): Response
    {
        $etudiants = $this->getDoctrine()
            ->getRepository(Etudiant::class)
            ->findAll();
        $enseignant=$this->getDoctrine()
            ->getRepository(Enseignant::class)
            ->findAll();
        $pfe=$this->getDoctrine()
            ->getRepository(Pfe::class)
            ->findAll();
        $societe=$this->getDoctrine()
            ->getRepository(Societe::class)
            ->findAll();
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
            'enseignant'=>$enseignant,
            'pfe'=>$pfe,
            'societe'=>$societe,
        ]);
    }

    /**
     * @Route("/ListeEtudiant", name="gestionEtudiantEnseignant", methods={"GET"})
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
        return $this->render('etudiant/GestionEtudiantEnseignant.html.twig', [
            'etudiants' => $etudiants,
            'enseignant'=>$enseignant,
            'pfe'=>$pfe,
            'societe'=>$societe,
        ]);
    }


    /**
     * @Route("/{sujet}/validationsDeLetudiantEnseignant", name="validationsDeLetudiantEnseignant", methods={"GET"})
     */
    public function validationsDeLetudiantEnseignant(Request $request): Response
    {
        $id = $request->get("sujet");

        $AfficherValidationEnseignant=$this->getDoctrine()
            ->getRepository(Pfe::class)
            ->AfficherValidationEnseignant($id);
        return $this->render('etudiant/ValidationEtudiantEnseignant.html.twig', [
            'AfficherValidationEnseignant' => $AfficherValidationEnseignant,

        ]);
    }

    /**
     * @Route("/new", name="etudiant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $dateJour = new \DateTime();
            $etudiant->setEtat('non affecte');
            $etudiant->setDateAjout($dateJour);
            $entityManager->persist($etudiant);
            $entityManager->flush();

            return $this->redirectToRoute('etudiant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etudiant/new.html.twig', [
            'etudiant' => $etudiant,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etudiant_show", methods={"GET"})
     */
    public function show(Etudiant $etudiant): Response
    {
        return $this->render('etudiant/show.html.twig', [
            'etudiant' => $etudiant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etudiant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Etudiant $etudiant): Response
    {
        $id = $request->get("id");
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

$etudiantt=$this->getDoctrine()
    ->getRepository(Etudiant::class)
    ->findOneBy( ['id' => $id]
    );
        $user=$this->getDoctrine()
            ->getRepository(User::class)
            ->findAll();

        $entityObject = $form->get('filiere')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etudiant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etudiant/edit.html.twig', [
            'etudiant' => $etudiant,
            'etudiantt'=>$etudiantt,
            'form' => $form->createView(),
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="etudiant_delete", methods={"GET","POST"})
     */
    public function delete(Request $request): Response
    {
        $id = $request->get("id");
        $pfe = $this->getDoctrine()->getRepository(Etudiant::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($pfe);
        $em->flush();


        return $this->redirectToRoute('etudiant_index', [], Response::HTTP_SEE_OTHER);
    }

}
