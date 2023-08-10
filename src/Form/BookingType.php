<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('beginAt')
            ->add('description')
            ->add('maxParticipant')
            ->add('minParticipant')
            ->add('currentParticipant')
            ->add('speaker')
            ->add('isActive')
            ->add('picture')
            ->add('notice')
            ->add('code')
            ->add('category_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
