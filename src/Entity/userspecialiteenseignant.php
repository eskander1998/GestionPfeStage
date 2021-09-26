<?php


namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * userspecialiteenseignant
 * @ORM\Table(name="user_specialite_enseignant")
 * @ORM\Entity
 */
class userspecialiteenseignant
{

    /**
     * @var int
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $user_id;
    /**
     * @var int
     * @ORM\Column(name="specialite_enseignant_id", type="integer", nullable=false)
     */
    private $specialite_enseignant_id;

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
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getSpecialiteEnseignantId(): ?int
    {
        return $this->specialite_enseignant_id;
    }

    /**
     * @param int $specialite_enseignant_id
     */
    public function setSpecialiteEnseignantId(int $specialite_enseignant_id): void
    {
        $this->specialite_enseignant_id = $specialite_enseignant_id;
    }


}