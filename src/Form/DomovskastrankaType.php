<?php

namespace App\Form;

use App\Entity\Domovskastranka;
use App\Entity\Zajezdy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DomovskastrankaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vystavenyZajezd1', EntityType::class, [
                'class' => Zajezdy::class,
                'choice_label' => 'id',
            ])
            ->add('vystavenyZajezd2', EntityType::class, [
                'class' => Zajezdy::class,
                'choice_label' => 'id',
            ])
            ->add('vystavenyZajezd3', EntityType::class, [
                'class' => Zajezdy::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Domovskastranka::class,
        ]);
    }
}
