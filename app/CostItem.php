<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostItem extends Model
{
    protected $fillable = [
        'name','category', 'is_deleted'
    ];
}
