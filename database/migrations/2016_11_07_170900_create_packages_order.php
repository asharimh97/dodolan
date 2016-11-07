<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 7/11/2016 : Make packages table
        Schema::create('packages', function(Blueprint $table){
            $table->string('id_packages')->unique() ;
            $table->string('packages') ;
            $table->integer('min_price') ;
            $table->integer('max_price') ;
            $table->text('description') ; // facilities of package
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 7/11/2016 : Drop packages table
        Schema::drop('packages') ;
    }
}
