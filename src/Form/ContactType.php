<?php

namespace App\Form;
// namespace AppBundle\Form;

// use App\Entity\Article;
// use App\Form\ContactType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options["user"];//pour récupérer l'utilisateur connecté

        // $test = $user? " user est null" : " user n'est pas null";
        //    condition ?   résultat si oui - résultat si non
        $builder
            ->add('name', null, [
                "required"=>true,
                "label"=>"Nom et prenom",
                "data"=> $user ? $user->getPseudo() : "" 
            ])
            ->add('message', TextareaType::class, [
                "attr"=>[
                    "cols"=>100,
                    "rows"=>6
                ]
            ], ["attr"=>["class"=>"form-control"]])
            ->add('email', EmailType::class, [
                "required"=>false,
                "data"=>$user ? $user->getEmail() : ""
            ], ["attr"=>["class"=>"form-control"]])
            ->add('telephone', TelType::class, [
                
            ], ["attr"=>["class"=>"form-control"]])
            // ->add('imageFile', VichImageType::class, [
            //     'label' => 'upload ton image pour le concours',
            //     "required"=>true,
            //     'allow_delete'=>true,
            //     'delete_label'=>"supprimer l'image téléchargée",
            //     "download_uri"=>false, 
            //     'image_uri'=>true, 
            //     'asset_helper'=> false, 
            //     'help'=>"test",
            //     'label'=>"Fichier"
            // ], null, ["attr"=>["class"=>"form-control"]])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
            "user"=>null, //il faut donner une valeur null par défaut à l'utilisateur
        ]);
    }
}
