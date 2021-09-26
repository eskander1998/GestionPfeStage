<?php

namespace App\Form;

use App\Entity\EncadrantSociete;
use App\Entity\Enseignant;
use App\Entity\Etudiant;
use App\Entity\Pfe;
use App\Entity\Societe;
use App\Entity\Specialite;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class PfeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sujet')
            /*  ->add('specialite', EntityType::class, [

                 'class' => Specialite::class,
                 'choice_label' => 'nom'  ,
                 'multiple' => false,
                 'attr' => ['data-select' => 'true'],
                 'placeholder' => 'Choisir une option',
                 'empty_data' => function($spe){
                     return ''.$spe->getNom();
                 },
             ])*/

            ->add('Specialites', EntityType::class, array(

                'class' => Specialite::class,
                'choice_label' => 'nom'  ,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',

                'expanded'  => false,
                'multiple'  => true,
            ))
     /*    ->add('spe', EntityType::class, [

                'class' => Specialite::class,
                'choice_label' => 'nom'  ,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->where('f.id >= :id')
                        ->setParameter('id', 1);
                },
                'expanded'  => false,
                'multiple'  => true,
            ])*/
            ->add('idSociete', EntityType::class, [
                'class' => Societe::class,

                'choice_label' => function(Societe $Societe ){
                    return sprintf('%s', $Societe->getNom());
                }   ,
                'multiple' => false,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',

            ])
       /*     ->add('idEtudiant', EntityType::class , [
                'class' => Etudiant::class,
                'choice_label' => function(Etudiant $Etudiant ){
                    return sprintf('%s (%s %s) ', $Etudiant->getCin(),$Etudiant->getNom(),$Etudiant->getPrenom());
                }   ,
                'multiple' => false,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',

            ])

*/
            ->add('idEncadreur', EntityType::class , [
                'class' => EncadrantSociete::class,
                'choice_label' => function(EncadrantSociete $EncadrantSociete ){
                    return sprintf('%s (%s)', (string)$EncadrantSociete->__toString(),$EncadrantSociete->getIdSociete());
                }   ,
                'multiple' => false,
                'attr' => ['data-select' => 'true'],
                'placeholder' => 'Choisir une option',

            ])

            ->add('dateDebut',DateType::class
                ,[//'min' => ( new \DateTime() )->format('Y-m-d'),

                    //'required' => false,
                    'widget'=> 'single_text',
                    //'html5'=> false,
                     //'format' => 'Y/m/d',
                   // 'attr' => array('class' => 'date')
                ])
            ->add('dateFin',DateType::class,[

                    //'required' => false,
                    'widget'=> 'single_text',
                   // 'html5'=> false,
                   // 'format' => 'Y/m/d',
                    //'attr' => array('class' => 'date')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pfe::class,
        ]);
    }
}
