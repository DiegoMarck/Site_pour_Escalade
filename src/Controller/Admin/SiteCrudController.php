<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class SiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Site::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            IntegerField::new('id','ID')->onlyOnIndex(),
            TextField::new('nom'),
            TextField::new('grandeVilleProche'),
            TextField::new('villeLaPlusProche'),
            ArrayField::new('exposition'),
            ImageField::new('imageFile')
            ->setFormType(VichImageType::class)
            ->setLabel('Image')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads/sites')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false)
        ];
    }
    
}
