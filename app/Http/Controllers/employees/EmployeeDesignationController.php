<?php

namespace App\Http\Controllers\employees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
#needs
use DB;
use DataTables;
#models
use App\EmployeeDesignation;

class EmployeeDesignationController extends Controller
{
    public function __construct()
    {
        $this->addViewData([
            'active_menu'   =>  ['name'=>'settings','link'=> 'javascript:void(0)'],
            'active_child_menu'     =>  ['name'=>'employee','link'=> 'javascript:void(0)'],
            'active_grandchild_menu'     =>  ['name'=>'employee_designations','link'=> route('employee.designations')],
        ]);
    }

    public function index()
    {
        if (have_permission([1,2])){
            $this->addViewData([
                'alerts'                     =>  [],
            ]);
            return view('employee.designations')->with($this->viewData);
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'name'          => 'required|max:190'
        ]);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        $data = [
            '_token'                =>  $request->token,
            'name'                  =>  $request->name,
        ];
        EmployeeDesignation::create($data);
        set_notification('Add a new designation ('.$request->name.') .');
        return back()->with('success_','সফলভাবে সম্পন্ন হয়েছে !');
    }

    public function datatable()
    {
        $designations = EmployeeDesignation::select(['id','name','created_at','updated_at'])
            ->orderby('id','DESC');//->first();

        return Datatables::of($designations)
            ->editColumn('name',function ($data){
                return $data->name;
            })
            ->editColumn('created_at',function ($data) {
                if ($data->created_at == $data->updated_at){
                    return $data->created_at;
                }else {
                    return $data->created_at . '<br>' . $data->updated_at;
                }
            })
            ->addColumn('action',function ($data){
                $edit_url = route('employee.editDesignations',$data->id); //url('setting/branch/edit/'.$data->id);

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
            ->rawColumns(['name','address','created_at','status','action'])
            ->make(true);
    }

    public function edit($id)
    {
        if (have_permission([1,2])){
            $designations = EmployeeDesignation::find($id);
            if (!empty($designations)) {
                $this->addViewData([
                    'this_record'                   => EmployeeDesignation::where('id',$id)->get(),
                    'alerts'                        =>  [],
                ]);
                return view('employee.designations')->with($this->viewData);
            }
            else{
                $redirect =  route('employee.designations');
                return redirect($redirect)->with('error_','কোন তথ্য পাওয়া যায়নি !');
            }

        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validation($request);
        $designations = EmployeeDesignation::find($id);
        if (!empty($designations)) {
            $designations->name = $request->name;
            $designations->save();
            set_notification('update designation to ('.$request->name.') .');
            $redirect =  route('employee.designations');
            return redirect($redirect)->with('success_','সফলভাবে হালনাগাদ সম্পন্ন হয়েছে !');
        }
        else{
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }


    public function search()
    {
        return EmployeeDesignation::where('name','LIKE','%'.request('q').'%')
            ->paginate(10);
    }
}
