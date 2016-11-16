<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 15/11/2016 : Make faq table
        Schema::create('faqs', function(Blueprint $table){
            $table->increments('id_faq') ;
            $table->string('title') ;
            $table->text('answer') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 15/11/2016 : Drop faq table
        Schema::drop('faqs') ;
    }
}
