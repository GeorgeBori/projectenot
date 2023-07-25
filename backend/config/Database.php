<?php

namespace App\config;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Database
 */
class Database
{
    /**
     * @var Capsule
     */
    protected $capsule;

    public function __construct()
    {
        $this->capsule = new Capsule();

        $this->capsule->addConnection([
            'driver' => 'pgsql',
            'host' => $_ENV['DB_HOST'],
            'database' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    /**
     * @return Capsule
     */
    public function getCapsule()
    {
        return $this->capsule;
    }
}
