<?php

namespace App\Command;

use App\Entity\PhysicalAccount;
use App\Entity\VirtualAccount;
use App\Repository\AccountRepository;
use App\Repository\PhysicalAccountRepository;
use App\Repository\TransactionRepository;
use App\Repository\VirtualAccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:test',
    description: 'Add a short description for your command',
)]
class TestCommand extends Command
{

    public function __construct(
        private PhysicalAccountRepository $pr,
        private VirtualAccountRepository $vr,
        private TransactionRepository $tr,
        private AccountRepository $ar,
        private EntityManagerInterface $em,
        ?string $name = null
    )
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       
        $from = $this->ar->findByName("estalvis");
        $to = $this->ar->findByName("estalvis enginyers");
        $this->tr->createNewTransaction($from, $to, "prova", "100");
        $this->em->flush();
        return Command::SUCCESS;
    }
}
