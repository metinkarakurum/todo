<?php

namespace App\Command;


use App\Service\Task\TaskAdapter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TaskCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:task';

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }
    

    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->entityManager;

        $itTask = new TaskAdapter("it",$em);
        $itTask->createTask();
        $output->writeln('It tasks created');

        $businessTask = new TaskAdapter("business",$em);
        $businessTask->createTask();
        $output->writeln('Business tasks created');

    }
}