<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 7/11/2016 : Make admin table
        Schema::create('admins', function(Blueprint $table){
            $table->increments('id') ;
            $table->string('nama') ;
            $table->string('username')->unique() ;
            $table->string('password') ;
            $table->string('email')->unique() ;
            $table->enum('gender', ['Laki laki', 'Perempuan']) ;
            $table->string('telp', 15) ;
            $table->string('prof_pic') ;
            $table->integer('role_id')->unsigned() ;
            $table->rememberToken() ;
            $table->timestamps() ;
        }) ;

        Schema::table('admins', function(Blueprint $table){
            $table->foreign('role_id')->references('id_roles')->on('admin_roles')->onUpdate('cascade')->onDelete('restrict') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 7/11/2016 : drop admin table
        Schema::drop('admins') ;
    }
}
