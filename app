#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use App\console\CurrencyFetchCommand;
use App\console\MigrateCommand;
use Symfony\Component\Console\Application;

$dotenv = Dotenv::createMutable(__DIR__);
$dotenv->load();

require_once __DIR__ . '/backend/config/Database.php';

$application = new Application();
$application->addCommands([
    new MigrateCommand(),
    new CurrencyFetchCommand(),
]);

try {
    $application->run();
} catch (Exception $e) {
    echo 'Error console: ' . $e->getMessage();
}
