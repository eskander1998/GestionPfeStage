<?php

namespace App\Repository;

use App\Entity\Pfe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;


class PfeRepository  extends \Doctrine\ORM\EntityRepository
{


    public function AffectationPfeEtdudiant($idEtudiant,$idEnseignant,$SujetPfe)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("update App\Entity\Etudiant e  set e.cin_enseignent_encadreur= :enseignant and e.sujetPfe = :sujetpfe where (e.id=:idEtudiant)
                    ")
        ->setParameter('enseignant', $idEnseignant)
        ->setParameter('sujetpfe', $SujetPfe)
        ->setParameter('idEtudiant', $idEtudiant);

        return $query->getResult();

    }//SELECT TIMESTAMPDIFF(week, date_debut, date_fin) from pfe

    public function diffweek($d1,$d2)
    {
        $entityManager= $this->getEntityManager();

        $query=$entityManager
            ->createQuery("SELECT TIMESTAMPDIFF(week, :date_debut, :date_fin) from App\Entity\Pfe 
            ")
            ->setParameter('date_debut', $d1)
            ->setParameter('date_fin', $d2);
        return $query->getResult();

    }
}
