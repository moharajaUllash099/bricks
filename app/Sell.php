<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    protected $fillable = [
        'customer','inv','sell_date','delivery_man','shift',
        'cat','product','uint_price','quantity','unit','subtotal',
        'create_by','updated_by','branch',
    ];
}
