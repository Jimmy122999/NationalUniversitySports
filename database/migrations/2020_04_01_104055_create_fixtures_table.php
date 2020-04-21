<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->dateTime('time');
            $table->text('notes')->nullable();
            $table->boolean('played');
            $table->timestamps();

            $table->foreign('division_id')
            ->references('id')
            ->on('divisions')
            ->onDelete('cascade');

            $table->foreign('home_team_id')
            ->references('id')
            ->on('teams')
            ->onDelete('cascade');

            $table->foreign('away_team_id')
            ->references('id')
            ->on('teams')
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
        Schema::dropIfExists('fixtures');
    }
}
