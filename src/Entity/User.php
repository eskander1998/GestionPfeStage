<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *  @ORM\Table(name="user")

 * @ORM\Entity
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *@Assert\NotBlank(message="remplir le champs CIN")
     * @ORM\Column(name="cin", type="string", nullable=false)
     */
    protected $cin;

    /**
     * @var string
     *@Assert\NotBlank(message="remplir le champs email")
     * @Assert\Email(
     *     message = "email '{{ value }}' n'est pas un email valide"
     * )
     * @ORM\Column(name="email", type="string", length=30, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *@Assert\NotBlank(message="remplir le champs nom")

     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    protected $nom;

    /**
     * @var string
     *@Assert\NotBlank(message="remplir le champs prenom")

     * @ORM\Column(name="prenom", type="string", length=30, nullable=false)
     */
    protected $prenom;

    /**
     * @var string
     *@Assert\NotBlank(message="remplir le champs mot de passe")
     * @ORM\Column(name="password", type="string", length=80, nullable=false)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=30, nullable=false)
     */
    protected $type;



    /**
     * @var string|null
     *
     * @ORM\Column(name="etat", type="string", length=30, nullable=true)
     */
    protected $etat;


/*
    /**
     * @var string
     * @ORM\Column(name="filiere", type="string", length=100, nullable=false)
     */
  //  private $filiere;


    /**
     * @var int
     *
     * @ORM\Column(name="experience", type="integer", nullable=false)
     */
    private $experience;
    /**

     * @var string|null

     */
    public string $password1;
    /**

     * @var string|null

     */


    public string $code;


    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @ORM\ManyToMany(targetEntity=SpecialiteEnseignant::class, inversedBy="users")
     * @ORM\JoinTable(name="user_specialite_enseignant"
     *     )
     */
    private $Specialites;



    /**
     * User constructor.
     * @param string $cin
     * @param string $email
     * @param string $nom
     * @param string $prenom
     * @param string $password
     * @param string $type
     * @param string|null $etat
     */
    public function __construct(string $cin, string $email, string $nom, string $prenom, string $password, string $type, ?string $etat)
    {
        $this->cin = $cin;
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->password = $password;
        $this->type = $type;
        $this->etat = $etat;
        $this->Specialites = new ArrayCollection();

    }


    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }


    /**
     * @return string
     */
    public function getPassword1(): string
    {
        return $this->password1;
    }

    /**
     * @param string $password1
     */
    public function setPassword1(string $password1): void
    {
        $this->password1 = $password1;
    }






    /**
     * @return int
     */
    public function getId()
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
    public function getCin()
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getNom()
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
    public function getPrenom()
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
    public function getPassword()
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

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string|null
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string|null $etat
     */
    public function setEtat(?string $etat): void
    {
        $this->etat = $etat;
    }

    public function __toString()
    {
return $this->cin;    }


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
     * @return Collection|SpecialiteEnseignant[]
     */
    public function getSpecialites(): Collection
    {
        return $this->Specialites;
    }

    public function addSpecialite(SpecialiteEnseignant $specialite): self
    {
        if (!$this->Specialites->contains($specialite)) {
            $this->Specialites[] = $specialite;
        }

        return $this;
    }

    public function removeSpecialite(SpecialiteEnseignant $specialite): self
    {
        $this->Specialites->removeElement($specialite);

        return $this;
    }




}
