<?php

// src/Controller/Admin/DomovskastrankaCrudController.php

namespace App\Controller\Admin;

use App\Entity\Domovskastranka;
use App\Entity\Zajezdy;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class DomovskastrankaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Domovskastranka::class;
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


