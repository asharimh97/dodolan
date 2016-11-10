<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    // TO DO 10/11/2016 : Make a testimonials model to store data

	// disable timestamps default storing value
	public $timestamps = false ;

	/**
	*
	* Store data to database on table testimonial
	* @var array
	*
	*/

    protected $fillable = [
    	'id_user', 'testimoni_desc', 'rating', 'unique_code'
    ] ;
}
