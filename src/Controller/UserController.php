<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;


/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy(array('type' => 'client'));

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * @Route("/accueilAdmin", name="accueilAdmin", methods={"GET"})
     */
    public function AccueilAdmin(): Response
    {



        return $this->render('user/accueilAdmin.html.twig', [
        ]);
    }

    /**
     * @Route("/AccueilEnseignant", name="AccueilEnseignant", methods={"GET"})
     */
    public function AccueilEnseignant(): Response
    {





        return $this->render('user/accueilEnseignant.html.twig', [
        ]);
    }
    /**
     * @Route("/backtherapeute", name="user_back", methods={"GET"})
     */
    public function indexback(): Response
    {


        return $this->render('baseBackthe.html.twig');}




    /**
     * @Route("/{id}/confirm", name="user_confirm", methods={"GET","POST"})
     */
    public function confirm(Request $request, User $user): Response
    {
        $user->setEtat("inscrit");

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('user_index');


    }

    /**
     * @Route("confirm/{email}", name="Activation", methods={"GET","POST"})
     */
    public function Activation(Request $request, $email): Response
    {
        $user=$this->getDoctrine()->getRepository(User::class)->findOneBy(array('email'=>$email));
        $user->setEtat("inscrit");

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('user_index');


    }





    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }


    /**
     * @Route("/login/login", name="user_login", methods={"GET","POST"})
     */
    public function login(Request $request,UserRepository $userrep){
        $user=new User('','','','','','','');
        $som=0;



        $session = $request->getSession();
        $session->set('email',"");
        $session->set('type',"");
        $session->set('cin',"");

        $form = $this->createForm(LoginType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            $typeUser=$user->getType();
            $email=$user->getEmail();
            $mdp=$user->getPassword();
            $id=$user->getId();
            $cin=$user->getCin();
            $etat="inscrit";
            $type="admin";
            $type2="enseignant";
            $type3="responsable";


            $user1=$userrep->findadmin($email,$mdp,$type);
            $user2=$userrep->findenseignant($email,$mdp,$type2);
            $user3=$userrep->findresponsable($email,$mdp,$type3);

            if($user1 !=  null){
                $session->start();

                $session->set('email',$email);
                $session->set('mdp',$mdp);
                $session->set('id',$id);
                $session->set('type',$typeUser);
                $session->set('cin',$cin);
                return $this->redirectToRoute("accueilAdmin");

            }
            if($user3 !=  null){
                $session->start();
                $session->set('cin',$cin);

                $session->set('email',$email);
                $session->set('mdp',$mdp);
                $session->set('id',$id);
                $session->set('type',$typeUser);

                return $this->redirectToRoute("accueil_index");

            }
            if($user2 != null){
                $session->start();
                $session->set('cin',$cin);

                $session->set('email',$email);
                $session->set('mdp',$mdp);
                $session->set('id',$id);
                $session->set('type',$typeUser);

                return $this->redirectToRoute("AccueilEnseignant");
            }
            else {
                $this->addFlash('notice', "Verifier vos paramétres ou consulter l'administrateur !");

            }



        }

        return $this->render('user/Login.html.twig', [

            'form' => $form->createView(),
        ]);

    }





}
