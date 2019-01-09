<?php

namespace App\Command;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;

class UserCreateCommand extends Command
{
    protected static $defaultName = 'user:create';

    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        parent::__construct();
    }
    
    private $passwordEncoder;
    
    protected function configure()
    {
        $this
            ->setDescription('Add a user login to admin')
            ->addArgument('username', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = new User;
        
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        
        $user->setUsername($username);
        
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $password);
        $user->setPassword($encodedPassword);
        
        $username = $input->getArgument('username');
        $user->setUsername($username);
        
        $this->entityManager->persist($user);
        $this->entityManager->flush($user);
        
    }
}
