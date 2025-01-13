<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Création d'un média
        $user = new User();
        $user->setEmail('Email');
        $user->setPassword('Mot de passe');
        // $media->setImage(new UploadedFile('path/to/file', 'file.jpg', 'image/jpeg', null, true));
       

        $manager->persist($user);
        $manager->flush();
    }
        
}