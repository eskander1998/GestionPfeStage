<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expert
 *
 * @ORM\Table(name="expert")
 * @ORM\Entity
 */
class Expert
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
     *
     * @ORM\Column(name="id_encadreur", type="integer", nullable=false)
     */
    private $idEncadreur;

    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=200, nullable=false)
     */
    private $specialite;


}
