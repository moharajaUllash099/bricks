<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    protected $fillable = [
        'img','name','type','discount_type',
        'personal_mobile','alt_mobile','nid','email',
        'country','city','area','post_code','house_address','comment',
        'cid','uid'
    ];
}
