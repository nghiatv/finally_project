<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $table = 'customers';
    public $fillable = ['store_id','name','email','address','phone','description'];
}
