<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DuePayment extends Model
{
    protected $fillable = [
        'inv','inv_date','branch',
        'uid','customer','due_left','payment',
    ];
}
