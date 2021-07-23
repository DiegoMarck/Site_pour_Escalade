<?php

namespace App\Form;

use App\Entity\Topo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TopoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', null, ["attr"=>["class"=>"form-control"]])
            ->add('pays', null, ["attr"=>["class"=>"form-control"]])
            ->add('region', null, ["attr"=>["class"=>"form-control"]])
            ->add('datedeParution', null, ["attr"=>["class"=>"form-control"]])
            ->add('datedeMiseajour', null, ["attr"=>["class"=>"form-control"]])
            ->add('prix', null, ["attr"=>["class"=>"form-control"]])
            ->add('auteur', null, ["attr"=>["class"=>"form-control"]])
            ->add('description', null, ["attr"=>["class"=>"form-control"]])
            ->add('type', null, ["attr"=>["class"=>"form-control"]])
            ->add('image', null, ["attr"=>["class"=>"form-control"]])
            ->add('imageFile', VichImageType::class, [
                "required"=>false,
                'allow_delete'=>true,
                'delete_label'=>"supprimer l'image téléchargée",
                "download_uri"=>false, 
                'image_uri'=>true, 
                'asset_helper'=> false, 
                'help'=>"test",
                'label'=>"Fichier"
            ])
            // ->add('maj')
            ->add('nomSite', null, ["attr"=>["class"=>"form-control"]])
            // ->add('media', MediaType::class,[])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Topo::class,
        ]);
    }
}
