<?php

namespace App\Controller\Admin;

use App\Entity\Carousel;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class CarouselCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carousel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextEditorField::new('description'),
            ImageField::new('imagescarousel')->setBasePath('/uploads/sites')
                                    ->setUploadDir('public/uploads/sites')
                                    ->setUploadedFileNamePattern('[randomhash].[extension]')
                                    ->setRequired('false')
        ];
    }
    
}
