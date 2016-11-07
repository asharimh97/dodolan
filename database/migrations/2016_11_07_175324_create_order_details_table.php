<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 7/11/2016 : Make order detail table
        Schema::create('order_details', function(Blueprint $table){
            $table->integer('id_order')->unsigned() ;
            $table->integer('id_portfolio_sample')->unsigned() ;
        }) ;

        Schema::table('order_details', function(Blueprint $table){
            $table->foreign('id_order')->references('id_order')->on('orders') ;
            $table->foreign('id_portfolio_sample')->references('id_portfolios')->on('portfolios') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 7/11/2016 : Drop order detail table
        Schema::drop('order_details') ;
    }
}
