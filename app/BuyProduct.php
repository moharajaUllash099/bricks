<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyProduct extends Model
{
    protected $fillable = [
        'name','category','is_deleted'
    ];
}
