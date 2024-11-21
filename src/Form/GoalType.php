<?php

namespace App\Form;

use App\Entity\Goal;
use App\Entity\Product;
use App\Entity\Veterinary;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('veterinary', EntityType::class, [
                'class' => Veterinary::class,
                'choice_label' => 'name',
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
            ])
            ->add('amount', MoneyType::class, [
                'label' => 'Prix',
                'currency' => 'EUR',   
                'scale' => 2,          
                'attr' => [
                    'min' => 0,
                    'step' => 0.01,    
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Goal::class,
        ]);
    }
}
