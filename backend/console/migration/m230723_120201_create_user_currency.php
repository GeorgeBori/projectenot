<?php

namespace App\console\migration;

use App\config\Database;

/**
 * m230723_120201_create_user_currency
 */
class m230723_120201_create_user_currency extends Database
{
    /**
     * @return void
     */
    public function up()
    {
        $this->getCapsule()->schema()->create('currency', function ($table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->float('rate');
            $table->integer('nominal');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        $this->getCapsule()->schema()->dropIfExists('currency');
    }
}
