<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="App\Repository\AffectationRepository")
 */
class Etudiant
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
     * @Assert\NotBlank(message="Ce champs doit etre remplis")
     * @ORM\Column(name="nom", type="string", length=200, nullable=false)
     */
    private $nom;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs doit etre remplis")
     * @ORM\Column(name="prenom", type="string", length=200, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs doit etre remplis")
     * @ORM\Column(name="cin", type="string", length=50, nullable=false)
     */
    private $cin;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs doit etre remplis")
     * @ORM\Column(name="classe", type="string", length=200, nullable=false)
     */
    private $classe;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs doit etre remplis")
     * @ORM\Column(name="filiere", type="string", length=500, nullable=false)
     */
    private $filiere;

    /**
     * @var int
     * @Assert\NotBlank(message="Ce champs doit etre remplis")
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var string
     * @ORM\Column(name="cin_enseignent_encadreur", type="string", length=255, nullable=true)
     */
    private $idEncadreur;

    /**
     * @var string
     * @ORM\Column(name="sujetPfe", type="string", length=255, nullable=true)
     */
    private $idSujetpfe;

    /**
     * @var string
     * @ORM\Column(name="nom_societe", type="string", length=255, nullable=true)
     */
    private $idSociete;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var string
     * @ORM\Column(name="etat", type="string", length=100, nullable=false)
     */
    private $etat;
    /**
     * @return int
     */
    public function getId(): int
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
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getIdSujetpfe(): ?string
    {
        return $this->idSujetpfe;
    }

    /**
     * @param string $idSujetpfe
     */
    public function setIdSujetpfe(string $idSujetpfe): void
    {
        $this->idSujetpfe = $idSujetpfe;
    }


    /**
     * @return string
     */
    public function getCin(): ?string
    {
        return $this->cin;
    }

    /**
     * @param string $cin
     */
    public function setCin(string $cin): void
    {
        $this->cin = $cin;
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
    public function getClasse(): ?string
    {
        return $this->classe;
    }

    /**
     * @param string $classe
     */
    public function setClasse(string $classe): void
    {
        $this->classe = $classe;
    }

    /**
     * @return int
     */
    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    /**
     * @param int $telephone
     */
    public function setTelephone(int $telephone): void
    {
        $this->telephone = $telephone;
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
     * @return \DateTime
     */
    public function getDateAjout(): ?\DateTime
    {
        return $this->dateAjout;
    }

    /**
     * @param \DateTime $dateAjout
     */
    public function setDateAjout($dateAjout): void
    {
        $this->dateAjout = $dateAjout;
    }

    /**
     * @return string
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getFiliere(): ?string
    {
        return $this->filiere;
    }

    /**
     * @param string $filiere
     */
    public function setFiliere(string $filiere): void
    {
        $this->filiere = $filiere;
    }

    public function __toString()
    {
return (string)$this->cin;
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

}
