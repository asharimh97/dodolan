<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    // TO DO 8/11/2016 : Make full model for portfolio table

    /**
    *
    * $fillable field stored in database
    *
    * @var array
    *
    */
    public $timestamps = false ;
    protected $fillable = [
    	'title', 'description', 'id_user', 'rating', 'id_jenis_design', 'picture'
    ] ;

}
