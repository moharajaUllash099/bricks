<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $viewData;

    public function __construct(){
        $this->addViewData([
            'active_menu'   =>  ['name'=>'dashboard','link'=> url('/')]
        ]);
    }


    public function addViewData($data = array())
    {
        foreach ($data as $key => $value){
            $this->viewData[$key] = $value;
        }
    }
}
