<?php

namespace App\Controller\Admin;

use App\Entity\Topo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TopoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Topo::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
