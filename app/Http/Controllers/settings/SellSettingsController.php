<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#needs
use DataTables;
use Validator;

#models
use App\Product;

class SellSettingsController extends Controller
{
    public function __construct()
    {
        $this->addViewData([
            'active_menu'               =>  ['name'=>'settings','link'=> 'javascript:void(0)'],
            'active_child_menu'         =>  ['name'=>'sells_settings','link'=> 'javascript:void(0)'],
            'active_grandchild_menu'    =>  ['name'=>'sells_product','link'=> route('sellsProduct.all')],
        ]);
    }

    public function index()
    {
        if (have_permission([1,2])){
            $this->addViewData([
                'alerts'                     =>  [],
            ]);
            return view('settings.sellsettings.products')->with($this->viewData);
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'name'          => 'required|unique:products,name|max:190',
        ]);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $data = [
            '_token'                =>  $request->token,
            'name'                  =>  $request->name
        ];
        Product::create($data);
        set_notification('open a new product ('.$request->name.') .');
        return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
    }

    public function datatable()
    {
        $produt = Product::select(['id','name','is_deleted','created_at','updated_at'])->latest('id');

        return Datatables::of($produt)
            ->editColumn('id',function ($data){
                return $data->id;
            })
            ->editColumn('name',function ($data){
                return $data->name;
            })
            ->editColumn('is_deleted',function ($data){
                if($data->is_deleted == 0){
                    return '<span class="badge badge-primary">Active</span>';
                }else{
                    return '<span class="badge badge-danger">Deleted</span>';
                }
            })
            ->editColumn('created_at',function ($data) {
                if ($data->created_at != $data->updated_at){
                    return 'তৈরী : '.$data->created_at . '<br> হালনাগাদ : ' . $data->updated_at;
                }else{
                    return 'তৈরী : '.$data->created_at ;
                }
            })
            ->addColumn('action',function ($data){
                $html = '<div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-warning btn-xs dropdown-toggle" style="margin-left: -55px; color: #000 !important; font-weight: bold" aria-expanded="false">
                                অ্যাকশন <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">';
                $edit_url = route('sellsProduct.edit',$data->id);//url('product/category/edit/'.$data->id);
                $html .= '  <li>
                                <a href="'.$edit_url.'">হালনাগাদ</a>
                            </li><li class="divider"></li>';

                if ($data->is_deleted == 0) {
                    $deactivate_url = route('sellsProduct.deactivate',$data->id);// url('product/category/deactivate/'.$data->id);
                    $html .= '<li>
                                <a onclick="return confirm(\'Are you sure want to deactivate this ?\');" href="' . $deactivate_url . '">
                                    Deactivate
                                </a>
                            </li>';
                }
                else{//if($data->is_deleted == 1){
                    $reactive_url = route('sellsProduct.reactive',$data->id);//url('product/category/reactive/'.$data->id);
                    $html .= '<li>
                                <a onclick="return confirm(\'Are you sure want to reactive this ?\');" href="' . $reactive_url . '">
                                    Reactive
                                </a>
                            </li>';
                }
                return $html;
            })
            ->rawColumns(['action','created_at','is_deleted'])
            ->make(true);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        if (!empty($product)){
            $this->addViewData([
                'this_record'               =>  Product::where('id',$id)->get(),
                'alerts'                    =>  [],
            ]);
            return view('settings.sellsettings.products')->with($this->viewData);
        }
        else
        {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'              => 'required|max:190|unique:products,name,'.$id,
        ]);
        $product = Product::find($id);
        if (!empty($product)){
            $product->name   = $request->name;
            $product->save();
            set_notification('update product information ('.$request->name.')');
            $redirect = route('sellsProduct.all');
            return redirect($redirect)->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
        }
        else
        {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function deactivate($id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $product->is_deleted = 1;
            $product->save();
            set_notification('deactivate a product (' . get_product($id) . ') .');
            return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
        } else {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function reactive($id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $product->is_deleted = 0;
            $product->save();
            set_notification('reactive a product (' . get_product($id) . ') .');
            return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
        } else {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }
}
