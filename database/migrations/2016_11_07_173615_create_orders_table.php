<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 7/11/2016 : Make orders table
        Schema::create('orders', function(Blueprint $table){
            $table->increments('id_order') ;
            $table->integer('id_user')->unsigned() ;
            $table->dateTime('order_at') ;
            $table->dateTime('revised_at') ;
            $table->string('id_packages') ;
            $table->string('title') ;
            $table->text('brief') ;
            $table->string('status') ;
        }) ;

        Schema::table('orders', function(Blueprint $table){
            $table->foreign('id_user')->references('id')->on('users') ;
            $table->foreign('id_packages')->references('id_packages')->on('packages')->onUpdate('cascade')->onDelete('restrict') ;
            $table->foreign('status')->references('id_status')->on('order_status')->onUpdate('cascade')->onDelete('restrict') ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 7/11/2016 : Drop orders table
        Schema::drop('orders') ;
    }
}
