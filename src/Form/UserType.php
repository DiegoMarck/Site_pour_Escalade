<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('email')
            // ->add('roles')
            // ->add('password')
            ->add('email', EmailType::class, [
                "label"=>"Votre couriel",
                "attr"=>[
                    "class"=>"form-control"
                ], 
                "help"=>"Votre email vous sert à vous connecter."
            ])
            ->add('password', PasswordType::class, [
                "label"=>"Votre mot de passe",
                "attr"=>[
                    "class"=>"rouge form-control"
                ]
            ])
            ->add('pseudo', null, [
                "label"=>"Votre mot de pseudo",
                "attr"=>[
                    "class"=>"rouge form-control"
                ], 
                "help"=>"ce pseudo s'affichera pour vos commentaires."
            ])
        ;
        
        if($options["isAdmin"] == true ) {
            $builder->add('roles', ChoiceType::class, [
                'choices'=>[
                    "Rôle administrateur"=>"ROLE_ADMIN",
                    // "Rôle utilisateur"=>"ROLE_USER"
                ],
                "multiple"=>true,
                "expanded"=>true
            ]);       
        }
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'isAdmin'=>false
        ]);
    }
}
