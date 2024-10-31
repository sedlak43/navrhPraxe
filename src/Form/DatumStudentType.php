<?php

namespace App\Form;

use App\Entity\Datumy;
use App\Entity\DatumyStudent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatumStudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datum', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Datum zájezdu',
            ])
            ->add('price', MoneyType::class, [
                'currency' => 'CZK',
                'label' => 'Cena za datum',
                'required' => false,
            ])
            ->add('delka', IntegerType::class, [
                'label' => 'Délka pobytu (dny)',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DatumyStudent::class,
            'mapped' => true, // Toto zajišťuje mapování na entitu
        ]);
    }
}

