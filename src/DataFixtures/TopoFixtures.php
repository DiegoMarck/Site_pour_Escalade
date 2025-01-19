<?php

namespace App\DataFixtures;

use App\Entity\Topo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TopoFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'un média
        $topo = new Topo();
        $topo->setTitre('Titre');
        $topo->setPays('Pays');
        // $media->setImage(new UploadedFile('path/to/file', 'file.jpg', 'image/jpeg', null, true));
       
        $manager->persist($topo);
        $manager->flush();
    }
}