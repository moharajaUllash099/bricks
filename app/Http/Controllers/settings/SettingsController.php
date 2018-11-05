<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BasicSetting;
use DB;

class SettingsController extends Controller
{
    private $available_template;
    public function __construct()
    {
        $this->addViewData([
            'active_menu'   =>  ['name'=>'settings','link'=> 'javascript:void(0)']
        ]);
        $this->available_template = [
            //if invoice is free
            'basic_international' => [
                    'type'      =>      'free',
            ],
            //if invoice is paid
            /*'basic_international' => [
                    'type'      =>      'paid',
                    'price'     =>      '$50 / ৳ 4100'
            ],*/
        ];
    }

    public function index()
    {

        $this->addViewData([
            'active_child_menu' => ['name' => 'general_setting', 'link' => route('generalSettings')],
            'alerts' => [
                'warning' => 'তারকা (*) চিহ্নিত ফিল্ড গুলো অবশ্যই পূরণ করতে হবে',
            ],
        ]);
        if (have_permission([1,2])){
            return view('settings.basic_settings')->with($this->viewData);
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function validation(Request $request)
    {
        $validate = array();
        foreach ($_POST as $key => $value){
            if ($key != '_token')
                $validate[$key] = 'max:2000';
        }
        return $request->validate($validate);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $saveData = array();
        foreach ($_POST as $key => $value){
            if ($key != '_token') {
                $saveData[$key] = $value;
            }
        }
        if(!isset($_POST['print_auther_info'])) {
            $saveData['print_auther_info'] = 'off';
        }
        else{
            $saveData['print_auther_info'] = 'on';
        }

        foreach ($saveData as $key => $val){

            $BasicSettings = BasicSetting::where('name',$key)->get();

            if (count($BasicSettings) > 0) {
                DB::table('basic_settings')
                    ->where('name', $key)
                    ->update(['val' => $val]);
                set_notification('update on general information ('.$key.')');
            }else{
                if (!empty($val)) {
                    $data = [
                        'name' => $key,
                        'val' => $val
                    ];
                    DB::table('basic_settings')->insert($data);
                    set_notification('set new general information ('.$key.')');
                }
            }
        }
        return back()->with('success_', 'Successfully saved!');
    }

    public function choose_invoice()
    {
        $this->addViewData([
            'active_child_menu'     =>      ['name' => 'choose_invoice', 'link' => route('chooseInvoice')],
            'alerts'                =>      [],
            'available_template'    =>      $this->available_template,
        ]);
        return view('invoices.showInvoices')->with($this->viewData);
    }

    public function set_invoice($template)
    {
        if(array_key_exists($template,$this->available_template)){

            $BasicSettings = BasicSetting::where('name','active_invoice')->get();

            if (count($BasicSettings) > 0) {
                DB::table('basic_settings')
                    ->where('name', 'active_invoice')
                    ->update(['val' => $template]);
                set_notification('update Invoice Template ('.str_replace('_',',',$template).')');
            }else{
                if (!empty($template)) {
                    $data = [
                        'name' => 'active_invoice',
                        'val' => $template
                    ];
                    DB::table('basic_settings')->insert($data);
                    set_notification('set new Invoice Template ('.str_replace('_',',',$template).')');
                }
            }
            return back()->with('success_', 'Successfully saved!');
        }else{
            return back()->with('error_', 'You need to buy this template. for buy this invoice please call 01533 105564');
        }
    }

    public function buy_invoice($template)
    {
        $this->addViewData([
            'active_child_menu'         =>      ['name' => 'choose_invoice', 'link' => 'setting/choose_invoice'],
            'active_grandchild_menu'    =>      ['name' => 'buy_invoice', 'link' => 'javascript:void(0)'],
            'alerts'                    =>      [],
            'template'                  =>      $template,
            'template_info'             =>      $this->available_template
        ]);
        return view('invoices.buyInvoice')->with($this->viewData);
    }
}
