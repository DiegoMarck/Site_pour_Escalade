<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users=[//on a rajouté les user et admin
            ["Laura",  "user1@user1.fr", "mdp", "ROLE_USER"], 
            ["Vincent", "user2@user2.fr", "mdp", "ROLE_USER"], 
            ["Lydia",  "user3@user3.fr", "mdp", "ROLE_USER"], 
            ["Diego",  "admin@admin.fr", "mdp", "ROLE_ADMIN"], 
            ["Florence", "admin2@admin2.fr", "mdp", "ROLE_ADMIN"], 
            ["Marc",  "admin3@admin3.fr", "mdp", "ROLE_ADMIN"] 
        ];
        foreach( $users as $u ){
            $user = new User();
            $password = $this->passwordHasher->hash($u[2]);
            $user->setPseudo( $u[0])
            ->setEmail($u[1])
            ->setPassword( $password )
            ->setRoles([ $u[3] ]);

            $manager->persist($user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();

        
    }
    
    // public function load(ObjectManager $manager)
    // {
    //     //utilisation des faker
    //     $faker = Factory::create('fr_FR');

    //     //création d'un utilisateur
    //     $user = new User();
    //     $password = $this->encoder->encodePassword($user, 'password');
    //     $user->setEmail('user@test.com')
    //             ->setName($faker->LastName())
    //             ->setPrenom($faker->FirstName());

    //     $user->setPassword($faker->$password);

    //     $manager->persist($user);

    //     $manager->flush();

    // }
}
