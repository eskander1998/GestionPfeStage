<?php

namespace App\Controller;

use App\Entity\Affectation;
use App\Entity\Etudiant;
use App\Entity\Pfe;
use App\Entity\Specialite;
use App\Form\PfeType;
use DateInterval;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pfe")
 */
class PfeController extends AbstractController
{
    /**
     * @Route("/", name="pfe_index", methods={"GET"})
     */
    public function index(): Response
    {
        $pves = $this->getDoctrine()
            ->getRepository(Pfe::class)
            ->findAll();
        $etudiant= $this->getDoctrine()
            ->getRepository(Etudiant::class)
            ->findAll();
        return $this->render('pfe/index.html.twig', [
            'pves' => $pves,
            'etudiant' =>$etudiant,
        ]);
    }


    /**
     * @Route("/new", name="pfe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pfe = new Pfe();

        $form = $this->createForm(PfeType::class, $pfe);
    //    $form = $this->createForm(PfeType::class);
        $form->handleRequest($request);
$a=1;

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();



            if($a==1)
            {


                $oldDate = $pfe->getDateDebut()->format('Y-m-d');
                $dateDebut1 = new DateTime($oldDate);
                $dateDebut2 = new DateTime($oldDate);
                $dateDebut3 = new DateTime($oldDate);
                $dateDebut4 = new DateTime($oldDate);

                $valid1=$dateDebut1->add(new DateInterval('P21D')); // P1D means a period of 1 day
                $valid2=$dateDebut2->add(new DateInterval('P42D'));
                $valid3=$dateDebut3->add(new DateInterval('P98D'));
                $valid4=$dateDebut4->add(new DateInterval('P161D'));

    $pfe->setValidation1($valid1);
    $pfe->setValidation2($valid2);
    $pfe->setValidation3($valid3);
    $pfe->setValidation4($valid4);

    $pfe->setEtat('non affecte');
    $entityManager->persist($pfe);
    $entityManager->flush();
    return $this->redirectToRoute('pfe_index', [], Response::HTTP_SEE_OTHER);
            }
            else{
                echo "<script type =\"text/javascript\">
                    alert(\"year=!  \);
                    </script>";
            }

        }
        return $this->render('pfe/new.html.twig', [
            'pfe' => $pfe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pfe_show_enseignant", methods={"GET"})
     */
    public function showEnseignant(Pfe $pfe): Response
    {
        return $this->render('pfe/showEnseignant.html.twig', [
            'pfe' => $pfe,
        ]);
    }
    /**
     * @Route("/{id}", name="pfe_show", methods={"GET"})
     */
    public function show(Pfe $pfe): Response
    {
        return $this->render('pfe/show.html.twig', [
            'pfe' => $pfe,
        ]);
    }
    /**
     * @Route("/{id}/edit", name="pfe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pfe $pfe): Response
    {
        $form = $this->createForm(PfeType::class, $pfe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pfe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pfe/edit.html.twig', [
            'pfe' => $pfe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="pfe_delete",methods={"GET","POST"})
     */
    public function delete(Request $request): Response
    {

        $id = $request->get("id");
        $pfe = $this->getDoctrine()->getRepository(Pfe::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($pfe);
        $em->flush();


        return $this->redirectToRoute('pfe_index', [], Response::HTTP_SEE_OTHER);
    }

}
