<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 7/11/2016 : Create testimonial table
        Schema::create('testimonials', function(Blueprint $table){
            $table->increments('id_testi') ;
            $table->integer('id_user')->unsigned() ;
            $table->text('testimoni_desc') ;
            $table->integer('rating')->length(2) ;
            $table->string('unique_code') ; // to make user only able to give testi once a project
        }) ;

        Schema::table('testimonials', function(Blueprint $table){
            $table->foreign('id_user')->references('id')->on('users') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 7/11/2016 : Drop testimonial table
        Schema::drop('testimonials') ;
    }
}
