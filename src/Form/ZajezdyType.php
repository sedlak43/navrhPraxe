<?php

// src/Form/ZajezdyType.php

namespace App\Form;

use App\Entity\Zajezdy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZajezdyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nazev', TextType::class, [
                'label' => 'Název',
            ])
            ->add('podnazev', TextType::class, [
                'label' => 'Podnázev',
                'required' => false,
            ])
            ->add('cena', IntegerType::class, [
                'label' => 'Cena',
            ])
            ->add('doprava', ChoiceType::class, [
                'label' => 'Doprava',
                'choices' => [
                    'Autobus' => 'Autobus',
                    'Vlak' => 'Vlak',
                    'Letadlo' => 'Letadlo',
                    'Vlastní' => 'Vlastní',
                ],
            ])
            ->add('strava', ChoiceType::class, [
                'label' => 'Strava',
                'choices' => [
                    'Plná penze' => 'Plná penze',
                    'Polopenze' => 'Polopenze',
                    'Oběd' => 'Oběd',
                    'Snídaně' => 'Snídaně',
                    'Bez stravy' => 'Bez stravy',
                    'Dle programu' => 'Dle programu',
                    'Vlastní strava, za příplatek' => 'Vlastní strava, za příplatek',
                ],
            ])
            ->add('destinace', TextType::class, [
                'label' => 'Destinace',
                'required' => false,
            ])
            ->add('typ', ChoiceType::class, [
                'label' => 'Typ zájezdu',
                'choices' => [
                    'Poznávací zájezd' => 'Poznávací zájezd',
                    'Zájezdový pobyt' => 'Zájezdový pobyt',
                ],
                'required' => false,
            ])
            ->add('image', FileType::class, [
                'label' => 'Hlavní obrázek',
                'required' => false,
                'data_class' => null, // Important for file uploads
            ])
            ->add('carousel_image1', FileType::class, [
                'label' => 'Obrázek karuselu 1',
                'required' => false,
                'data_class' => null,
            ])
            ->add('carousel_image2', FileType::class, [
                'label' => 'Obrázek karuselu 2',
                'required' => false,
                'data_class' => null,
            ])
            ->add('carousel_image3', FileType::class, [
                'label' => 'Obrázek karuselu 3',
                'required' => false,
                'data_class' => null,
            ])
            ->add('delka', IntegerType::class, [
                'label' => 'Délka zájezdu (dny)',
                'required' => false,
            ])
            ->add('uvodniNadpis', TextType::class, [
                'label' => 'Úvodní Nadpis',
                'required' => false,
            ])
            ->add('uvodniPopisek', TextType::class, [
                'label' => 'Úvodní Popisek',
                'required' => false,
            ])
            ->add('poznamky', TextType::class, [
                'label' => 'Poznámky',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Zajezdy::class,
        ]);
    }
}


