<?php

namespace App\Form;

use App\Entity\FollowUp;
use App\Entity\Veterinary;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FollowupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contactName')
            ->add('comment')
            ->add('callDate', null, [
                'widget' => 'single_text',
            ])
            ->add('veterinary', EntityType::class, [
                'class' => Veterinary::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FollowUp::class,
        ]);
    }
}
