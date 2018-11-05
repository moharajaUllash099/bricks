<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorManagement extends Model
{
    protected $fillable = [
        'company_name','contact_person','personal_mobile','alt_mobile','email',
        'country','city','area','post_code','address','comment',
        'cid','uid',
    ];
}
