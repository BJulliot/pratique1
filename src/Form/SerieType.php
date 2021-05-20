<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('overview')
            ->add('status')
            ->add('vote')
            ->add('popularity')
            ->add('genre')
            ->add('firstAirDate')
            ->add('lastAirDate')
            ->add('backdrop')
            ->add('poster')
            ->add('tmdbId')
            ->add('dateCreated')
            ->add('dateModified')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
