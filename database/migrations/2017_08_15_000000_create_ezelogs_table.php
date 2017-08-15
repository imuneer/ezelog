<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEzelogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $config = config('ezelog');
        $tableName = $config['table_name'];

        Schema::create($tableName, function (Blueprint $table) {
            $table->string('user', 32)->nullable();
            $table->dateTime('action_time');
            $table->decimal('timestamp', 14, 4);
            $table->string('from_ip', 16)->nullatable();
            $table->string('server', 64)->nullatable();
            $table->string('user_agent', 160)->nullatable();
            $table->string('uri', 120)->nullatable();
            $table->string('query', 120)->nullatable();
            $table->boolean('ezemanage_user')->nullatable(0);
            $table->string('action', 160);

            $table->primary(['user', 'timestamp', 'from_ip']);
            $table->index('action_time');
            $table->index('uri');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $config = config('ezelog');
        $tableName = $config['table_name'];

        if (Schema::hasTable($tableName)) {
            Schema::drop($tableName);
        }
    }
}
