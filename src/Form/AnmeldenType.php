<?php

namespace App\Form;

use App\Entity\Anmeldung;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnmeldenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Email', TextType::class, [
                'label' => 'Ihre E-Mail: ',
        ])
            //->add('eventNr')
            ->add('name', TextType::class, [
                'label' => 'Ihr Name: ',
        ])
            ->add('teilnehmer', TextType::class,[
                'label' => 'Teilnehmeranzahl: '
            ])
            //->add('status')
            ->add('Absenden', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Anmeldung::class,
        ]);
    }
}
