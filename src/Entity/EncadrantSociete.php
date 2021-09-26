<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EncadrantSociete
 *
 * @ORM\Table(name="encadrant_societe")
 * @ORM\Entity
 */
class EncadrantSociete
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
     * @ORM\Column(name="nom", type="string", length=200, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=200, nullable=false)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_telephone", type="integer", nullable=false)
     */
    private $numeroTelephone;

    /**
     * @var int
     *
     * @ORM\Column(name="id_societe", type="string", length=100, nullable=false)
     */
    private $idSociete;

    /**
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=200, nullable=false)
     */
    private $poste;

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
     * @return int
     */
    public function getNumeroTelephone(): ?int
    {
        return $this->numeroTelephone;
    }

    /**
     * @param int $numeroTelephone
     */
    public function setNumeroTelephone(int $numeroTelephone): void
    {
        $this->numeroTelephone = $numeroTelephone;
    }

    /**
     * @return int
     */
    public function getIdSociete(): ?string
    {
        return $this->idSociete;
    }

    /**
     * @param int $idSociete
     */
    public function setIdSociete(string $idSociete): void
    {
        $this->idSociete = $idSociete;
    }

    /**
     * @return string
     */
    public function getPoste(): ?string
    {
        return $this->poste;
    }

    /**
     * @param string $poste
     */
    public function setPoste(string $poste): void
    {
        $this->poste = $poste;
    }

    public function __toString()
    {
return (string)$this->getNom()." ".(string)$this->getPrenom();

    }


}
