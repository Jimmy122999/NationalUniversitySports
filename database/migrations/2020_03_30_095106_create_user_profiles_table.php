<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('member_id');
            $table->text('bio');
            $table->string('position');
            $table->timestamps();


           $table->foreign('user_id')
           ->references('id')
           ->on('users')
           ->onDelete('cascade');

           $table->foreign('team_id')
           ->references('id')
           ->on('teams')
           ->onDelete('cascade');

            $table->foreign('member_id')
            ->references('id')
            ->on('team_members')
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
        Schema::dropIfExists('user_profiles');
    }
}
