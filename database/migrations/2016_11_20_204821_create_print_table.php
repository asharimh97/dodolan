<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 20/11/2016 : Make table to store the printed order
        Schema::create('order_prints', function(Blueprint $table){
            $table->increments('id') ;
            $table->integer('id_order')->unsigned() ;
            $table->text('brief') ;
            $table->dateTime('print_at') ;
            $table->string('resi') ;
            $table->enum('status', ['Waiting', 'Print Process', 'Printed', 'Delivered']) ;
        }) ;

        Schema::table('order_prints', function(Blueprint $table){
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
        // TO DO 20/11/2016 : Drop table prints
        Schema::drop('order_prints') ;
    }
}
