<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class POheader extends Model
{
    //
    public $table = 'purchase_order_headers';
    public $fillable = ['store_id','seller','ship_id','ship_cost','order_date','tax_cost','discount','total_duel','amount','customer_id'];
}
