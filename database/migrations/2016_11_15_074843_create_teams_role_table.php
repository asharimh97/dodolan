<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 15/11/2016 : Make teams role table
        Schema::create('team_roles', function(Blueprint $table){
            $table->string('id_role')->unique() ;
            $table->string('role') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 15/11/2016 : Drop teams role table
        Schema::drop('team_roles') ;
    }
}
