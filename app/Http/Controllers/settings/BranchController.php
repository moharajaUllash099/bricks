<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use DataTables;

//models
use App\Branche;
use Yajra\DataTables\Contracts\DataTable;

class BranchController extends Controller
{
    private $total_open_branch;
    private $permissible_branch;
    public function __construct()
    {
        $this->total_open_branch = DB::table('branches')->where('status','0')->count();
        $this->permissible_branch = get_basic_setting('permissible_branch');
        $this->addViewData([
            'active_menu'   =>  ['name'=>'settings','link'=> 'javascript:void(0)']
        ]);
    }

    public function index()
    {
        $this->addViewData([
            'active_child_menu'     =>  ['name'=>'all_branch','link'=> 'setting/branch'],
            'alerts'                =>  [],
        ]);

        if (have_permission([1,2])){
            return view('settings.branch.all_branch')->with($this->viewData);
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function datatable()
    {
        $branch = Branche::select(['id','name','address','email','phone','vat_id','status','created_at','updated_at'])
            ->orderby('id','DESC');//->first();
        //return $branch;

        return Datatables::of($branch)
            ->editColumn('name',function ($data){
                return '<h3>'.$data->name.'</h3><h4>'.$data->vat_id.'</h4>';
            })
            ->editColumn('address',function ($data){
                return '<p>Email : <a href="mailto:'.$data->email.'">'.$data->email.'</a></p>
                        <p>Phone : <a href="tel:'.$data->phone.'">'.$data->phone.'</a></p>
                        '.$data->address;
            })
            ->editColumn('status',function ($data){
                if($data->status == 0) {
                    return '<span class="badge badge-primary">Running</span>';
                }else{
                    return '<span class="badge badge-danger">Closed</span>';
                }
            })
            ->editColumn('created_at',function ($data) {
                if ($data->created_at == $data->updated_at){
                    return $data->created_at;
                }else {
                    return $data->created_at . '<br>' . $data->updated_at;
                }
            })
            ->addColumn('action',function ($data){
                $edit_url = route('editBranch',$data->id); //url('setting/branch/edit/'.$data->id);

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
                                <li class="divider"></li>';
                            if ($data->status == 0) {
                                $shut_down_url = route('shutDownBranch',$data->id);//url('setting/branch/shut_down/'.$data->id);
                                $html .= '<li>
                                            <a href="' . $shut_down_url . '">
                                                বন্ধ করুন
                                            </a>
                                        </li>';
                            }else{
                                $reopen_url = route('reopenBranch',$data->id);//url('setting/branch/reopen/'.$data->id);
                                $html .= '<li>
                                            <a href="' . $reopen_url . '">
                                                পুনরায় চালু করুন
                                            </a>
                                        </li>';
                            }
                    $html .='</ul>
                        </div>';
                return $html;
            })
            ->rawColumns(['name','address','created_at','status','action'])
            ->make(true);
    }

    public function create()
    {
        $this->addViewData([
            'active_child_menu'         =>  ['name'=>'all_branch','link'=> 'setting/branch'],
            'active_grandchild_menu'    =>  ['name'=>'new_branch','link'=> 'setting/branch/new'],
            'alerts'                    =>  [
                'warning'               =>  'তারকা (*) চিহ্নিত ফিল্ড গুলো অবশ্যই পূরণ করতে হবে',
            ],
        ]);

        if (have_permission([1,2])){
            if ($this->permissible_branch > $this->total_open_branch){
                /**
                 * if permissible branch less than open branch
                 * will show view page
                 */
                return view('settings.branch.branch')->with($this->viewData);
            }else{
                $redirect_url = route('allBranch');
                return redirect($redirect_url)->with('error_','আপনি ইতিমধ্যে যথেষ্ট শাখা খুলেছেন। যদি আপনি আরও শাখা খুলতে চান তবে আমাদের সাথে যোগাযোগ করুন (01533-10 55 64)। ধন্যবাদ');
            }
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function validation(Request $request)
    {
        return $request->validate([
            'name'          => 'required|unique:branches,name|max:190',
            'address'       => 'required|max:500',
            'phone'         => 'required|max:190',
            'email'         => 'max:190',
            //'email'         => 'required|max:190',
            'vat_id'        => 'max:190',
        ]);
    }

    public function store(Request $request)
    {
        $this->validation($request);
        if ($this->permissible_branch > $this->total_open_branch){
            $data = [
                '_token'                =>  $request->token,
                'name'                  =>  $request->name,
                'address'               =>  $request->address,
                'phone'                 =>  $request->phone,
                'email'                 =>  $request->email,
                'vat_id'                =>  $request->vat_id,
            ];

            Branche::create($data);
            set_notification('open a new branch ('.$request->name.') .');
            $redirect_url = route('allBranch');
            return redirect($redirect_url)->with('success_','সফলভাবে সম্পন্ন হয়েছে !');

        }else{
            return back()->with('error_','আপনি ইতিমধ্যে যথেষ্ট শাখা খুলেছেন। যদি আপনি আরও শাখা খুলতে চান তবে আমাদের সাথে যোগাযোগ করুন (01533-10 55 64)। ধন্যবাদ');;
        }
    }

    public function edit($id)
    {
        $this->addViewData([
            'active_child_menu'             =>  ['name'=>'all_branch','link'=> 'setting/branch'],
            'active_grandchild_menu'        =>  ['name'=>'update_branch','link'=> 'setting/branch/edit/'.$id],
            'this_record'                   =>  DB::table('branches')->where('id',$id)->get(),
            'alerts'                        =>  [
                'warning'                      =>  'তারকা (*) চিহ্নিত ফিল্ড গুলো অবশ্যই পূরণ করতে হবে',
            ],
        ]);

        if (have_permission([1,2])){
            return view('settings.branch.branch')->with($this->viewData);
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function update(Request $request, $id)
    {
        $branch = Branche::find($id);
        if (!empty($branch)) {
            //$this->validation($request);
            $request->validate([
                'name'          => 'required|unique:branches,name,'.$id.'|max:190',
                'address'       => 'required|max:500',
                'phone'         => 'required|max:190',
                //'email'         => 'required|max:190',
                'email'         => 'max:190',
                'vat_id'        => 'max:190',
            ]);
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->phone = $request->phone;
            $branch->email = $request->email;
            $branch->vat_id = $request->vat_id;

            $branch->save();
            set_notification('update branch information ('.$request->name.') .');

            return back()->with('success_','সফলভাবে হালনাগাদ সম্পন্ন হয়েছে !');
        }else{
            return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
        }
    }

    public function shut_down($id)
    {
        if (have_permission([1,2])){
            $branch = Branche::find($id);
            if (!empty($branch)) {
                $branch->status = 1;

                $branch->save();
                set_notification('shut down a branch ('.get_branch_name($id).') .');
                return back()->with('success_','এই শাখা সফলভাবে বন্ধ করা হয়েছে। এখন আপনি অন্য শাখা খুলতে পারেন।');
            }else{
                return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
            }
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }

    public function reopen($id)
    {
        if (have_permission([1,2])){
            $branch = Branche::find($id);
            if (!empty($branch)) {
                if ($this->permissible_branch > $this->total_open_branch){
                    $branch->status = 0;
                    $branch->save();
                    set_notification('reopen a branch ('.get_branch_name($id).') .');
                    return back()->with('success_','এই শাখা সফলভাবে পুনরায় চালু করা হয়েছে।');
                }else{
                    return back()->with('error_','আপনি ইতিমধ্যে যথেষ্ট শাখা খুলেছেন। যদি আপনি আরও শাখা খুলতে চান তবে আমাদের সাথে যোগাযোগ করুন (01533-10 55 64)। ধন্যবাদ');
                }

            }else{
                return back()->with('error_', 'কোন তথ্য পাওয়া যায়নি !');
            }
        }else{
            return redirect('/')->with('error_','you maybe lost');
        }
    }
}
