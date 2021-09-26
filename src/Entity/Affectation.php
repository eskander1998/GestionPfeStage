<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 * @ORM\Table(name="affectation")
 * @ORM\Entity(repositoryClass="App\Repository\AffectationRepository")
 */
class Affectation
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="id_pfe", type="string", length=200, nullable=false)
     */
    private $idPfe;
    /**
     * @var string
     *
     * @ORM\Column(name="id_etudiant", type="string", length=200, nullable=false)
     */
    private $idEtudiant;

    /**
     * @var string
     *
     * @ORM\Column(name="id_enseignant", type="string", length=200, nullable=false)
     */
    private $idEnseignant;

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
    public function getIdPfe(): ?string
    {
        return $this->idPfe;
    }

    /**
     * @param string $idPfe
     */
    public function setIdPfe(string $idPfe): void
    {
        $this->idPfe = $idPfe;
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
     * @return string
     */
    public function getIdEnseignant(): ?string
    {
        return $this->idEnseignant;
    }

    /**
     * @param string $idEnseignant
     */
    public function setIdEnseignant(string $idEnseignant): void
    {
        $this->idEnseignant = $idEnseignant;
    }




}
