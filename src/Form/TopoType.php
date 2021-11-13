<?php

namespace App\Form;

use App\Entity\Topo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('type', ChoiceType::class,
            array(
                    'choices' => array(
                        'livre'=>'livre',
                        "téléchargeable"=>"téléchargeable",
                        "en ligne"=>"en ligne",
                       
                )))
            ->add('topo', FileType::class, [
                'label' => 'photos',
                'multiple' => true,
                'mapped' =>false, 
                'required' => false
            ])
            
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


