<?php

// src/Form/ProgramDayType.php

namespace App\Form;

use App\Entity\ProgramDne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramDneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cisloDne', IntegerType::class, [
                'label' => 'Cislo Dne',
            ])
            ->add('nazev', TextType::class, [
                'label' => 'Nazev',
            ])
            ->add('popisek', TextareaType::class, [
                'label' => 'Popisek',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProgramDne::class,
        ]);
    }
}
