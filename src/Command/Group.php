<?php

namespace GCTL\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Group extends Command
{
    protected static $defaultName = 'groups';

    protected function configure(): void
    {
        $this->setDescription('List all available process groups.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table
            ->setHeaders(['Group', 'Process'])
            ->setRows([
                ['db', 'DB'],
                ['auth', 'Auth'],
                ['minimal', 'DB/Auth'],
                ['channel', 'CH99/CH1/CH2/CH3/CH4'],
                ['all', 'DB/Auth/CH99/CH1/CH2/CH3/CH4'],
            ])
        ;
        $table->render();
        
        return 0;
    }
}