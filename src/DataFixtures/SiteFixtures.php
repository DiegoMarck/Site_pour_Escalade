<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Site;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SiteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'un site
        $site = new Site();
        $site->setNom('Nom');
        $site->setGrandeVilleProche('nom grande ville');
        // $site->setImage(new UploadedFile('path/to/file', 'file.jpg', 'image/jpeg', null, true));
       
        $manager->persist($site);
        $manager->flush();
    }
}
