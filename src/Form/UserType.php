<?php

namespace App\Form;

use App\Entity\Specialite;
use App\Entity\SpecialiteEnseignant;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin',NumberType::class,[
                'attr'=>[
                    'placeholder'=>'cin'

                ]
            ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    'placeholder'=>'email'

                ]
            ])
            ->add('nom',TextType::class,[
                'attr'=>[
                    'placeholder'=>'nom'

                ]
            ])
            ->add('prenom',TextType::class,[  'attr'=>[
                'placeholder'=>'prenom'

            ]])
           /* ->add('specialite', EntityType::class , [
                'class' => Specialite::class,
                'choice_label' => function(Specialite $specialite ){
                    return sprintf('%s', $specialite->__toString());
                }   ,
                'placeholder'=>'Choisir la spécialité',
            ])*/

           ->add('Specialites', EntityType::class, array(

               'class' => SpecialiteEnseignant::class,
               'choice_label' => 'nom'  ,
               'attr' => ['data-select' => 'true'],
               'placeholder' => 'Choisir une option',

               'expanded'  => false,
               'multiple'  => true,
           ))
            ->add('experience')
            ->add('telephone')

            ->add('password',TextType::class,[
                'attr'=>[
                    'placeholder'=>'password'

                ]
            ])
        ;



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
