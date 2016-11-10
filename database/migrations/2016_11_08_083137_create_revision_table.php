<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 8/11/2016 : Make revision table
        Schema::create('order_revisions', function(Blueprint $table){
            $table->increments('id_revision') ;
            $table->integer('id_order')->unsigned() ;
            $table->text('revision') ;
            $table->datetime('revision_date') ;
        }) ;

        Schema::table('order_revisions', function(Blueprint $table){
            $table->foreign('id_order')->references('id_order')->on('orders') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 8/11/2016 : Delete revision table
        Schema::drop('order_revisions') ;
    }
}
