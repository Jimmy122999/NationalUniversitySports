<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixtureResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixture_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('fixture_id');
            $table->unsignedBigInteger('home_team_score');
            $table->unsignedBigInteger('away_team_score');
            $table->unsignedBigInteger('home_man_of_the_match_id')->nullable();
            $table->unsignedBigInteger('away_man_of_the_match_id')->nullable();
            $table->timestamps();

            $table->foreign('home_man_of_the_match_id')
            ->references('id')
            ->on('team_members')
            ->onDelete('cascade');

            $table->foreign('away_man_of_the_match_id')
            ->references('id')
            ->on('team_members')
            ->onDelete('cascade');

            $table->foreign('fixture_id')
            ->references('id')
            ->on('fixtures')
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
        Schema::dropIfExists('fixture_results');
    }
}
