<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'img','name',
        'branch','designation','dob','joining_date',
        'personal_mobile','alt_mobile','nid','email',
        'country','city','area','post_code','house_address','comment',
        'cid','uid'
    ];
}
