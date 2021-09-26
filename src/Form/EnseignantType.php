<?php

namespace App\Form;

use App\Entity\Enseignant;
use App\Entity\Specialite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('specialite', EntityType::class , [
                'attr' => ['data-select' => 'true'],
                'class' => Specialite::class,
                'choice_label' => function(Specialite $specialite ){
                return sprintf('%s', $specialite->__toString());
                }   ,
            'placeholder'=>'Choisir la spécialité',
            ])
          /*  ->add('specialite', EntityType::class, [
                'class' => Specialite::class,
                'choices' => $group->getNom(),
            ])*/
          ->add('cin')

            ->add('mail')
            ->add('password')
            ->add('experience')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enseignant::class,
        ]);
    }
}
