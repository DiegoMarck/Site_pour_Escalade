<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Form\SiteType;
use App\Form\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
            IntegerField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('nom'),
            TextField::new('grandeVilleProche'),
            TextField::new('villeLaPlusProche'),
            ArrayField::new('exposition'),
            IntegerField::new('altitudeAuxPiedsdesVoies'),
            IntegerField::new('dureeMarcheAproche'),
            TextField::new('profilMarcheApproche'),
            TextField::new('practicabiitePiedsdesVoies'),
            NumberField::new('latitude'),
            NumberField::new('longitude'),
            IntegerField::new('nombreFalaise'),
            IntegerField::new('hauteurMax'),
            ArrayField::new('typeEscalade'),
            ArrayField::new('typeEquipement'),
            TextField::new('nombredeVoie'),
            TextField::new('difficulte'),
            TextField::new('difficulte2'),
            ArrayField::new('siteInteressantpourGrimpeur'),
            ArrayField::new('typeRocher'),
            ArrayField::new('profileFalaise'),
            ArrayField::new('typedePrise'),
            TextField::new('restriction'),
            TextField::new('infoSuplementaire'),
            TextField::new('siteInternet'),
            TextField::new('voieMythique'),
            TextField::new('nomprenompseudo'),
            TextField::new('adresseMail'),
            TextField::new('adresseMail'),
            ArrayField::new('meilleurperiode'),
            TextField::new('imageFile')->setFormType(VichImageType::class),
            ImageField::new('images')->setBasePath('/uploads/sites')->onlyOnIndex(),
            
                
            CollectionField::new('media')
                ->setEntryType(MediaType::class)
                ->setFormTypeOption('by_reference', false)
                ->onlyOnForms(),
            CollectionField::new('media')
                ->setTemplatePath('site/images.html.twig')
                ->onlyOnDetail()

            // AssociationField::new('media'),
           
        ];
        if ($pageName == CRUD::PAGE_INDEX || $pageName == CRUD::PAGE_DETAIL) {
            $field[] = $images;
        } else {
            $field[] = $imageFile;
        }
        return $fields;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['createdAt' => 'DESC']);
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(CRUD::PAGE_INDEX, 'detail');
    }
}
