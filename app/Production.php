<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $fillable = [
        'inv','pro_date',
        'cat','product','quantity','unit',
        'branch','shift',
        'create_by','updated_by',
    ];
}
