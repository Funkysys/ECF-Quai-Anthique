<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Images::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre')->setHelp('Le titre de l\'image.'),
            TextField::new('imageAlt', 'Texte alternatif')->setHelp('Texte alternatif pour l\'accessibilité.'),
            Field::new('imageFile', 'Fichier image')
                ->setFormType(VichImageType::class)
                ->setHelp('Seuls les fichiers JPEG, PNG et JPG de moins de 5 Mo sont autorisés.')
                ->onlyWhenCreating(),
            ImageField::new('imageName', 'Aperçu')
                ->setBasePath('asset/images/gallery')
                ->onlyOnIndex(),
        ];
    }
}
