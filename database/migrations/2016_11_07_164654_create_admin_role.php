<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 7/11/2016 : Make type for admin
        Schema::create('admin_roles', function(Blueprint $table){
            $table->increments('id_roles') ;
            $table->string('roles') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 7/11/2016 : Drop table type for admin
        Schema::drop('admin_roles') ;
    }
}
