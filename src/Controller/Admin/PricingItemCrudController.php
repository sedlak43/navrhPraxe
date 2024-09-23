<?php

// src/Controller/Admin/PricingItemCrudController.php

namespace App\Controller\Admin;

use App\Entity\PricingItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PricingItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PricingItem::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ChoiceField::new('type')->setChoices([
                'Include' => 'include',
                'Exclude' => 'exclude',
            ]),
        ];
    }
}

