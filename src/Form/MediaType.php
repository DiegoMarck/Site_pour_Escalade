<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('image')
            ->add('imageFile', VichImageType::class, [
                "required"=>true,
                'allow_delete'=>true,
                'delete_label'=>"supprimer l'image téléchargée",
                "download_uri"=>false, 
                'image_uri'=>true, 
                'asset_helper'=> false, 
                'help'=>"test",
                'label'=>"Fichier"
            ])
            ->add('site')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,

        ]);
    }
}
