<?php

// src/Form/HodinyType.php

namespace App\Form;

use App\Entity\Hodiny;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HodinyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nazev_dne', TextType::class, [
                'label' => 'Den',
            ])
            ->add('hodiny_dne', TextareaType::class, [
                'label' => 'Popis otevíracích hodin',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hodiny::class,
        ]);
    }
}


