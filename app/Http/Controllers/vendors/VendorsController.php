<?php

namespace App\Http\Controllers\vendors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#needs
use DB;
use DataTables;
use Auth;
use Validator;
#models
use App\Vendor;
use App\Branche;

class VendorsController extends Controller
{
    public function __construct()
    {
        $this->addViewData([
            'active_menu'     =>  ['name'=>'vendor_management','link'=> 'javascript:void(0)']
        ]);
    }

    public function index()
    {
        $this->addViewData([
            'active_child_menu'    =>  ['name'=>'vendor_list','link'=> route('vendor.list')],
            'alerts'                    =>  []
        ]);

        return view('vendors.list')->with($this->viewData);
    }

    public function create()
    {
        $this->addViewData([
            'active_child_menu'         =>  ['name'=>'new_vendor','link'=> route('vendor.new')],
            'all_countries'             =>  DB::table('countries')->get(),
            'alerts'                    =>  [
                'warning'               =>  'তারকা (*) চিহ্নিত ফিল্ড গুলো অবশ্যই পূরণ করতে হবে',
            ]
        ]);

        return view('vendors.new')->with($this->viewData);
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'company_name'      => 'max:190',
            'vendors_name'      => 'required|max:190',
            'personal_mobile'   => 'required|unique:vendors,personal_mobile|max:11',
            'alt_mobile'        => 'max:190',
            'email'             => 'max:190',
            'country'           => 'required|max:190',
            'district'          => 'required|max:190',
            'area'              => 'required|max:190',
            'post_code'         => 'max:190',
            'address'           => 'required|max:190',
            'comment'           => 'max:190'
        ]);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $cid = Auth::user()->id;
        $data = [
            '_token'                =>  $request->token,
            'company_name'          =>  $request->company_name,
            'vendors_name'          =>  $request->vendors_name,
            'personal_mobile'       =>  $request->personal_mobile,
            'alt_mobile'            =>  $request->alt_mobile,
            'email'                 =>  $request->email,
            'country'               =>  $request->country,
            'district'              =>  $request->district,
            'area'                  =>  $request->area,
            'post_code'             =>  $request->post_code,
            'address'               =>  $request->address,
            'comment'               =>  $request->comment,
            'cid'                   =>  $cid
        ];

        Vendor::create($data);
        set_notification('Register a new Vendor ('.$request->company_name.')');
        return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');

    }

    public function datatable()
    {
        $vendors = Vendor::select([
            'id',
            'company_name','vendors_name','personal_mobile','alt_mobile','email',
            'country','district','area','post_code','address','comment',
            'created_at','updated_at','cid','uid'
        ])->orderby('id', 'DESC');

        return Datatables::of($vendors)
            ->editColumn('company_name',function ($data){
                $html = '';
                if(!empty($data->company_name))
                $html .= '<strong>প্রতিষ্ঠানের নাম : </strong>'.$data->company_name.'<br>';

                $html .= '<strong>ব্যাপারীর নাম : </strong>'.$data->vendors_name;
                return $html;
            })
            ->editColumn('personal_mobile',function ($data){
                $html = '<strong>মোবাইল  : <br>ব্যক্তিগত  : </strong>'.$data->personal_mobile;
                if(!empty($data->alt_mobile))
                    $html.= '<br><strong>বিকল্প নাম্বার : </strong>'.$data->alt_mobile;
                if(!empty($data->email))
                    $html .= '<br><strong>ইমেইল  : </strong>'.$data->email;

                return $html;
            })
            ->editColumn('address',function ($data){
                $html = '<strong>ঠিকানা : </strong>'.ucwords($data->address);
                $html.= '<br><strong>এলাকা (থানা/পোঃ) : </strong>'.ucwords($data->area);
                $html.= '<br><strong>জেলা : </strong> '.ucwords($data->district);
                $html.= '<br><strong>দেশ : </strong>'.get_country($data->country);
                if(!empty($data->post_code))
                    $html.= '- '.ucwords($data->post_code);

                return $html;
            })
            ->editColumn('created_at',function ($data){
                $html = '<strong>তৈরী করেছেন : </strong>'.get_author($data->cid);
                $html.= '<br><strong>তৈরী হয়েছে : </strong> '.date('d-M-Y',strtotime($data->created_at));
                if($data->created_at != $data->updated_at) {
                    $html .= '<br><strong>হালনাগাদ করেছেন : </strong>'.get_author($data->uid);
                    $html.= '<br><strong>হালনাগাদ হয়েছে : </strong> '.date('d-M-Y',strtotime($data->updated_at));
                }

                return $html;
            })
            ->addColumn('action', function ($data) {
                $edit_url = route('vendor.edit',$data->id);

                $html = '<div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle" style="margin-left: -55px; color: #000 !important; font-weight: bold" aria-expanded="false">
                                অ্যাকশন <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="'.$edit_url.'">
                                        হালনাগাদ
                                    </a>
                                </li>
                            </ul>
                        </div>';

                return $html;
            })
            ->rawColumns(['company_name','personal_mobile','address','created_at','action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $vendor = Vendor::find($id);
        if (!empty($vendor)){
            $this->addViewData([
                'active_child_menu'         =>  ['name'=>'edit_vendor','link'=> route('vendor.edit',$id)],
                'all_countries'             =>  DB::table('countries')->get(),
                'this_record'               =>  Vendor::where('id',$id)->get(),
                'alerts'                    =>  []
            ]);
            return view('vendors.new')->with($this->viewData);
        }
        else
        {
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'company_name'      => 'max:190',
            'vendors_name'      => 'required|max:190',
            'personal_mobile'   => 'required|unique:vendors,personal_mobile,'.$id.'|max:11',
            'alt_mobile'        => 'max:190',
            'email'             => 'max:190',
            'country'           => 'required|max:190',
            'district'          => 'required|max:190',
            'area'              => 'required|max:190',
            'post_code'         => 'max:190',
            'address'           => 'required|max:190',
            'comment'           => 'max:190'
        ]);
        $vendor = Vendor::find($id);
        if(!empty($vendor)) {
            $uid = Auth::user()->id;
            $vendor->company_name       = $request->company_name;
            $vendor->vendors_name       = $request->vendors_name;
            $vendor->personal_mobile    = $request->personal_mobile;
            $vendor->alt_mobile         = $request->alt_mobile;
            $vendor->email              = $request->email;
            $vendor->country            = $request->country;
            $vendor->district           = $request->district;
            $vendor->area               = $request->area;
            $vendor->post_code          = $request->post_code;
            $vendor->address            = $request->address;
            $vendor->comment            = $request->comment;
            $vendor->uid                = $uid;


            $vendor->save();
            set_notification('update Vendor information ('.$request->company_name.')');

            $redirect =  route('vendor.list');
            return redirect($redirect)->with('success_','সফলভাবে হালনাগাদ সম্পন্ন হয়েছে !');
        }
        else{
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function print_list()
    {
        $this->addViewData([
            'vendors'               =>  Vendor::get(),
            'branch_info'           =>  Branche::where('id',Auth::user()->branch)->get(),
        ]);
        return view('vendors.print')->with($this->viewData);
    }

}
