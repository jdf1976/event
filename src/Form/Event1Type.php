<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class Event1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('beschreibung')
            ->add('datum')
            ->add('bild')
            ->add('anzahl')
            ->add('minteilnehmer')
            ->add('max')
            ->add('Kategorie')
            ->add('zeit')
            ->add('hinweis')
            ->add('code')
            ->add('active')
            ->add('ref')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
