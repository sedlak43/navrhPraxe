<?php

// src/Form/PricingItemType.php

namespace App\Form;

use App\Entity\PricingItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PricingItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('item', TextType::class, [
                'label' => 'Item',
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Zahrnuje' => 'Zahrnuje',
                    'Nezahrnuje' => 'Nezahrnuje',
                ],
                'label' => 'Type',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PricingItem::class,
        ]);
    }
}
