<?php

namespace App\Form;

use App\Entity\Site;
use App\Entity\Media;
use App\Form\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Vich\UploaderBundle\Form\Type\VichImageType;


class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, ["attr"=>["class"=>"form-control"]])
            ->add('grandeVilleProche', null,["attr"=>["class"=>"form-control"]])
            ->add('villeLaPlusProche', null, ["attr"=>["class"=>"form-control"]])
            ->add('exposition', ChoiceType::class, array(
                'choices' => array(
                    'N' => 'N',
                    'NE ' => 'NE',
                    'E ' => 'E',
                    'SE ' => 'SE',
                    'S ' => 'S',
                    'SW ' => 'SW',
                    'W ' => 'W',
                    'NW ' => 'NW',
                    'toutes ' => 'toutes',
                    
                    
                ),
                // 'choices_as_values' => true, 
                'multiple' => true, 
                'expanded' => true
               
                    ))
            ->add('altitudeAuxPiedsdesVoies', null, ["attr"=>["class"=>"form-control"]])
            ->add('dureeMarcheAproche', null, ["attr"=>["class"=>"form-control"]])
            ->add('profilMarcheApproche', ChoiceType::class,
            array(
                    'choices' => array(
                        'Non connue'=>'Non connue',
                        "en montée facile"=>"en montée facile",
                        "en montée"=>"en montée",
                        "en montée raide" => "en montée raide",
                        "en descente facile"=> "en descente facile",
                        "en descente"=>"en descente",
                        "en descente raide"=>"en descente raide",
                        "sur du plat"=>"sur du plat",
                        "en rappel"=>"en rappel",
                        "par tyrolienne"=>"par tyrolienne", 
                        "en bateau"=>"en bateau",
                        "en montée et descente"=>"en montée et descente", 
                        "en montée et descente facile"=>"en montée et descente facile", 
                        "en montée et descente raide"=>"en montée et descente raide",
                        "en descente et montée"=> "en descente et montée",
                        "en descente et montée facile"=>"en descente et montée facile",
                        "en descente et montée raide"=>"en descente et montée raide",
                        "en télésiège"=>"en télésiège", 
                        "par pont de singe"=>"par pont de singe",
                )))
            ->add('practicabiitePiedsdesVoies', ChoiceType::class,
            array(
                    'choices' => array(
                        'Non connu'=>'Non connu',
                        "confortable"=>"confortable",
                        "correct"=>"correct",
                        "accidenté" => "accidenté",
                        "dangereux"=> "dangereux",
                )))
            ->add('latitude', null, ["attr"=>["class"=>"form-control"]])
            ->add('longitude', null, ["attr"=>["class"=>"form-control"]])
            ->add('nombreFalaise', null, ["attr"=>["class"=>"form-control"]])
            ->add('hauteurMax', null, ["attr"=>["class"=>"form-control"]])
            ->add('typeEscalade', ChoiceType::class, array(
                'choices' => array(
                    'Bloc ' => 'Bloc',
                    'Voies d\'une longueur ' => 'Voies d\'une longueur',
                    'Voies de plusieurs longueurs' => 'Voies de plusieurs longueurs',
                    'Psychobloc ' => 'Psychobloc',
                    'Structure Artificielle d\'Escalade gratuite et libre d\'accès' => 'Structure Artificielle d\'Escalade gratuite et libre d\'accès',
                    ),
                // 'choices_as_values' => true, 
                'multiple' => true, 
                'expanded' => true
                    ))
        
                 
            ->add('typeEquipement', ChoiceType::class, array(
                'choices' => array(
                    'sportif' => 'sportif',
                    'engagé ' => 'engagé',
                    'terrain d\'aventure' => 'terrain d\'aventure',
                    'moulinette' => 'moulinette',
                ),
                // 'choices_as_values' => true, 
                'multiple' => true, 
                'expanded' => true
                    ))
        
            ->add('nombredeVoie', ChoiceType::class,
            array(
                    'choices' => array(
                        'moins de 10 voies' =>'moins de 10 voies', 
                        'entre 10 et 25 voies' => 'entre 10 et 25 voies',
                        'entre 25 et 50 voies' => 'entre 25 et 50 voies',
                        'entre 50 et 100 voies' => 'entre 50 et 100 voies',
                        'plus de 100 voies' => 'plus de 100 voies',
                        'plus de 200 voies' => 'plus de 200 voies',
                        'plus de 300 voies' => 'plus de 300 voies',
                        'plus de 400 voies' => 'plus de 400 voies',
                        'plus de 500 voies' => 'plus de 500 voies',
                        'plus de 1000 voies' => 'plus de 1000 voies',
                        'nombre de voies inconnu' => 'nombre de voies inconnu',
                )))
            ->add('difficulte', ChoiceType::class,
            array(
                    'choices' => array(
                        '3a' =>'3a', 
                        '3b' =>'3b', 
                        '3c' =>'3c', 
                        '4a' =>'4a', 
                        '4b' =>'4b', 
                        '4c' =>'4c', 
                        '5a' =>'5a', 
                        '5b' =>'5b', 
                        '5c' =>'5c', 
                        '6a' =>'6a', 
                        '6b' =>'6b', 
                        '6c' =>'6c', 
                        '7a' =>'7a', 
                        '7a+' =>'7a+', 
                        '7b' =>'7b', 
                        '7b+' =>'7b+', 
                        '7c' =>'7c', 
                        '7c+' =>'7c+', 
                        '8a' =>'8a', 
                        '8a+' =>'8a+', 
                        '8b' =>'8b', 
                        '8b+' =>'8b+', 
                        
                )))
            ->add('difficulte2', ChoiceType::class,
            array(
                    'choices' => array(
                        '3a' =>'3a', 
                        '3b' =>'3b', 
                        '3c' =>'3c', 
                        '4a' =>'4a', 
                        '4b' =>'4b', 
                        '4c' =>'4c', 
                        '5a' =>'5a', 
                        '5b' =>'5b', 
                        '5c' =>'5c', 
                        '6a' =>'6a', 
                        '6b' =>'6b', 
                        '6c' =>'6c', 
                        '7a' =>'7a', 
                        '7a+' =>'7a+', 
                        '7b' =>'7b', 
                        '7b+' =>'7b+', 
                        '7c' =>'7c', 
                        '7c+' =>'7c+', 
                        '8a' =>'8a', 
                        '8a+' =>'8a+', 
                        '8b' =>'8b', 
                        '8b+' =>'8b+', 
                )))
            ->add('siteInteressantpourGrimpeur', ChoiceType::class, array(
                'choices' => array(
                    'Débutants (suffisamment de voies du 3a au 5c)' => 'Débutants (suffisamment de voies du 3a au 5c)',
                    'Amateurs (suffisamment de voies du 6a au 6c) ' => 'Amateurs (suffisamment de voies du 6a au 6c)',
                    'Confirmés (suffisamment de voies du 7a au 7c)' => 'Confirmés (suffisamment de voies du 7a au 7c)',
                    'De haut niveau (suffisamment de voies de 8a et plus)' => 'De haut niveau (suffisamment de voies de 8a et plus)',
                    ),
                // 'choices_as_values' => true, 
                'multiple' => true, 
                'expanded' => true
                    ))
        
            ->add('typeRocher', ChoiceType::class,
            array(
                    'choices' => array(
                        'Andésite' =>'Andésite',
                        'Ardoise' =>'Ardoise',
                        'Basalte' =>'Basalte',
                        'Calcaire' =>'Calcaire',
                        'Calcaire (Dolomie)' =>'Calcaire (Dolomie)',
                        'Calcaire (Molasse)' =>'Calcaire (Molasse)',
                        'Calcaire (Pierre de Castrie)' =>'Calcaire (Pierre de Castrie)',
                        'Cargneule' =>'Cargneule',
                        'Composite' =>'Composite',
                        'Conglomérat' =>'Conglomérat',
                        'Craie' =>'Craie',
                        'Dacite' =>'Dacite',
                        'Diorite' =>'Diorite',
                        'Dolerite' =>'Dolérite',
                        'Gabbro' =>'Gabbro',
                        'Gneiss' =>'Gneiss',
                        'Granite' =>'Granite',
                        'Granulit' =>'Granulite',
                        'Grès' =>'Grès',
                        'Grès armoricain' =>'Grès armoricain',
                        'Gritstone' =>'Gritstone',
                        'Marbre' =>'Marbre',
                        'Meulière' =>'Meulière',
                        'Micaschiste' =>'Micaschiste',
                        'Migmatite' =>'Migmatite',
                        'Norite' =>'Norite',
                        'Ophiolite' =>'Ophiolite',
                        'Paragneiss' =>'Paragneiss',
                        'Phonolithe' =>'Phonolithe',
                        'Porphyre' =>'Porphyre',
                        'Quartz' =>'Quartz',
                        'Quartzite' =>'Quartzite',
                        'Résine' =>'Résine',
                        'Rhyolite' =>'Rhyolite',
                        'Roche volcanique' =>'Roche volcanique',
                        'Schiste' =>'Schiste',
                        'Serpentine' =>'Serpentine',
                        'Silex' =>'Silex',
                        'Trachy-Andésite' =>'Trachy-Andésite',
                        'Trachyte' =>'Trachyte',
                        'Tuf' =>'Tuf',
                        'Verrucano' =>'Verrucano',
                        'Autre' =>'Autre',	
                        'In Stock' => true,//permet les selection multiple
                        'Out of Stock' => false,	//permet les selection multiple		     
                    ),'multiple' => true, //liste déroulante
                    'expanded' => false,//liste déroulante
                   
                    ))
            ->add('profileFalaise', ChoiceType::class, array(
                'choices' => array(
                    'dalle' => 'dalle',
                    'vertical ' => 'vertical',
                    'dévers' => 'dévers',
                    'surplomb ' => 'surplomb',
                    'dièdre' => 'dièdre',
                    ),
                'multiple' => true, //checkbox
                'expanded' => true//checkbox
                    ))
        
            ->add('typedePrise', ChoiceType::class, array(
                'choices' => array(
                    'àplats ' => 'àplats',
                    'cannelures ' => 'cannelures',
                    'colonnettes ' => 'colonnettes',
                    'concrétions ' => 'concrétions',
                    'fissures ' => 'fissures',
                    'galets' => 'galets',
                    'gouttes d\'eau ' => 'gouttes d\'eau ',
                    'réglettes ' => 'réglettes',
                    'trous ' => 'trous',
                    'grosses prises' => 'grosses prises',
                    'inversées ' => 'inversées',
                    'verticales ' => 'verticales',
                    'tafonis' => 'tafonis'
                ),
                'multiple' => true, 
                'expanded' => true
                    ))
        
            ->add('restriction', null, ["attr"=>["class"=>"form-control"]])
            ->add('infoSuplementaire', null, ["attr"=>["class"=>"form-control"]])
            ->add('siteInternet', null, ["attr"=>["class"=>"form-control"]])
            ->add('voieMythique', null, ["attr"=>["class"=>"form-control"]])
            ->add('nomprenompseudo', null, ["attr"=>["class"=>"form-control"]])
            ->add('adresseMail', null, ["attr"=>["class"=>"form-control"]])
            ->add('meilleurperiode')
            ->add('site', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' =>false, 
                'required' => false
            ])
            // ->add('images')
            // ->add('imageFile', VichImageType::class, [
            //     "required"=>false,
            //     'allow_delete'=>true,
            //     'delete_label'=>"supprimer l'image téléchargée",
            //     "download_uri"=>false, 
            //     'image_uri'=>true, 
            //     'asset_helper'=> false, 
            //     'help'=>"test",
            //     'label'=>"Fichier",
            // ])
            // ->add('media', MediaType::class,[])
            // ->add('image', EntityType::class, [
            //     "class"=>Media::class, 
            //     "choice_label"=>"titre",
            //     "expanded"=>true, //bouton radio ou checkbox
            //     "multiple"=>true
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Site::class,
            "allow_extra_fields" => true


            // 'media' => null,
        ]);
    }
}
