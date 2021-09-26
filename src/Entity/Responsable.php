<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;

/**
 * Responsable
 *
 * @ORM\Table(name="responsable")
 * @ORM\Entity
 */
class Responsable
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
     * @var int
     * @ORM\Column(name="id_enseignant", type="string", length=50, nullable=false)
     */
    private $idenseignant;

    /**
     * @var string
     * @ORM\Column(name="filiere", type="string", length=500, nullable=false)
     */
    private $filiere;

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
     * @return int
     */
    public function getIdenseignant(): ?string
    {
        return $this->idenseignant;
    }

    /**
     * @param int $idenseignant
     */
    public function setIdenseignant(string $idenseignant): void
    {
        $this->idenseignant = $idenseignant;
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





}
