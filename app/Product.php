<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable =['store_id','product_name','product_code','standard_price','selling_price','size','style'];
}
