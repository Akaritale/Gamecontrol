<?php

namespace GCTL\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class Shutdown extends Command
{
    use LockableTrait;

    protected static $defaultName = 'shutdown';

    protected function configure(): void
    {
        $this->setDescription('Gracefully shutdown the server.');
        $this->addArgument('group', InputArgument::OPTIONAL, 'Select which service\'s should be checked.', 'all');
        $this->addOption('force', null, InputArgument::OPTIONAL, 'Force server to stop by killing process with SIGID 9.', false);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');
            return Command::SUCCESS;
        }

        $io = new SymfonyStyle($input, $output);
        $force = (bool)$input->getOption('force');
        if($force) {
            $io->caution('You are about to force kill the server. In the worst case data loss could happen or worse.');
            if (!$io->confirm('Do you want to force shutdown the server?', false)) {
                $io->info('Shutdown process cancelled.');
                return Command::SUCCESS;
            }
        }







        if($io->confirm('Release lock?')) {
            $this->release();
        }

        return Command::SUCCESS;
    }
}