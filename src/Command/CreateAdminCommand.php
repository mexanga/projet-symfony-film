<?php

namespace App\Command;

use App\Entity\Editor;
use App\Entity\Game;
use App\Entity\User;
use App\Entity\Platform;
use App\Repository\EditorRepository;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use App\Repository\PlatformRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class CreateAdminCommand extends Command
{
    protected static $defaultName = 'app:create-admin';

    private $encoder;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
          ->setDescription('Créer un compte administrateur')
          ->addArgument('email', InputArgument::REQUIRED, 'Mail')
          ->addArgument('password',InputArgument::REQUIRED, 'Mot de passe')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion("Confirm? [y,n]",false,'/^(y|j)/i');

        if (!$helper->ask($input,$output,$question)) {
            return 0;
        }

        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $user = new User();
        $user->setEmail($email);
        $user->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->encoder->encodePassword($user, $password);
        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('Admin created successfully !');

        return 0;
    }
}
