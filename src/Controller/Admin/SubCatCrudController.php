<?php

namespace App\Controller\Admin;

use App\Entity\SubCat;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SubCatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SubCat::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            AssociationField::new('category')
        ];
    }
}
