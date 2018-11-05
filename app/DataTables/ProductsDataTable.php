<?php

namespace App\DataTables;

use App\Product;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables($query)
            ->editColumn('category',function ($data){
                $category = get_cat($data->category);
                return $category;
            })
            ->editColumn('price',function ($data){
                $price = get_currency_symbol(get_basic_setting('currency')).' '.$data->price;
                return $price;
            })
            ->editColumn('created_at',function ($data) {
                if ($data->created_at != $data->updated_at){
                    return $data->created_at . ' <br> ' . $data->updated_at;
                }else{
                    return $data->created_at ;
                }
            })
            ->editColumn('is_deleted',function ($data){
                if($data->is_deleted == 0){
                    return '<span class="badge badge-primary">Active</span>';
                }else{
                    return '<span class="badge badge-danger">Deleted</span>';
                }
            })
            ->addColumn('action',function ($data){
                $html = '<div class="btn-group pull-right">
                            <button data-toggle="dropdown" class="btn btn-warning btn-xs dropdown-toggle" style="margin-left: -55px; color: #000 !important; font-weight: bold" aria-expanded="false">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">';
                $edit_url = route('editProduct',$data->id);//url('product/edit/'.$data->id);
                $html .= '  <li>
                                <a href="'.$edit_url.'">Edit</a>
                            </li><li class="divider"></li>';

                if ($data->is_deleted == 0) {
                    $deactivate_url = route('deactivateProduct',$data->id);// url('product/deactivate/'.$data->id);
                    $html .= '<li>
                                <a onclick="return confirm(\'Are you sure want to deactivate this ?\');" href="' . $deactivate_url . '">
                                    Deactivate
                                </a>
                            </li>';
                }
                else{//if($data->is_deleted == 1){
                    $reactive_url = route('reactiveProduct',$data->id);//url('product/reactive/'.$data->id);
                    $html .= '<li>
                                <a onclick="return confirm(\'Are you sure want to reactive this ?\');" href="' . $reactive_url . '">
                                    Reactive
                                </a>
                            </li>';
                }
                return $html;
            })
            ->rawColumns(['action','price','created_at','is_deleted']);
    }


    public function query(Product $model)
    {
        return $model->newQuery()->select('id','name','category','price','is_deleted','created_at','updated_at');
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters([
                'dom'          => 'Bfrtip',
                'buttons'      => ['excel', 'csv',/* 'pdf', 'reset', 'reload', */ 'print'],
            ]);
    }

    protected function getColumns()
    {
        /*return [
            //'name'          =>  'Name',
            'category'      =>  'Category',
            'created_at'    =>  'Date (MWD)',
            'is_deleted'    =>  'Status'
        ];*/
        return ['name','category','created_at','is_deleted'];
    }

    protected function filename()
    {
        return 'Products_' . date('YmdHis');
    }
}
