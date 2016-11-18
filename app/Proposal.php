<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    // TO DO 18/11/2016 : Make model for proposal
    public $timestamps = false ;

    protected $fillable = [
    		'picture', 'description', 'status', 'id_order', 'created_at'
    		] ;
}
