<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisDesign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TO DO 7/11/2016 : Membuat tabel jenis desain yang ada
        Schema::create('jenis_designs', function(Blueprint $table){
            $table->increments('id_design') ;
            $table->string('jenis_design', 50) ;
        }) ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TO DO 7/11/2016 : Drop table
        Schema::drop('jenis_designs') ;
    }
}
