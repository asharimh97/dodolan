<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 7/11/2016 : Create portfolio table
        Schema::create('portfolios', function(Blueprint $table){
            $table->increments('id_portfolios') ;
            $table->string('title') ;
            $table->text('description') ;
            $table->integer('id_user')->unsigned() ;
            $table->integer('rating')->length(2) ;
            $table->integer('id_jenis_design')->unsigned() ;
            $table->string('picture') ;
        }) ;

        Schema::table('portfolios', function(Blueprint $table){
            $table->foreign('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict') ;
            $table->foreign('id_jenis_design')->references('id_design')->on('jenis_designs')->onUpdate('cascade')->onDelete('restrict') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 7/11/2016 : Drop portfolio table
        Schema::drop('portfolios') ;
    }
}
