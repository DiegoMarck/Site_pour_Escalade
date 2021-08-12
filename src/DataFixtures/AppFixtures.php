<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// use Faker\Factory;
class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder=$encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        //utilisation des faker
        $faker = Factory::create('fr_FR');

        //création d'un utilisateur
        $user = new User();
        $password = $this->encoder->encodePassword($user, 'password');
        $user->setEmail('user@test.com')
                ->setName($faker->LastName())
                ->setPrenom($faker->FirstName());

        $user->setPassword($faker->$password);

        $manager->persist($user);

        $manager->flush();

    }
}
