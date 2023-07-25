<?php

namespace App\console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * MigrateCommand
 */
class MigrateCommand extends Command
{
    protected static $defaultName = 'migrate';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addOption('rollback', null, InputOption::VALUE_NONE, 'Roll back the last database migration');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach (glob(__DIR__ . '/migration/*.php') as $filename) {
            require_once $filename;
            $class = 'App\\console\\migration\\' . basename($filename, '.php');
            $migration = new $class();
            if ($input->getOption('rollback')) {
                $migration->down();
                $output->writeln('Rolled back ' . $class);
            } else {
                $migration->up();
                $output->writeln('Migrated ' . $class);
            }
        }

        return Command::SUCCESS;
    }
}
