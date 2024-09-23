<?php

namespace App\Form;

use App\Entity\Datumy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datum', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Datum zájezdu',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Datumy::class,
            'mapped' => true, // Toto zajišťuje mapování na entitu
        ]);
    }
}

