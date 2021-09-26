<?php

namespace App\Form;

use App\Entity\Affectation;
use App\Entity\EncadrantSociete;
use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Pfe;
use App\Entity\Societe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AffectationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idEtudiant', EntityType::class, [

                'class' => Etudiant::class,
                'choice_label' => function(Etudiant $Etudiant ){
                if($Etudiant->getEtat()=="non affecte" && $Etudiant->getIdSujetpfe()=="")
                {
                    return sprintf("%s (%s %s)", $Etudiant->getCin(),$Etudiant->getNom(), $Etudiant->getPrenom());
                }
                    } ,        'multiple' => false,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',

            ])
            ->add('idEnseignant',EntityType::class, [

        'class' => User::class,

        'choice_label' => function(User $Enseignant) {


                if (($Enseignant->getType() == 'responsable' || $Enseignant->getType() == 'enseignant')) {
                    return sprintf("%s (%s %s)", $Enseignant->__toString(), $Enseignant->getNom(), $Enseignant->getPrenom());
                }
        }
        ,
        'multiple' => false,
        'attr' => ['data-select' => 'true'],
        'placeholder' => 'Choisir une option',

    ])
            ->add('idPfe',EntityType::class, [
                'class' => Pfe::class,
                'choice_label' => function(Pfe $Pfe ){
                    if($Pfe->getEtat()=='non affecte' )
                    {  return sprintf("%s (%s)", $Pfe->getSujet(),$Pfe->getIdSociete());
                    }  } ,
                'multiple' => false,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Affectation::class,
        ]);
    }
}
