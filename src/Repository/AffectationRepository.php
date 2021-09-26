<?php


namespace App\Repository;
use App\Entity\Affectation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;

class AffectationRepository extends \Doctrine\ORM\EntityRepository
{

/*
    public function AffectationPfeEtdudiant($idEtudiant,$idEnseignant,$SujetPfe)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("update App\Entity\Etudiant e  set e.cin_enseignent_encadreur= :enseignant and e.sujetPfe = :sujetpfe where (e.id=:idEtudiant)")
            ->setParameter('enseignant', $idEnseignant)
            ->setParameter('sujetpfe', $SujetPfe)
            ->setParameter('idEtudiant', $idEtudiant);

        return $query->getResult();

    }

*/

    public function AffectationPfeEtdudiant($idEtudiant,$idEnseignant,$SujetPfe)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("update App\Entity\Etudiant e  set e.idEncadreur= :enseignant ,  e.idSujetpfe= :sujetpfe where (e.cin= :idEtudiant)")
            ->setParameter('enseignant', $idEnseignant)
            ->setParameter('sujetpfe', $SujetPfe)
            ->setParameter('idEtudiant', $idEtudiant);

        return $query->getResult();

    }
    public function AffectationSocieteEtdudiant($societe,$SujetPfe)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("update App\Entity\Etudiant e set e.idSociete= :societe where (e.idSujetpfe= :idSujetpfe)")
            ->setParameter('societe', $societe)
            ->setParameter('idSujetpfe', $SujetPfe);
        return $query->getResult();

    }

    public function AfficherEtudiantGererParchaqueEnseignant($idEnseignant)
    {  $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("select a.idEtudiant from App\Entity\Affectation a where 
                       a.idEnseignant= :idEnseignant")
            ->setParameter('idEnseignant', $idEnseignant);

        return $query->getResult() ;


    }

    public function AfficherEtudiantGererParchaqueEnseignant2($idEnseignant)
    {  $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("select a from App\Entity\Etudiant a where 
                       a.idEncadreur= :idEnseignant")
            ->setParameter('idEnseignant', $idEnseignant);

        return $query->getResult() ;


    }


    public function ChangerEtatEtudiant($cinEtudiant)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("update App\Entity\Etudiant e set e.etat= :etat where (e.cin= :cinEtudiant)")
            ->setParameter('etat', 'affecte')
            ->setParameter('cinEtudiant', $cinEtudiant);
        return $query->getResult();

    }

    public function ChangerPfe($sujet)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("update App\Entity\Pfe e set e.etat= :etat where (e.sujet= :sujet)")
            ->setParameter('etat', 'affecte')
            ->setParameter('sujet', $sujet);
        return $query->getResult();

    }


    public function diffweek($d1,$d2)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("SELECT DATE_DIFF(:dateDebut, :dateFin) from App\Entity\Pfe p
            ")
            ->setParameter('dateDebut', $d1)
            ->setParameter('dateFin', $d2);
        return $query->getResult();

    }

    public function ChangerIdEtudiantDansPfe($idEtudiant,$SujetPfe)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("update App\Entity\Pfe e set e.idEtudiant= :idEtudiant where (e.sujet= :SujetPfe)")
            ->setParameter('idEtudiant', $idEtudiant)
            ->setParameter('SujetPfe', $SujetPfe);
        return $query->getResult();
    }

    public function AfficherReommandationsEtudiantAencadrer()
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("SELECT e from App\Entity\Etudiant e where e.etat=:nonaffecte
            ")
            ->setParameter('nonaffecte', "non affecte");
        return $query->getResult();

    }


    public function getEnseignantId($email)
    {  $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("select a.id from App\Entity\User a where a.email=:email")
            ->setParameter('email', $email);

        return $query->getResult() ;


    }

    /*public function selectionnerSpeEnseignant($idEnseignant)
    {  $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("select a.nom from App\Entity\SpecialiteEnseignant a where a.id=(select s.specialite_enseignant_id from
            App\Entity\user_specialite_enseignant s where s.user_id:idEnseignant)")
            ->setParameter('idEnseignant', $idEnseignant);

        return $query->getResult()
            ;
    }*/
    public function selectionnerSpeEnseignant($idEnseignant)
    {  $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("select s from
            App\Entity\userspecialiteenseignant s ");

        return $query->getResult()
            ;
    }
    public function NombreDetudiantsEncadreParEnseignant($idEncadreur)
    {  $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("SELECT COUNT(a.id) from App\Entity\Etudiant a where 
                       a.idEncadreur= :idEncadreur")
            ->setParameter('idEncadreur', $idEncadreur);

        return $query->getResult() ;


    }

    public function AffichertoutesLesSpeEnseignant($idEnseignant)
    {  $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("select a.nom from App\Entity\SpecialiteEnseignant a where a.id=(select s.specialite_enseignant_id from
            App\Entity\user_specialite_enseignant s where s.user_id:idEnseignant)")
            ->setParameter('idEnseignant', $idEnseignant);

        return $query->getResult()
            ;
    }


    public function AfficherValidationEnseignant($idPfe)
    {  $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("select a from App\Entity\Pfe a where 
                       a.sujet= :idPfe")
            ->setParameter('idPfe', $idPfe);

        return $query->getResult() ;


    }
}