<?php


namespace App\Repository;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return Therapeute[] Returns an array of Therapeute objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Therapeute
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findenseignant($username,$mdp,$type){
        return $this->createQueryBuilder('u')
            ->where('u.email=:email')
            ->andWhere('u.password =:mdp')
            ->andWhere('u.type=:type')
            ->setParameter('email',$username)
            ->setParameter('mdp',$mdp)
            ->setParameter('type',$type)
            ->getQuery()->getResult();
    }
    public function findadmin($username,$mdp,$type){
        return $this->createQueryBuilder('u')
            ->where('u.email=:email')
            ->andWhere('u.password =:mdp')
            ->andWhere('u.type=:type')

            ->setParameter('email',$username)
            ->setParameter('mdp',$mdp)
            ->setParameter('type',$type)
            ->getQuery()->getResult();
    }
    public function findresponsable($username,$mdp,$type){
        return $this->createQueryBuilder('u')
            ->where('u.email=:email')
            ->andWhere('u.password =:mdp')
            ->andWhere('u.type=:type')

            ->setParameter('email',$username)
            ->setParameter('mdp',$mdp)
            ->setParameter('type',$type)
            ->getQuery()->getResult();
    }

    public function finduseremail($username){
        return $this->createQueryBuilder('u')
            ->where('u.email=:email')

            ->setParameter('email',$username)

            ->getQuery()->getFirstResult();
    }

    public function addUser($cin,$email,$nom,$prenom,$password,$type,$etat){
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("INSERT INTO App\Entity\User (cin, email,nom,prenom,password,type,etat)
 VALUES (:cin,:email,:nom,:prenom,:password,:type,:etat)")
            ->setParameter('cin', $cin)
            ->setParameter('email', $email)
            ->setParameter('nom', $nom)
            ->setParameter('prenom', $prenom)
            ->setParameter('password', $password)
            ->setParameter('type', $type)
            ->setParameter('etat', $etat);

        return $query->getResult();
    }


    public function ModifierEtatResponsable($cinResponsable)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("update App\Entity\User e  set e.type= :type where (e.cin=:cinResponsable)
                    ")
            ->setParameter('type', "responsable")
            ->setParameter('cinResponsable', $cinResponsable);
        return $query->getResult();

    }
}
