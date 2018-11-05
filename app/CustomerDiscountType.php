<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerDiscountType extends Model
{
    protected $fillable = [
        'type','discount'
    ];
}
