<?php

namespace App\console;

use App\console\job\CurrencyFetchJob;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CurrencyFetchCommand
 */
class CurrencyFetchCommand extends Command
{
    protected static $defaultName = 'currency-fetch';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $currencyFetchJob = new CurrencyFetchJob();

        $currencyFetchJob->run();

        return Command::SUCCESS;
    }
}
