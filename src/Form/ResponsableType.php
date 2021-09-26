<?php

namespace App\Form;

use App\Entity\Enseignant;
use App\Entity\Filiere;
use App\Entity\Responsable;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponsableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idenseignant', EntityType::class, array(
                'attr' => ['data-select' => 'true'],
                'class' => User::class,
                'choice_label' => function (User $enseignant) {
                    $str = $enseignant->getCin();
if($enseignant->getType()=="enseignant")
                    return sprintf('%s (%s %s)',(integer)$enseignant->getCin() , (string)$enseignant->getNom(),(string)$enseignant->getPrenom() );

                },




                'placeholder'=>"Choisir l'enseignant",
            ))
            ->add('filiere', EntityType::class, array(
                'attr' => ['data-select' => 'true'],
                'class' => Filiere::class,
                'choice_label' => function(Filiere $filiere){
                    return sprintf('%s', $filiere->__toString());
                }   ,
                'placeholder'=>'Choisir la Filiere',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Responsable::class,
        ]);
    }
}
