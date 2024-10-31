<?php

// src/Controller/Admin/VystaveneZajezdyCrudController.php

namespace App\Controller\Admin;

use App\Entity\VystaveneZajezdy;
use App\Entity\Zajezdy;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class VystaveneZajezdyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VystaveneZajezdy::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW)
            ->disable(Action::DELETE);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('vystavenyZajezd1', 'Vystavený zájezd 1')
                ->setCrudController(ZajezdyCrudController::class),
            AssociationField::new('vystavenyZajezd2', 'Vystavený zájezd 2')
                ->setCrudController(ZajezdyCrudController::class),
            AssociationField::new('vystavenyZajezd3', 'Vystavený zájezd 3')
                ->setCrudController(ZajezdyCrudController::class),
        ];
    }
}


