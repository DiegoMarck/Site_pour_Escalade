<?php

namespace App\Controller\Admin;

use App\Entity\Topo;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TopoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Topo::class;
    }

    
    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         IdField::new('id')->onlyOnIndex(),
    //         TextField::new('titre'),
    //         TextField::new('pays'),
    //         ArrayField::new('region'),
    //         DateField::new('datedeParution'),
    //         DateField::new('datedeMiseajour'),
    //         TextEditorField::new('description'),
    //         ArrayField::new('type'),
    //         ImageField::new('images')->setBasePath('/uploads/sites')->onlyOnIndex(),

    //     ];
    // }
    
}
