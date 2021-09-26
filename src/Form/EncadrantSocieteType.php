<?php

namespace App\Form;

use App\Entity\EncadrantSociete;
use App\Entity\Enseignant;
use App\Entity\Societe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EncadrantSocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('numeroTelephone')
            ->add('idSociete', EntityType::class , [
                'attr' => ['data-select' => 'true'],

                'class' => Societe::class,
                'choice_label' => function (Societe $nomSociete) {
                    $str = $nomSociete->__toString();

                    return $str;
                },
               'placeholder'=>"Choisir la société",
            ])
            ->add('poste')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EncadrantSociete::class,
        ]);
    }
}
