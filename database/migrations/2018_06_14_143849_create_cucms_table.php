<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCucmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cucms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('ip')->unique();
            $table->string('user');
            $table->string('password');
            $table->string('version');
            $table->boolean('verify_peer');
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
        Schema::dropIfExists('cucms');
    }
}
