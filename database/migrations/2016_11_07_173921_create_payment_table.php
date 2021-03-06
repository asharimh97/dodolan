<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 7/11/2016 : Make a database for payment
        Schema::create('payments', function(Blueprint $table){
            $table->integer('id_order')->unsigned()->unique() ;
            $table->string('picture') ;
            $table->enum('payment_status', ['Not paid','On process', 'Confirmed', 'Rejected']) ;
            $table->dateTime('payment_date') ;
        }) ;

        Schema::table('payments', function(Blueprint $table){
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
        // TO DO 7/11/2016 : Drop payment table
        Schema::drop('payments') ;
    }
}
