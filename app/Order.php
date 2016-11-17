<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // TO DO 8/11/2016 : Make full model for table orders
    public $timestamps = false ;

    protected $fillable = [
    	'id_user', 'order_at', 'revised_at', 'id_packages', 'id_jenis', 'title', 'brief', 'price', 'status'
    ] ;
}
