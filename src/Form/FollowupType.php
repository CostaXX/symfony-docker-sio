<?php

namespace App\Form;

use App\Entity\FollowUp;
use App\Entity\Veterinary;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FollowupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contactName',TextType::class, ['label' => 'Contact'])
            ->add('comment',TextType::class, ['label' => 'Commentaires'])
            ->add('callDate', null, [
                'widget' => 'single_text',
                'label' => 'Date d\'appel'
            ])
            ->add('veterinary', EntityType::class, [
                'class' => Veterinary::class,
                'choice_label' => 'name',
                'label' => 'Véterinaire'
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
