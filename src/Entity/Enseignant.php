<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enseignant
 *
 * @ORM\Table(name="enseignant")
 * @ORM\Entity(repositoryClass="App\Repository\EnseignantRepository")
 */
class Enseignant
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
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=200, nullable=true)
     */
    private $specialite;

    /**
     * @var int
     *
     * @ORM\Column(name="experience", type="integer", nullable=false)
     */
    private $experience;
    /**
     * @var int
     *
     * @ORM\Column(name="cin", type="string",length=50,nullable=true)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string",length=80,nullable=true)
     */
    private $password;

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
    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    /**
     * @param string $specialite
     */
    public function setSpecialite(string $specialite): void
    {
        $this->specialite = $specialite;
    }

    /**
     * @return int
     */
    public function getExperience(): ?int
    {
        return $this->experience;
    }

    /**
     * @param int $experience
     */
    public function setExperience(int $experience): void
    {
        $this->experience = $experience;
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

    public function __toString()
    {
        return $this->cin;
    }

    public function CIN()
    {
        return $this->nom." ".$this->prenom;
    }

    /**
     * @return int
     */
    public function getCin(): ?string
    {
        return $this->cin;
    }

    /**
     * @param int $cin
     */
    public function setCin(string $cin): void
    {
        $this->cin = $cin;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}
