<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('player_id');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('form');
            $table->float('total_points');
            $table->string('influence');
            $table->string('creativity');
            $table->string('threat');
            $table->string('ict_index');
            $table->string('web_name');
            $table->boolean('in_dreamteam');
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
        Schema::dropIfExists('players');
    }
}
