<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Pfe
 *
 * @ORM\Table(name="pfe")
 * @ORM\Entity(repositoryClass="App\Repository\AffectationRepository")
 */
class Pfe
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=200, nullable=false)
     */
    private $sujet;




    /**
     * @var int
     *
     * @ORM\Column(name="id_societe", type="string", length=100, nullable=false)
     */
    private $idSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="id_etudiant", type="string", length=50, nullable=false)
     */
    private $idEtudiant;

    /**
     * @var string
     * @ORM\Column(name="id_encadreur", type="string", length=100, nullable=false)
     */
    private $idEncadreur;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var \DateTime
     * @ORM\Column(name="validation1", type="date", nullable=false)
     */
    private $validation1;

    /**
     * @var \DateTime
     * @ORM\Column(name="validation2", type="date", nullable=false)
     */
    private $validation2;
    /**
     * @var \DateTime
     * @ORM\Column(name="validation3", type="date", nullable=false)
     */
    private $validation3;
    /**
     * @var \DateTime
     * @ORM\Column(name="validation4", type="date", nullable=false)
     */
    private $validation4;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=false)
     */
    private $dateFin;




    /**
     * @ORM\ManyToMany(targetEntity=Specialite::class)
     * @ORM\JoinTable(name="specialite_pfe"
     *     )
     */
    private $Specialites;

    /**
     * @var string
     * @ORM\Column(name="etat", type="string", length=100, nullable=false)
     */
    private $etat;
    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    /**
     * @param string $sujet
     */
    public function setSujet(string $sujet): void
    {
        $this->sujet = $sujet;
    }

    /**
     * @return string
     */
    public function getIdSociete(): ?string
    {
        return $this->idSociete;
    }

    /**
     * @param string $idSociete
     */
    public function setIdSociete(string $idSociete): void
    {
        $this->idSociete = $idSociete;
    }

    /**
     * @return string
     */
    public function getIdEncadreur(): ?string
    {
        return $this->idEncadreur;
    }

    /**
     * @param string $idEncadreur
     */
    public function setIdEncadreur(string $idEncadreur): void
    {
        $this->idEncadreur = $idEncadreur;
    }

    /**
     * @return string
     */
    public function getIdEtudiant(): ?string
    {
        return $this->idEtudiant;
    }

    /**
     * @param string $idEtudiant
     */
    public function setIdEtudiant(string $idEtudiant): void
    {
        $this->idEtudiant = $idEtudiant;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut(\DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin(\DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    public function __toString()
    {
return $this->sujet;
    }

    /**
     * @return DateTime
     */
    public function getValidation1(): ?DateTime
    {
        return $this->validation1;
    }

    /**
     * @param DateTime $validation1
     */
    public function setValidation1(DateTime $validation1): void
    {
        $this->validation1 = $validation1;
    }

    /**
     * @return DateTime
     */
    public function getValidation2(): ?DateTime
    {
        return $this->validation2;
    }

    /**
     * @param DateTime $validation2
     */
    public function setValidation2(DateTime $validation2): void
    {
        $this->validation2 = $validation2;
    }

    /**
     * @return DateTime
     */
    public function getValidation3(): ?DateTime
    {
        return $this->validation3;
    }

    /**
     * @param DateTime $validation3
     */
    public function setValidation3(DateTime $validation3): void
    {
        $this->validation3 = $validation3;
    }

    /**
     * @return DateTime
     */
    public function getValidation4(): ?DateTime
    {
        return $this->validation4;
    }

    /**
     * @param DateTime $validation4
     */
    public function setValidation4(DateTime $validation4): void
    {
        $this->validation4 = $validation4;
    }


    /************************************************************/


    public function __construct()
    {
        $this->Specialites = new ArrayCollection();
    }




    public function addSpecialite(Specialite $specialite): self
    {
        if (!$this->Specialites->contains($specialite)) {
            $this->Specialites[] = $specialite;
        }

        return $this;
    }

    public function removeSpecialite(Specialite $specialite): self
    {
        $this->Specialites->removeElement($specialite);

        return $this;
    }


    public function getSpecialites()
    {
        return $this->Specialites;
    }

    public function setSpecialites(string $spe): void
    {
        $this->Specialites = $spe;
    }

    /**
     * @return string
     */
    public function getEtat(): ?string
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat(string $etat): void
    {
        $this->etat = $etat;
    }
    public function numWeeks($dateOne, $dateTwo){
        //Create a DateTime object for the first date.
        $result = $dateOne->format('Y-m-d H:i:s');
        $firstDate = new DateTime($result);
        //Create a DateTime object for the second date.
        $result2 = $dateTwo->format('Y-m-d H:i:s');

        $secondDate = new DateTime($result2);
        //Get the difference between the two dates in days.
        $differenceInDays = $firstDate->diff($secondDate)->days;
        //Divide the days by 7
        $differenceInWeeks = $differenceInDays / 7;
        //Round down with floor and return the difference in weeks.
        return floor($differenceInWeeks);
    }


}
