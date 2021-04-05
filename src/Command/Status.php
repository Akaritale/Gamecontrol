<?php

namespace GCTL\Command;

use GCTL\Process\Binary\DB;
use GCTL\Process\Exception\ProcessIdentifierMissing;
use GCTL\Process\StatusEnum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class Status extends Command
{
    protected static $defaultName = 'status';

    protected function configure(): void
    {
        $this->setDescription('Checks DB status.');
        $this->addArgument('group', InputArgument::OPTIONAL, 'Select which service\'s should be checked.', 'all');
        $this->addOption('extended', null, InputArgument::OPTIONAL, 'If selected, the process will be matched against our runtime.', true);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $status = ['db' => 'unknown'];
        $io = new SymfonyStyle($input, $output);
        $io->title('Checking server status, please wait');

        try {
            $status['db'] = DB::ProcessStatus();
        } catch (ProcessIdentifierMissing $exception) {
            $status['db'] = 'Missing PID file';
        }

        $io->definitionList($status);

        return Command::SUCCESS;
    }
}