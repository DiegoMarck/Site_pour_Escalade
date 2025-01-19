<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'app:create-admin';
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function configure()
    {
        $this->setDescription('Creates a new admin user');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setPseudo('Admin');
        $user->setName('Admin');  // Ajout du champ name obligatoire
        $user->setPrenom('Admin');  // Ajout du prénom (nullable mais on le met quand même)
        $user->setRoles(['ROLE_ADMIN']);
        
        $password = $this->passwordEncoder->encodePassword($user, 'admin123');
        $user->setPassword($password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('Admin user has been created! Email: admin@example.com, Password: admin123');

        return Command::SUCCESS;
    }
}