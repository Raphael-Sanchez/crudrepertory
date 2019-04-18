<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname', TextType::class, [
                'attr'          => [
                    'placeholder'   => 'Saisissez un nom...',
                ],
                'label'         => 'Nom *',
            ])
            ->add('firstname', TextType::class, [
                'attr'          => [
                    'placeholder'   => 'Saisissez un prénom...',
                ],
                'label'         => 'Prénom *',
            ])
            ->add('phone', TextType::class, [
                'attr'          => [
                    'placeholder'   => 'Saisissez un numéro de téléphone...',
                ],
                'label'         => 'Téléphone *',
            ])
            ->add('compagny', TextType::class, [
                'attr'          => [
                    'placeholder'   => 'Saisissez une entreprise...',
                ],
                'label'         => 'Entreprise',
            ])
            ->add('email', EmailType::class, [
                'attr'          => [
                    'placeholder'   => 'Saisissez une adresse email...',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
