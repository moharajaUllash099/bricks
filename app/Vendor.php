<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'company_name','vendors_name','personal_mobile','alt_mobile','email',
        'country','district','area','post_code','address','comment',
        'cid','uid',
    ];
}
