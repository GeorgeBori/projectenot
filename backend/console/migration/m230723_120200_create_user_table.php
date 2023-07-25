<?php

namespace App\console\migration;

use App\config\Database;

/**
 * m230723_120200_create_user_table
 */
class m230723_120200_create_user_table extends Database
{
    /**
     * @return void
     */
    public function up()
    {
        $this->getCapsule()->schema()->create('user', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->string('access_token');
            $table->timestamps();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        $this->getCapsule()->schema()->dropIfExists('user');
    }
}
