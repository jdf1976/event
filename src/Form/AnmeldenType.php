<?php

namespace App\Form;

use App\Entity\Anmeldung;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints as Assert;

class AnmeldenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var Anmeldung $subscription */
        $subscription = $options['data'];

        $builder
            ->add('Email', TextType::class, [
                'label' => 'Ihre E-Mail: '
            ])
            //->add('eventNr')
            ->add('name', TextType::class, [
                'label' => 'Ihr Name: ',
            ])
            ->add('teilnehmer', IntegerType::class, [
                'label' => 'Teilnehmeranzahl: ',
                'constraints' => [
                    new Assert\Range([
                        'min' => 1,
                        'max' => 9,
                        'notInRangeMessage' => 'Bitte eine Zahl zwischen 1 und 9 eingeben',
                    ]),
                ]
            ]);

        if ($subscription->isSpecialEvent()) {
            $builder
                ->add('code', TextType::class, [
                    'label' => 'Code: '
                ]);
        }

        $builder
            ->add('datenschutz', CheckboxType::class, [
                'label' => 'Bitte akzeptieren Sie unsere <a href="https://www.pec-weissach.com/datenschutz">Datenschutzvereinbahrung</a>',
                'label_html' => true,
                'required' => true,
            ])
            ->add('foto', CheckboxType::class, [
                'label' => 'Zustimmung für Fotoaufnahmen während des Events</a>',
                'label_html' => true,
                'required' => true,
            ])
            //->add('status')
            ->add('Absenden', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Time protection
            'antispam_time' => true,
            'antispam_time_min' => 10, // seconds
            'antispam_time_max' => 60,

            // Honeypot protection
            'antispam_honeypot' => true,
            'antispam_honeypot_class' => 'hide-me',
            'antispam_honeypot_field' => 'email-repeat',
            'data_class' => Anmeldung::class,
        ]);

    }
}
