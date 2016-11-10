<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    // TO DO 8/11/2016 : Make overall model for admin table
	/**
	* Atribut yang bisa dimasukkan ke dalam database
	*
	* @var array
	*/
    protected $fillable = [
    	'nama', 'username', 'password', 'email', 'gender', 'telp', 'prof_pic', 'role_id'
    ] ;

    /**
    * Atribut yang disembunyikan untuk keamanan data
    *
    * @var array
    */

    protected $hidden = [
    	'password', 'remember_token'
    ] ;
}
