<?php

namespace App\Controller;

use App\Entity\Expert;
use App\Form\ExpertType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/expert")
 */
class ExpertController extends AbstractController
{
    /**
     * @Route("/", name="expert_index", methods={"GET"})
     */
    public function index(): Response
    {
        $experts = $this->getDoctrine()
            ->getRepository(Expert::class)
            ->findAll();

        return $this->render('expert/index.html.twig', [
            'experts' => $experts,
        ]);
    }

    /**
     * @Route("/new", name="expert_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $expert = new Expert();
        $form = $this->createForm(ExpertType::class, $expert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($expert);
            $entityManager->flush();

            return $this->redirectToRoute('expert_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('expert/new.html.twig', [
            'expert' => $expert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expert_show", methods={"GET"})
     */
    public function show(Expert $expert): Response
    {
        return $this->render('expert/show.html.twig', [
            'expert' => $expert,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="expert_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Expert $expert): Response
    {
        $form = $this->createForm(ExpertType::class, $expert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expert_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('expert/edit.html.twig', [
            'expert' => $expert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="expert_delete", methods={"POST"})
     */
    public function delete(Request $request, Expert $expert): Response
    {
        if ($this->isCsrfTokenValid('delete'.$expert->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($expert);
            $entityManager->flush();
        }

        return $this->redirectToRoute('expert_index', [], Response::HTTP_SEE_OTHER);
    }
}
