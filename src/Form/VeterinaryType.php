<?php

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Doctrine\DBAL\Types\IntegerType;
use App\Entity\Activity;
use App\Entity\Veterinary;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class VeterinaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, ['label' => 'Nom'])
            ->add('address',TextType::class, ['label' => 'Adresse'])
            ->add('postalCode',NumberType::class, ['label' => 'Code postal'])
            ->add('city',TextType::class, ['label' => 'Ville'])
            ->add('phonep',TextType::class, ['label' => 'Téléphone'])
            ->add('imageFileName',TextType::class, ['label' => 'Image', 
                'required' => false, 
                'empty_data' => 'default.jpg',])
            ->add('creationDate', null, [
                'widget' => 'single_text',
            ])
            ->add('activities', EntityType::class, [
                'class' => Activity::class,
                'choice_label' => 'description',
                'multiple' => true,
                'label' => 'Activités'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Veterinary::class,
        ]);
    }
}
