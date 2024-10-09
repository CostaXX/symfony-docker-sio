<?php

namespace App\Form;

use App\Entity\Activity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivitySelectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('activity', EntityType::class, [
            'class' => Activity::class,
            'choice_label' => 'description',
            'multiple' => false,
            'label' => 'Activité',
            'placeholder' => 'Choisissez une catégorie',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
