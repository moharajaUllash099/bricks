<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = [
        'inv','store_date',
        'cat','product','storage_type','quantity','unit','comment',
        'branch','shift','customer',
        'create_by','updated_by',
    ];
}
