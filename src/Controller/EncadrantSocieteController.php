<?php

namespace App\Controller;

use App\Entity\EncadrantSociete;
use App\Form\EncadrantSocieteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/encadrant/societe")
 */
class EncadrantSocieteController extends AbstractController
{
    /**
     * @Route("/", name="encadrant_societe_index", methods={"GET"})
     */
    public function index(): Response
    {
        $encadrantSocietes = $this->getDoctrine()
            ->getRepository(EncadrantSociete::class)
            ->findAll();

        return $this->render('encadrant_societe/index.html.twig', [
            'encadrant_societes' => $encadrantSocietes,
        ]);
    }

    /**
     * @Route("/new", name="encadrant_societe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $encadrantSociete = new EncadrantSociete();
        $form = $this->createForm(EncadrantSocieteType::class, $encadrantSociete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($encadrantSociete);
            $entityManager->flush();

            return $this->redirectToRoute('encadrant_societe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('encadrant_societe/new.html.twig', [
            'encadrant_societe' => $encadrantSociete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="encadrant_societe_show", methods={"GET"})
     */
    public function show(EncadrantSociete $encadrantSociete): Response
    {
        return $this->render('encadrant_societe/show.html.twig', [
            'encadrant_societe' => $encadrantSociete,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="encadrant_societe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EncadrantSociete $encadrantSociete): Response
    {
        $form = $this->createForm(EncadrantSocieteType::class, $encadrantSociete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('encadrant_societe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('encadrant_societe/edit.html.twig', [
            'encadrant_societe' => $encadrantSociete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="encadrant_societe_delete", methods={"POST"})
     */
    public function delete(Request $request, EncadrantSociete $encadrantSociete): Response
    {
        if ($this->isCsrfTokenValid('delete'.$encadrantSociete->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($encadrantSociete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('encadrant_societe_index', [], Response::HTTP_SEE_OTHER);
    }
}
