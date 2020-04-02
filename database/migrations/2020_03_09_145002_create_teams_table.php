<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('captain_id')->nullable();
            $table->unsignedBigInteger('played')->nullable();
            $table->unsignedBigInteger('wins')->nullable();
            $table->unsignedBigInteger('draws')->nullable();
            $table->unsignedBigInteger('losses')->nullable();
            $table->unsignedBigInteger('points')->nullable();

            $table->timestamps();


            $table->foreign('division_id')
            ->references('id')
            ->on('divisions')
            ->onDelete('cascade');

            $table->foreign('captain_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
