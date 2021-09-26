<?php


namespace App\Entity;


/**
 * specialite_pfe
 *  @ORM\Table(name="specialite_pfe")
 * @ORM\Entity
 */
class specialite_pfe
{
    /**
     * @var int
     *
     * @ORM\Column(name="specialite_id", type="integer", nullable=false)
     */
    private $specialite_id;
    /**
     * @var int
     *
     * @ORM\Column(name="pfe_id", type="integer", nullable=false)
     */
    private $pfe_id;
}