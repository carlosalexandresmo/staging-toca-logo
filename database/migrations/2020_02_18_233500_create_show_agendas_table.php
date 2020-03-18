<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_agendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_show')->unique();
            $table->string('id_user_show')->references('id_user')->on('user');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->string('artistic_name');
            $table->double('cache');
            $table->string('music_style');
            $table->enum('repeat_event', ['DAILY', 'WEEKLY', 'MONTHLY',]);
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
        Schema::dropIfExists('show_agendas');
    }
}
