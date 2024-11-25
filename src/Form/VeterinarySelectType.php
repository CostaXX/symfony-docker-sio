<?php

namespace App\Form;

use App\Entity\Veterinary;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VeterinarySelectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('veterinary', EntityType::class, [
            'class' => Veterinary::class,
            'choice_label' => 'name',
            'multiple' => false,
            'label' => 'Vétérinaire',
            'placeholder' => 'Choisissez un vétérinaire',
            'required' => false,
            ])
        ->add('year', NumberType::class, [
            'label' => 'année',
            'required' => false,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
