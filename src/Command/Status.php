<?php

namespace GCTL\Command;

use GCTL\Process\Binary\DB;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Status extends Command
{
    protected static $defaultName = 'status';

    protected function configure(): void
    {
        $this->setDescription('Checks DB status.');
        $this->addArgument('group', InputArgument::OPTIONAL, 'Select which service\'s should be checked.', 'all');
        $this->addOption('extended', null, InputArgument::OPTIONAL, 'If selected, the process will be matched against our runtime.', true);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Trying to detect status...');

        $status = DB::ProcessStatus();




        return 0;
    }
}