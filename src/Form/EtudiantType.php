<?php

namespace App\Form;

use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Filiere;
use App\Entity\Pfe;
use App\Entity\Societe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('nom')
            ->add('prenom')
            ->add('cin')
            ->add('classe')

            ->add('filiere', EntityType::class , [
                'class' => Filiere::class,
                'choice_label' => 'nom'   ,
                'multiple' => false,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',
                'choice_value' => 'nom',

            ])

            ->add('telephone')
            ->add('mail')

/*            ->add('idEncadreur', EntityType::class , [
                'class' => Enseignant::class,
                'choice_label' => function(Enseignant $Enseignant ){
                    return sprintf('%s (%s %s)',(integer)$Enseignant->getCin() , (string)$Enseignant->getNom(),(string)$Enseignant->getPrenom() );
                }   ,
                'multiple' => false,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',

            ])*/

          /*  ->add('idSujetpfe', EntityType::class , [
                'class' => Pfe::class,
                'choice_label' => 'sujet'   ,
                'multiple' => false,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',

            ])

           ->add('idSociete', EntityType::class , [
                'class' => Societe::class,
                'choice_label' => 'nom' ,
                'multiple' => false,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',

            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
