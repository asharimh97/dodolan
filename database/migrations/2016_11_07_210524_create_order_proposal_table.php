<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 16/11/2016 : Make proposal table to store data proposed to user when user order something
        Schema::create('proposals', function(Blueprint $table){
            $table->increments('id') ;
            $table->string('picture') ;
            $table->text('description') ;
            $table->enum('status', ['Submitted', 'Confirmed', 'Revised', 'Approved']) ;
            $table->integer('id_order')->unsigned() ;
            $table->dateTime('created_at') ;
        }) ;

        Schema::table('proposals', function(Blueprint $table){
            $table->foreign('id_order')->references('id_order')->on('orders')->onUpdate('cascade')->onDelete('cascade') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 16/11/2016 : Drop table
        Schema::drop('proposals') ;
    }
}
