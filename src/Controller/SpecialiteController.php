<?php

namespace App\Controller;

use App\Entity\Specialite;
use App\Entity\SpecialiteEnseignant;
use App\Form\SpecialiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specialite")
 */
class SpecialiteController extends AbstractController
{
    /**
     * @Route("/", name="specialite_index", methods={"GET"})
     */
    public function index(): Response
    {
        $specialites = $this->getDoctrine()
            ->getRepository(Specialite::class)
            ->findAll();

        return $this->render('specialite/index.html.twig', [
            'specialites' => $specialites,
        ]);
    }

    /**
     * @Route("/new", name="specialite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $specialite = new Specialite();
        $form = $this->createForm(SpecialiteType::class, $specialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $specialiteEnseignant= new SpecialiteEnseignant($specialite->getNom());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specialite);
            $entityManager->persist($specialiteEnseignant);

            $entityManager->flush();

            return $this->redirectToRoute('specialite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('specialite/new.html.twig', [
            'specialite' => $specialite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specialite_show", methods={"GET"})
     */
    public function show(Specialite $specialite): Response
    {
        return $this->render('specialite/show.html.twig', [
            'specialite' => $specialite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="specialite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Specialite $specialite): Response
    {
        $form = $this->createForm(SpecialiteType::class, $specialite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('specialite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('specialite/edit.html.twig', [
            'specialite' => $specialite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specialite_delete", methods={"POST"})
     */
    public function delete(Request $request, Specialite $specialite): Response
    {               $entityManager = $this->getDoctrine()->getManager();

        $id = $request->get("id");

        if ($this->isCsrfTokenValid('delete'.$specialite->getId(), $request->request->get('_token'))) {
            $speEnseignant=$entityManager->getRepository(SpecialiteEnseignant::class)->find($id);

            $entityManager->remove($speEnseignant);

            $entityManager->remove($specialite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('specialite_index', [], Response::HTTP_SEE_OTHER);
    }
}
