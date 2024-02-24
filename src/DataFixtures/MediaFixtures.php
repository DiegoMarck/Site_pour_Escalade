<?php

// namespace App\DataFixtures;

// use Faker\Factory;
// use App\Entity\Media;
// use App\DataFixtures;
// use Doctrine\Persistence\ObjectManager;
// use Doctrine\Bundle\FixturesBundle\Fixture;
// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// class MediaFixtures extends Fixture
// {
//     public function load(ObjectManager $manager)
//     {
//         $media = new Media();
//         $media->setNom('Nom de mon image');
//         $media->setDescription('Une description');
       

//         $manager->persist($media);
//         $manager->flush();
//     }
        
// }
    
namespace App\DataFixtures;

use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MediaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $media = new Media();
        $media->setNom('Nom de mon image');
        $media->setDescription('Une description');
       

        $manager->persist($media);
        $manager->flush();
    }
}