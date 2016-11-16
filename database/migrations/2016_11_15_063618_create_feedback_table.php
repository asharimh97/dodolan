<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 15/11/2016 : Make feedback table
        Schema::create('feedbacks', function(Blueprint $table){
            $table->increments('id') ;
            $table->string('title') ;
            $table->string('name') ;
            $table->string('email') ;
            $table->text('feedback') ;
            $table->dateTime('created_at') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 15/11/2016 : Drop feedback table
        Schema::drop('feedbacks') ;
    }
}
