<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Topo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TopoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création d'un média
        $topo = new Topo();
        $topo->setTitre('Titre');
        $topo->setPays('Pays');
        // $media->setImage(new UploadedFile('path/to/file', 'file.jpg', 'image/jpeg', null, true));
       

        // $manager->persist($media);
        $manager->flush();
    }
        
}