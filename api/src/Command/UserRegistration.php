<?php

declare(strict_types=1);

namespace App\Command;

use App\Services\Authentication\RegistrationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class UserRegistration extends Command
{
    protected static $defaultName = 'app:create-user';
    protected static string $defaultDescription = 'Command for user registration by CLI interface';

    private RegistrationService $service;

    public function __construct(RegistrationService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('email', InputArgument::REQUIRED, 'User email')
            ->addArgument('password', InputArgument::REQUIRED, 'User password')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * @psalm-suppress RedundantCast
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = (string)($input->getArgument('email'));
        $password = (string)($input->getArgument('password'));

        $this->service->register($email, $password);

        return Command::SUCCESS;
    }
}
