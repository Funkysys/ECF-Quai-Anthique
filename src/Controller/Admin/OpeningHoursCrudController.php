<?php

namespace App\Controller\Admin;

use App\Entity\OpeningHours;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OpeningHoursCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OpeningHours::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('day'),
            BooleanField::new('close', 'day off'),
            BooleanField::new('lunch'),
            BooleanField::new('diner'),
            AssociationField::new('openingHours'),
            AssociationField::new('openMinutes'),
            AssociationField::new('closeHours'),
            AssociationField::new('closeMinutes'),

        ];
    }
}
