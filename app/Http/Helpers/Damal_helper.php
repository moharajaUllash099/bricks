<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\Factory as ViewFactory;

if (!function_exists('load_view')){
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param  string  $view
     * @param  array   $data
     * @param  array   $mergeData
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function load_view($view = null, $data = [], $mergeData = [])
    {
        $active_template = get_basic_setting('active_invoice');
        $factory = app(ViewFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        load_view()->addLocation(public_path('invoices/').$active_template.'/views/');

        return $factory->make($view, $data, $mergeData);
    }
}

if (!function_exists('get_basic_setting')){
    function get_basic_setting($name){
        $info = DB::table('basic_settings')->where('name', $name)->get();
        if (isset($info[0])){
            return $info[0]->val;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_author')){
    function get_author($id,$role = ''){
        $info = DB::table('users')->where('id', $id)->get();

        if (!empty($role)) {
            $role = DB::table('damal_role')->where('id', $role)->get();
        }
        if (isset($role[0]) && isset($info[0])) {
            return $info[0]->name.' ('.$role[0]->type.')';
        }elseif(isset($info[0])){
            return $info[0]->name;
        }
    }
}

if (!function_exists('get_buy_cat')){
    function get_buy_cat($id){
        $info = DB::table('buy_categories')->where('id', $id)->get();
        if (isset($info[0])) {
            return $info[0]->name;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_cost_cat')){
    function get_cost_cat($id){
        $info = DB::table('cost_categories')->where('id', $id)->get();
        if (isset($info[0])) {
            return $info[0]->name;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_buy_product')){
    function get_buy_product($id){
        $info = DB::table('buy_products')->where('id', $id)->get();
        if (isset($info[0])) {
            return $info[0]->name;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_product')){
    function get_product($id){
        $info = DB::table('products')->where('id', $id)->get();
        if (isset($info[0])) {
            return $info[0]->name;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_cost_item')){
    function get_cost_item($id){
        $info = DB::table('cost_items')->where('id', $id)->get();
        if (isset($info[0])) {
            return $info[0]->name;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_soft_role')){
    function get_soft_role($id){
        $role = DB::table('roles')->where('id', $id)->get();
        if(isset($role[0])){
            return $role[0]->role_type;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_customer_info')){
    function get_customer_info($id,$field){
        $customer_info = DB::table('customer_infos')->where('id', $id)->get();
        if(isset($customer_info[0])){
            return $customer_info[0]->$field;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_vendor_name')){
    function get_vendor_name($id,$field = ''){
        $vendor_name = DB::table('vendor_managements')->where('id', $id)->get();
        if(isset($vendor_name[0])){
            if(!empty($field))
                return $vendor_name[0]->$field;
            else
                return $vendor_name[0]->company_name;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_employee')){
    function get_employee($id,$field){
        $employees = DB::table('employees')->where('id', $id)->get();
        if(isset($employees[0])){
            if($field == 'designation'){
                //get designation
                return get_designation($employees[0]->designation);
            }elseif($field == ''){
                //get branch name
                return get_branch_name($employees[0]->branch);
            }else{
                return $employees[0]->$field;
            }
        }else{
            return '';
        }
    }
}

if (!function_exists('get_branch_name')){
    function get_branch_name($id){
        if ($id == 0 ){
            //return 'Principal Branch';
            return 'প্রধান শাখা';
        }else{
            $role = DB::table('branches')->where('id', $id)->get();
            if(isset($role[0])){
                return $role[0]->name;
            }else{
                return 'unknown';
            }
        }
    }
}

if (!function_exists('get_branch_address')){
    function get_branch_address($id){
        if ($id == 0 ){
            return get_basic_setting('address');
        }else{
            $role = DB::table('branches')->where('id', $id)->get();
            if(isset($role[0])){
                return $role[0]->address;
            }else{
                return 'unknown';
            }
        }
    }
}

if (!function_exists('get_branch_phone')){
    function get_branch_phone($id){
        if ($id == 0 ){
            return get_basic_setting('phone');
        }else{
            $role = DB::table('branches')->where('id', $id)->get();
            if(isset($role[0])){
                return $role[0]->phone;
            }else{
                return 'unknown';
            }
        }
    }
}

if (!function_exists('get_branch_vat_id')){
    function get_branch_vat_id($id){
        if ($id == 0 ){
            return '***********';
        }else{
            $role = DB::table('branches')->where('id', $id)->get();
            if(isset($role[0])){
                return $role[0]->vat_id;
            }else{
                return 'unknown';
            }
        }
    }
}



if(!function_exists('set_notification')){
    function set_notification($msg=''){
        $data = [
            'name'          =>  Auth::user()->name,
            'uid'           =>  Auth::user()->id,
            'role'          =>  Auth::user()->role,
            'msg'           =>  $msg,
            'created_at'    =>  date('Y-m-d H:i:s'),
        ];
        DB::table('notifications')->insert($data);
    }
}

if(!function_exists('have_permission')){
    function have_permission($permission_array){
        $role = Auth::user()->role;
        if(in_array($role, $permission_array)){
            return true;
        }else{
            return false;
        }
    }
}

if (!function_exists('debug_me'))
{
    function debug_me($value,$die = 0)
    {
        echo '<pre>';
        if(is_array($value)) {
            print_r($value);
        }elseif(is_object($value)) {
            print_r($value);
        }else {
            echo $value;
        }
        echo '</pre>';
        if($die!=0){
            die();
        }
    }
}

if (!function_exists('get_currency_symbol'))
{
    function get_currency_symbol()
    {
        $value = get_basic_setting('currency');
        switch ($value) {
            case "BDT":
                return "&#2547;";
                break;
            case "INR":
                return "&#8377;";
                break;
            case "PKR":
                return "&#8360;";
                break;
            case "USD":
                return "&#36;";
            default:
                return "&#2547;";
        }

    }
}

if (!function_exists('get_customer_discount_type'))
{
    function get_customer_discount_type($id)
    {
        $customer_discount_type = DB::table('customer_discount_types')->where('id', $id)->get();
        if(isset($customer_discount_type[0])){
            return $customer_discount_type[0]->type.' <br> ('.$customer_discount_type[0]->discount.'%)';
        }else{
            return '';
        }
    }
}

if (!function_exists('get_customer_type'))
{
    function get_customer_type($id)
    {
        $customer_discount_type = DB::table('customer_types')->where('id', $id)->get();
        if(isset($customer_discount_type[0])){
            return $customer_discount_type[0]->type;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_designation'))
{
    function get_designation($id)
    {
        $designation = DB::table('employee_designations')->where('id', $id)->get();
        if(isset($designation[0])){
            return $designation[0]->name;
        }else{
            return '';
        }
    }
}

if (!function_exists('get_country'))
{
    function get_country($id)
    {
        $countries = DB::table('countries')->where('id', $id)->get();
        if(isset($countries[0])){
            return $countries[0]->name;
        }else{
            return '';
        }
    }
}