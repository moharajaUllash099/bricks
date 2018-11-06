<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#needs
use DataTables;
use Validator;
#models
use App\BuyCategories;
use App\BuyProduct;

class BuySettingsController extends Controller
{
    public function __construct()
    {
        $this->addViewData([
            'active_menu'               =>  ['name'=>'settings','link'=> 'javascript:void(0)'],
            'active_child_menu'         =>  ['name'=>'buy_settings','link'=> 'javascript:void(0)'],
        ]);
    }

    public function index()
    {
        if (have_permission([1,2])){
            $this->addViewData([
                'active_grandchild_menu'    =>  ['name'=>'buy_categories','link'=> route('buysettings.category.all')],
                'alerts'                     =>  [],
            ]);
            return view('settings.buysettings.category')->with($this->viewData);
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'name'          => 'required|unique:buy_categories,name|max:190',
        ]);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $data = [
            '_token'                =>  $request->token,
            'name'                  =>  $request->name
        ];
        BuyCategories::create($data);
        set_notification('open a new category ('.$request->name.') .');
        return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');

    }

    public function datatable()
    {
        $buyCategories = BuyCategories::select(['id','name','is_deleted','created_at','updated_at'])->latest('id');

        return Datatables::of($buyCategories)
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
                $edit_url = route('buysettings.category.edit',$data->id);//url('product/category/edit/'.$data->id);
                $html .= '  <li>
                                <a href="'.$edit_url.'">হালনাগাদ</a>
                            </li><li class="divider"></li>';

                if ($data->is_deleted == 0) {
                    $deactivate_url = route('buysettings.category.deactivate',$data->id);// url('product/category/deactivate/'.$data->id);
                    $html .= '<li>
                                <a onclick="return confirm(\'Are you sure want to deactivate this ?\');" href="' . $deactivate_url . '">
                                    Deactivate
                                </a>
                            </li>';
                }
                else{//if($data->is_deleted == 1){
                    $reactive_url = route('buysettings.category.reactive',$data->id);//url('product/category/reactive/'.$data->id);
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
        $buyCategories = BuyCategories::find($id);
        if (!empty($buyCategories)){
            $this->addViewData([
                'active_grandchild_menu'    =>  ['name'=>'buy_categories','link'=> route('buysettings.category.all')],
                'this_record'               =>  BuyCategories::where('id',$id)->get(),
                'alerts'                    =>  [],
            ]);
            return view('settings.buysettings.category')->with($this->viewData);
        }
        else
        {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'              => 'required|max:190|unique:buy_categories,name,'.$id,
        ]);
        $buyCategories = BuyCategories::find($id);
        if (!empty($buyCategories)){
            $buyCategories->name   = $request->name;
            $buyCategories->save();
            set_notification('update buy category information ('.$request->name.')');
            $redirect = route('buysettings.category.all');
            return redirect($redirect)->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
        }
        else
        {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function deactivate($id)
    {
        $cat = BuyCategories::find($id);
        if (!empty($cat)) {
            $cat->is_deleted = 1;
            $cat->save();
            set_notification('deactivate a buy product categories (' . get_buy_cat($id) . ') .');
            return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
        } else {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function reactive($id)
    {
        $cat = BuyCategories::find($id);
        if (!empty($cat)) {
            $cat->is_deleted = 0;
            $cat->save();
            set_notification('reactive a buy product categories (' . get_buy_cat($id) . ') .');
            return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
        } else {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }



    public function buyProducts()
    {
        if (have_permission([1,2])){
            $this->addViewData([
                'active_grandchild_menu'    =>  ['name'=>'buy_products','link'=> route('buysettings.buyProducts.all')],
                'cats'                      =>  BuyCategories::where('is_deleted','0')->get(),
                'alerts'                    =>  [],
            ]);
            return view('settings.buysettings.buyProducts')->with($this->viewData);
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function saveBuyProducts(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required|max:190|unique:buy_categories,name',
            'category'          => 'required|max:190',
        ]);
        $data = [
            '_token'                =>  $request->token,
            'name'                  =>  $request->name,
            'category'              =>  $request->category
        ];
        BuyProduct::create($data);
        set_notification('create a new product for buy ('.$request->name.') .');
        return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
    }

    public function buyProductsDataTable()
    {
        $buyProducts = BuyProduct::select(['id','name',
            'category',
            'is_deleted','created_at','updated_at'])->latest('id');

        return Datatables::of($buyProducts)
            ->editColumn('id',function ($data){
                return $data->id;
            })
            ->editColumn('name',function ($data){
                return $data->name;
            })
            ->editColumn('category',function ($data){
                return get_buy_cat($data->category);
            })
            ->filterColumn('category', function($query, $keyword) {
                $ci = BuyCategories::where('name', 'like', '%'.$keyword.'%')
                    ->get();
                $category_id = (isset($ci[0])) ? $ci[0]->id : '';

                $query->where('category','=',$category_id);
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
                $edit_url = route('buysettings.buyProducts.edit',$data->id);//url('product/category/edit/'.$data->id);
                $html .= '  <li>
                                <a href="'.$edit_url.'">হালনাগাদ</a>
                            </li><li class="divider"></li>';

                if ($data->is_deleted == 0) {
                    $deactivate_url = route('buysettings.buyProducts.deactivate',$data->id);// url('product/category/deactivate/'.$data->id);
                    $html .= '<li>
                                <a onclick="return confirm(\'Are you sure want to deactivate this ?\');" href="' . $deactivate_url . '">
                                    Deactivate
                                </a>
                            </li>';
                }
                else{//if($data->is_deleted == 1){
                    $reactive_url = route('buysettings.buyProducts.reactive',$data->id);//url('product/category/reactive/'.$data->id);
                    $html .= '<li>
                                <a onclick="return confirm(\'Are you sure want to reactive this ?\');" href="' . $reactive_url . '">
                                    Reactive
                                </a>
                            </li>';
                }
                return $html;
            })
            ->rawColumns(['action','category','created_at','is_deleted'])
            ->make(true);
    }

    public function buyProductsEdit($id)
    {
        $buyProduct = BuyProduct::find($id);
        if (!empty($buyProduct)){
            $this->addViewData([
                'active_grandchild_menu'    =>  ['name'=>'buy_categories','link'=> route('buysettings.category.all')],
                'this_record'               =>  BuyProduct::where('id',$id)->get(),
                'cats'                      =>  BuyCategories::where('is_deleted','0')->get(),
                'alerts'                    =>  [],
            ]);
            return view('settings.buysettings.buyProducts')->with($this->viewData);
        }
        else
        {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function updateBuyProducts(Request $request,$id)
    {
        $this->validate($request, [
            'name'              => 'required|max:190|unique:buy_categories,name,'.$id,
            'category'          => 'required|max:190',
        ]);

        $buyProduct = BuyProduct::find($id);
        if (!empty($buyProduct)){
            $buyProduct->name   = $request->name;
            $buyProduct->category   = $request->category;
            $buyProduct->save();
            set_notification('update buy product information ('.$request->name.')');
            $redirect = route('buysettings.buyProducts.all');
            return redirect($redirect)->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
        }
        else
        {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function productDeactivate($id)
    {
        $product = BuyProduct::find($id);
        if (!empty($product)) {
            $product->is_deleted = 1;
            $product->save();
            set_notification('deactivate a buy product (' . get_buy_product($id) . ') .');
            return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
        } else {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function productReactive($id)
    {
        $product = BuyProduct::find($id);
        if (!empty($product)) {
            $product->is_deleted = 0;
            $product->save();
            set_notification('reactive a buy product (' . get_buy_product($id) . ') .');
            return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
        } else {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

}
