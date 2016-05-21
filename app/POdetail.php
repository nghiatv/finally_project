<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class POdetail extends Model
{
    public $table = "purchase_order_details";
    public $fillable =['po_id','pid','unit_price','quantity'];
    //
}
