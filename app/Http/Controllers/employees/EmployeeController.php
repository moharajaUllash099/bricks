<?php

namespace App\Http\Controllers\employees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#use
use DB;
use Validator;
use DataTables;
use Auth;
use File;
use PDF;
#models
use App\Employee;
use App\EmployeeDesignation;


class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->addViewData([
            'active_menu'               =>  ['name'=>'settings','link'=> 'javascript:void(0)'],
            'active_child_menu'         =>  ['name'=>'employee','link'=> 'javascript:void(0)'],
            'active_grandchild_menu'    =>  ['name'=>'all_employee','link'=> route('employee.all')],
        ]);
    }

    public function index()
    {
        if (have_permission([1,2])){
            $this->addViewData([
                'alerts'                     =>  [],
            ]);

            return view('employee.all_employee')->with($this->viewData);
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function create()
    {
        if (have_permission([1,2])){
            $this->addViewData([
                'all_countries'                 =>  DB::table('countries')->get(),
                'branches'                      =>  DB::table('branches')->where('status','0')->get(),
                'alerts'                        =>  [
                    'warning'                      =>  'তারকা (*) চিহ্নিত ফিল্ড গুলো অবশ্যই পূরণ করতে হবে'
                ],
            ]);

            return view('employee.add_employee')->with($this->viewData);
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function save_designation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:190|unique:employee_designations',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else {
            $data = [
                '_token' => $request->token,
                'name' => $request->name,
            ];

            $employeeDesignation = EmployeeDesignation::create($data);
            set_notification('Add a new designation ('.$request->name.') .');
            return response()->json(['success' => $employeeDesignation->id]);
        }
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'img'               => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'              => 'required|max:190',

            'branch'            => 'required|max:190',
            'designation'       => 'required|max:190',
            'dob'               => 'required|max:190',
            'joining_date'      => 'required|max:190',

            'personal_mobile'   => 'required|min:11|max:12|unique:employees,personal_mobile',
            'alt_mobile'        => 'max:190',
            'nid'               => 'max:190|unique:employees,nid|nullable',
            'email'             => 'max:190|unique:employees,email|nullable',
            'country'           => 'required|max:190',
            'city'              => 'required|max:190',
            'area'              => 'required|max:190',
            'post_code'         => 'max:190',
            'house_address'     => 'max:190',
            'comment'           => 'max:190',
        ]);
    }

    public function datatable()
    {
        $employee = Employee::select([
            'id', 'name', 'branch','designation',
            'dob','joining_date','img',
            'personal_mobile', 'alt_mobile','nid','email',
            'country', 'city', 'area','post_code','house_address',
            'created_at','updated_at'])->orderby('id', 'DESC');

        return Datatables::of($employee)
            ->editColumn('img',function ($data){
                $img = asset('soft/uploads/default/user.png');
                if($data->img){
                    $img = asset('soft/uploads/'.$data->img);
                }
                return '<img src="'.$img.'" class="img-rounded img-responsive" style="height: 90px;">';
            })
            ->editColumn('name',function ($data){
                $html = $data->name.'<br>জন্ম তারিখ : ';
                $html.= date('d M, Y',strtotime($data->dob)).'<br> যোগদান : '.date('d M, Y',strtotime($data->joining_date));
                $html.= '<br>পদবী : '.get_designation($data->designation);
                return $html;
            })
            ->editColumn('branch',function ($data){
                return get_branch_name($data->branch);
            })
            ->editColumn('personal_mobile',function ($data){
                $html = '<strong>মোবাইল </strong> <br>
                    ব্যক্তিগত : '.$data->personal_mobile;
                if(!empty($data->alt_mobile))
                    $html.= '<br><strong>বিকল্প : </strong>'.$data->alt_mobile;
                if(!empty($data->alt_mobile))
                    $html .= '<br><strong>ইমেইল  : </strong>'.$data->email;
                if(!empty($data->alt_mobile))
                    $html .= '<br><strong>NID/পাসপোর্ট / ড্রাইভিং লাইসেন্স : </strong>'.$data->nid;
                return $html;
            })
            ->editColumn('country',function ($data){
                $html = '<strong>দেশ : </strong>'.get_country($data->country);
                if(!empty($data->city))
                    $html.= '<br><strong>শহর : </strong> '.ucwords($data->city);
                if(!empty($data->area))
                    $html.= '<br><strong>এলাকায় : </strong>'.ucwords($data->area);
                if(!empty($data->post_code))
                    $html.= '<br><strong>পোস্ট কোড : </strong>'.ucwords($data->post_code);
                if(!empty($data->house_address))
                    $html.= '<br><strong>বাড়ীর নাম ও ঠিকানা : </strong>'.ucwords($data->house_address);

                return $html;
            })
            ->editColumn('created_at',function ($data){
                /*$html = '<br><strong>Created at : </strong> '.date('d-M-Y',strtotime($data->created_at));
                if($data->created_at != $data->updated_at) {
                    $html.= '<br><strong>Created at : </strong> '.date('d-M-Y',strtotime($data->updated_at));
                }*/

                $html = '<br><strong>তৈরী হয়েছে : </strong> '.date('d-M-Y',strtotime($data->created_at));
                if($data->created_at != $data->updated_at) {
                    $html.= '<br><strong>হালনাগাদ হয়েছে : </strong> '.date('d-M-Y',strtotime($data->updated_at));
                }

                return $html;
            })
            ->addColumn('action', function ($data) {
                $detail_url = route('employee.edit',$data->id);//url('customer/edit/'.$data->id);
                $id_url = route('employee.print_single',$data->id);//url('customer/single_id/'.$data->id);

                $html = '<div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-warning btn-sm dropdown-toggle" style="margin-left: -55px; color: #000 !important; font-weight: bold" aria-expanded="false">
                                অ্যাকশন <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="'.$detail_url.'">
                                        হালনাগাদ
                                    </a>
                                </li>
                                <li>
                                    <a href="'.$id_url.'">
                                        Print ID
                                    </a>
                                </li>
                            </ul>
                        </div>';

                return $html;
            })
            ->rawColumns(['img','type','name','personal_mobile','country','created_at','action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $photos_path = public_path('/soft/uploads');
        $data = [
            '_token'            =>  $request->token,
            'name'              =>  $request->name,

            'branch'            =>  $request->branch,
            'designation'       =>  $request->designation,
            'dob'               =>  date('Y-m-d',strtotime($request->dob)),
            'joining_date'      =>  date('Y-m-d',strtotime($request->joining_date)),

            'personal_mobile'   =>  $request->personal_mobile,
            'alt_mobile'        =>  $request->alt_mobile,
            'nid'               =>  $request->nid,
            'email'             =>  $request->email,
            'country'           =>  $request->country,
            'city'              =>  $request->city,
            'area'              =>  $request->area,
            'post_code'         =>  $request->post_code,
            'house_address'     =>  $request->house_address,
            'comment'           =>  $request->comment,
        ];
        if ($request->hasFile('img')){
            $photo = $request->file('img');
            $name = sha1(date('YmdHis') . str_random(30));
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
            $photo->move($photos_path, $save_name);
            $data['img'] = $save_name;

        }
        //debug($data,1);
        Employee::create($data);
        set_notification('Register a new employee ('.$request->name.') .');
        return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
    }

    public function print_info()
    {
        $data = [
            'employees' => Employee::get(),
        ];
        return view('employee.all_employee_info_print')->with($data);
    }

    public function print_single($id)
    {
        $data = [
            'this_info' => Employee::where('id',$id)->get(),
        ];
        return view('employee.print_single_id')->with($data);
    }

    public function edit($id)
    {
        if (have_permission([1,2])){
            $employee = Employee::find($id);
            if(!empty($employee)){
                $this->addViewData([
                    'all_countries'         =>  DB::table('countries')->get(),
                    'branches'              =>  DB::table('branches')->where('status','0')->get(),
                    'this_record'           =>  Employee::where('id',$id)->get(),
                    'alerts'                =>  [],
                ]);
                return view('employee.add_employee')->with($this->viewData);
            }else{
                return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
            }
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'img'               => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'              => 'required|max:190',

            'branch'            => 'required|max:190',
            'designation'       => 'required|max:190',
            'dob'               => 'required|max:190',
            'joining_date'      => 'required|max:190',

            'personal_mobile'   => 'required|min:11|max:12|unique:employees,personal_mobile,'.$id,
            'alt_mobile'        => 'max:190',
            'nid'               => 'max:190|nullable|unique:employees,nid,'.$id,
            'email'             => 'max:190|nullable|unique:employees,email,'.$id,
            'country'           => 'required|max:190',
            'city'              => 'required|max:190',
            'area'              => 'required|max:190',
            'post_code'         => 'max:190',
            'house_address'     => 'max:190',
            'comment'           => 'max:190',
        ]);

        $photos_path = public_path('/soft/uploads');
        $employee = Employee::find($id);

        if(!empty($employee)) {
            $employee->name   = $request->name;

            $employee->branch   = $request->branch;
            $employee->designation   = $request->designation;
            $employee->dob   = date('Y-m-d',strtotime($request->dob));
            $employee->joining_date   = date('Y-m-d',strtotime($request->joining_date));

            $employee->personal_mobile   = $request->personal_mobile;
            $employee->alt_mobile   = $request->alt_mobile;
            $employee->nid   = $request->nid;
            $employee->email   = $request->email;
            $employee->country   = $request->country;
            $employee->city   = $request->city;
            $employee->area   = $request->area;
            $employee->post_code   = $request->post_code;
            $employee->house_address   = $request->house_address;

            if ($request->hasFile('img')) {
                /*
                 * remove previous picture and add new picture
                 */

                #get file name
                $file = $employee->img;

                #set file location
                $filename = public_path('soft/uploads/'.$file);

                /*
                 * first upload new file then delete previous file
                 */
                #upload new file
                $photo = $request->file('img');
                $name = sha1(date('YmdHis') . str_random(30));
                $save_name = $name . '.' . $photo->getClientOriginalExtension();
                $photo->move($photos_path, $save_name);

                #now save information on database
                $employee->img   = $save_name;

                #delete previous file
                if(file_exists($filename)){
                    File::delete($filename);
                }
            }

            $employee->save();
            set_notification('update employee information ('.$request->name.')');

            $redirect =  route('employee.all');
            return redirect($redirect)->with('success_','সফলভাবে হালনাগাদ সম্পন্ন হয়েছে !');
        }
        else{
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function search()
    {
        return Employee::where('name','LIKE','%'.request('q').'%')
            ->orWhere('nid','LIKE','%'.request('q').'%')
            ->orWhere('personal_mobile','LIKE','%'.request('q').'%')
            ->orWhere('alt_mobile','LIKE','%'.request('q').'%')
            ->paginate(10);
    }
}
