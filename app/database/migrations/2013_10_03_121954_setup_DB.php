<?php

use Illuminate\Database\Migrations\Migration;

class SetupDB extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oils', function($table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('info');
            $table->float('price');
            $table->float('compare_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('oils');
    }

}
