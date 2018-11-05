<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'voucher','v_date','pay_to',
        'cost_cat','cost_item','vendor','ref','total_bill','due_amount','comment',
        'branch','cid','uid',
    ];
}
