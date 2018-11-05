<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer','inv','sell_date','shift',
        'total_subtotal',
        'vat','total',
        'discount','total_bill','receive','advance','due','change_amount',
        'create_by','updated_by','branch',
    ];
}
