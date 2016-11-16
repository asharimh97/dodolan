<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // TO DO 15/11/2016 : Model for feedbacks

    public $timestamps = false ;

    protected $fillable = [
    		'title', 'name', 'email', 'feedback', 'created_at'
    ] ;
}
