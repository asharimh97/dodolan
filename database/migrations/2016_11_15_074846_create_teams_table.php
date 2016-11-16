<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 15/11/2016 : Make teams table
        Schema::create('teams', function(Blueprint $table){
            $table->increments('id_team') ;
            $table->string('name') ;
            $table->text('bio') ;
            $table->string('prof_pic') ;
            $table->string('id_role') ;
            $table->string('youtube') ;
            $table->string('facebook') ;
            $table->string('twitter') ;
            $table->string('instagram') ;
            $table->string('google') ;
        }) ;

        Schema::table('teams', function(Blueprint $table){
            $table->foreign('id_role')->references('id_role')->on('team_roles')->onUpdate('cascade')->onDelete('restrict') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 15/11/2016 : Drop teams table
        Schema::drop('teams') ;
    }
}
