<?php
#Categories work
$categories = [
    ''      =>  'Select category'
];
foreach ($all_categories as $cat){
    $categories[$cat->id] = $cat->name;
}

$customer_discount_type = [
    ''    =>  'select customer discount type'
];
foreach ($discount_type as $dt){
    $customer_discount_type[$dt->id]     =   $dt->type.' ('.$dt->discount.'%)';
}

$customer_type = [
    ''    =>  'select customer type'
];
foreach ($customer_types as $ct){
    $customer_type[$ct->id]  =   $ct->type;
}
$countries = [
    ''  =>  'Select Country'
];
foreach ($all_countries as $ac){
    $countries[$ac->id] = $ac->name;
}
?>
{{--for edit--}}
<?php
$inv = (isset($this_payments[0])) ? $this_payments[0]->inv : '';
$customer = (isset($this_payments[0])) ? $this_payments[0]->customer : '';
$sell_date = (isset($this_payments[0])) ? date('m/d/Y',strtotime($this_payments[0]->sell_date)) : date('m/d/Y');

$old_shift = (!empty(old('shift'))) ? old('shift') : 'morning';
$shift = (isset($this_payments[0])) ? $this_payments[0]->shift : $old_shift;

$total_subtotal = (isset($this_payments[0])) ? $this_payments[0]->total_subtotal : '0.00';
$vat = (isset($this_payments[0])) ? $this_payments[0]->vat : '0.00';
$total = (isset($this_payments[0])) ? $this_payments[0]->total : '0.00';
$discount = (isset($this_payments[0])) ? $this_payments[0]->discount : '0.00';
$total_bill = (isset($this_payments[0])) ? $this_payments[0]->total_bill : '0.00';
$receive = (isset($this_payments[0])) ? $this_payments[0]->receive : null;
$advance = (isset($this_payments[0])) ? $this_payments[0]->advance : null;
$due = (isset($this_payments[0])) ? $this_payments[0]->due : null;
$change_amount = (isset($this_payments[0])) ? $this_payments[0]->change_amount : '0.00';

$delivery_man = (isset($this_sales[0])) ? $this_sales[0]->delivery_man : '';

?>
@extends('layouts.app')
@section('css')
    <link href="{{asset('soft/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('soft/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <style>
        .select2-container--default .select2-selection--single{
            border-radius: 0px;
        }
        #error_info,#user_error_info,#cat_error_info{
            color: red;
        }
        .customer-address{
            border: 1px solid gainsboro;
            padding: 10px;
            background-color: ghostwhite;
        }
        #remove_customer_info{
            float: right;
            font-size: 20px;
            margin-top: -5px;
        }
        #add_new_customer{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @alert(['alerts'=>$alerts])
            @endalert
            {{--validation errors--}}
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    @alert(['alerts'=>['error_'=>$error]])
                    @endalert
                @endforeach
            @endif
            {{--success msg--}}
            @if(session('success_'))
                @alert(['alerts'=>['success_'=>session('success_')]])
                @endalert
                <script>
                    /*setInterval(function(){location.reload();}, 1000);*/
                </script>
            @endif
            {{--error msg--}}
            @if(session('error_'))
                @alert(['alerts'=>['error_'=>session('error_')]])
                @endalert
            @endif
        </div>
    </div>
    <?php
    $action = '';
    if(empty($inv)){
        $route = route('sales.saveInvoice');
        $branch_id = isset($_GET['branch']) ? $_GET['branch'] : Auth::user()->branch;
        $action = $route.'?branch='.$branch_id;
    }else{
        $action = route('invoice.update',$inv);
    }

    ?>
    {!! Form::open( ['url' => $action,'id'=>'invoice'] ) !!}
    <div class="ibox-content p-xl">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group" style="margin-bottom: 5px;">
                    {!! Form::label('To:') !!} <span style="color: red">*</span>
                    <div class="input-group" id="to_search" style="{{ !empty($inv) ? 'display:none' : ''}}">
                        {!! Form::select('customer',[
                        $customer=>get_customer_info($customer,'name')
                        ],null,[
                            'class'             =>  'form-control',
                            'id'                =>  'customers_select',
                            'required'          =>  'required'
                        ]) !!}
                        <div class="input-group-addon" style="border: 1px solid #aaa;border-left:none" id="add_new_customer">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <span id="error_info"></span>
                <address id="to_address" class="{{ !empty($inv) ? 'customer-address' : ''}}">
                    @if(!empty($inv))
                    <strong>{{get_customer_info($customer,'name')}}</strong>
                    <strong>
                        <a href="javascript:void(0)" id="remove_customer_info">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                    </strong>
                    <p>
                        @if(!empty(get_customer_info($customer,'house_address')))
                            {{get_customer_info($customer,'house_address')}}
                        @endif
                            {{get_customer_info($customer,'area')}},
                            {{get_customer_info($customer,'city')}} <br>
                            {{get_country(get_customer_info($customer,'country'))}}

                        @if(!empty(get_customer_info($customer,'post_code')))
                            - {{get_customer_info($customer,'post_code')}}
                        @endif
                    </p>
                    <strong>Phone : {{get_customer_info($customer,'personal_mobile')}}</strong>
                    @endif
                </address>
            </div>

            <div class="col-sm-6 text-right">
                <h4>Invoice No. <span class="text-navy">INV-{{ (!empty($inv)) ? $inv : time() }}</span>
                    {!!Form::hidden('inv', (!empty($inv)) ? $inv : time())!!}
                </h4>
                <p>
                    @if(!empty($branch_vat_id) and !empty(get_basic_setting('vat')) )
                        VAT ID: {{$branch_vat_id}}
                    @endif
                </p>
                <div class="form-group" id="data_1">
                    <div class="input-group date" style="width: 35%;float: right">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        {!! Form::text('date', $sell_date,[
                            'class'         =>  'form-control',
                            'required'      =>  'required',
                            'readonly'      =>  'readonly'
                        ]) !!}
                    </div>
                    <strong>{!! Form::label('date','Date:',[
                        'style' =>  'margin-top: 8px;font-size: 14px;'
                    ]) !!}</strong>
                </div>
                <div class="form-group">
                    {!! Form::label('Delivery Man:') !!} <span style="color: red">*</span>
                    {!! Form::select('delivery_man',[
                        $delivery_man => get_employee($delivery_man,'name')
                    ],$delivery_man,[
                        'class'             =>  'form-control pull-right',
                        'id'                =>  'employee_select',
                        'required'          =>  'required',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('shift','Shift :',['style'=>'margin-top:10px']) !!} <span style="color: red">*</span>
                    {!! Form::select('shift',['morning' => 'Morning','evening' => 'Evening',],$shift,[
                        'class'             =>  'form-control',
                        'required'          =>  'required',
                        'style'             =>  'width:120px;display: inline;',
                    ]) !!}
                </div>
            </div>
        </div>
        <hr style="margin: 20px -40px;border-top: 2px solid #eee;">
        <div class="row">
            <div class="col-xs-12">
                <span id="cat_error_info"></span>
            </div>
        </div>
        <div class="table-responsive m-t">
            <table class="table invoice-table">
                <thead>
                <tr>
                    <th style="width: 20%;">Category</th>
                    <th style="width: 30%;text-align: left">Product</th>
                    <th style="width: 15%">Unit Price</th>
                    <th style="width: 15%">Quantity</th>
                    <th style="width: 20%; text-align: right">Total Price</th>
                </tr>
                </thead>
                <tbody id="dynamic">
                @if(empty($inv))
                <tr>
                    <td style="width: 15%">
                        <div class="form-group">
                            {!! Form::select('cat[]',$categories, 1,[
                                'class'         =>  'form-control cat',
                                'required'      =>  'required',
                                'im'            =>  '0'
                            ]) !!}
                        </div>
                    </td>
                    <td style="text-align: left">
                        <div class="form-group">
                            {!! Form::select('product[]',[''=>'Select Product'], null,[
                                'class'         =>  'form-control get_price',
                                'required'      =>  'required',
                                'id'            =>  'product_0',
                                'im'            =>  '0'
                            ]) !!}
                        </div>
                        <script>
                            $(function () {
                                $.ajax({
                                    url: '{{route('sales.get_product')}}',
                                    type: 'POST',
                                    data: {category : '1',product : '1', '_token': '{{ csrf_token() }}'},
                                    dataType: 'json',
                                    success: function( data ) {
                                        if(data.errors){
                                            $('#cat_error_info').text(data.errors);
                                        }
                                        if(data.success){
                                            $('#cat_error_info').text('');
                                            $('#product_0').html(data.success);
                                        }
                                    }
                                });
                                $.ajax({
                                    url: '{{route('sales.get_price')}}',
                                    type: 'POST',
                                    data: {product : 1, '_token': '{{ csrf_token() }}'},
                                    dataType: 'json',
                                    success: function( data ) {
                                        if(data.errors){
                                            $('#cat_error_info').text(data.errors);
                                            $('#uint_price_0').val('');
                                        }
                                        if(data.success){
                                            $('#uint_price_0').val(data.success);
                                        }
                                        //console.log(data)
                                    }
                                });
                            });
                        </script>
                    </td>
                    <td>
                        <div class="input-group">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('uint_price[]',null,[
                                'class'         =>  'form-control uint_price',
                                'required'      =>  'required',
                                'id'            =>  'uint_price_0',
                                'im'            =>  '0',
                                'style'         =>  'text-align:right;',
                                'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="col-xs-6" style="padding-right: 0px">
                                {!! Form::number('quantity[]',null,[
                                    'class'         =>  'form-control quantity',
                                    'required'      =>  'required',
                                    'im'            =>  '0',
                                    'id'            =>  'quantity0',
                                    'style'         =>  'text-align:right',
                                    'step'          =>  "0.01"
                                ]) !!}
                            </div>
                            <div class="col-xs-6" style="padding-left: 0px">
                                {!! Form::select('unit[]',[
                                        'L'=>'L',
                                        'KG'=>'KG',
                                        'Piece'=>'Piece',
                                    ], null,[
                                    'class'         =>  'form-control',
                                    'required'      =>  'required',
                                    'id'            =>  'size_0',
                                    'im'            =>  '0'
                                ]) !!}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('subtotal[]',null,[
                            'class'         =>  'form-control subtotal',
                            'required'      =>  'required',
                            'id'            =>  'subtotal_0',
                            'im'            =>  '0',
                            'readonly'      =>  'readonly',
                            'style'         =>  'text-align:right',
                            'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                </tr>
                @else
                    @foreach($this_sales as $ts)
                    <tr>
                        <td style="width: 15%">
                            <div class="form-group">
                                {!! Form::hidden('id[]',$ts->id,[
                                    'required'      =>  'required',
                                    'im'            =>  $ts->id
                                ]) !!}
                                {!! Form::select('cat[]',$categories, $ts->cat,[
                                    'class'         =>  'form-control cat',
                                    'required'      =>  'required',
                                    'im'            =>  $ts->id,
                                    //'onload'        => 'get_product('.$categories.','.$ts->product.')'
                                ]) !!}
                                <script>
                                    $(function () {
                                        $.ajax({
                                            url: '{{route('sales.get_product')}}',
                                            type: 'POST',
                                            data: {category : '{{$ts->cat}}',product : '{{$ts->product}}', '_token': '{{ csrf_token() }}'},
                                            dataType: 'json',
                                            success: function( data ) {
                                                if(data.errors){
                                                    $('#cat_error_info').text(data.errors);
                                                }
                                                if(data.success){
                                                    $('#cat_error_info').text('');
                                                    $('#product_'+'{{$ts->id}}').html(data.success);
                                                }
                                                //console.log(data)
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </td>
                        <td style="text-align: left">
                            <div class="form-group">
                                {!! Form::select('product[]',[''=>'Select Product'], null,[
                                    'class'         =>  'form-control get_price',
                                    'required'      =>  'required',
                                    'id'            =>  'product_'.$ts->id,
                                    'im'            =>  $ts->id
                                ]) !!}
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    {!! get_currency_symbol(get_basic_setting('currency')) !!}
                                </div>
                                {!! Form::number('uint_price[]',$ts->uint_price,[
                                    'class'         =>  'form-control uint_price',
                                    'required'      =>  'required',
                                    'id'            =>  'uint_price_'.$ts->id,
                                    'im'            =>  $ts->id,
                                    'style'         =>  'text-align:right;',
                                    'step'          =>  "0.01"
                                ]) !!}
                            </div>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-xs-6" style="padding-right: 0px">
                                    {!! Form::number('quantity[]',$ts->quantity,[
                                        'class'         =>  'form-control quantity',
                                        'required'      =>  'required',
                                        'im'            =>  $ts->id,
                                        'id'            =>  'quantity'.$ts->id,
                                        'style'         =>  'text-align:right',
                                        'step'          =>  "0.01"
                                    ]) !!}
                                </div>
                                <div class="col-xs-6" style="padding-left: 0px">
                                    {!! Form::select('unit[]',[
                                            'L'=>'L',
                                            'KG'=>'KG',
                                            'Piece'=>'Piece',
                                        ], $ts->unit,[
                                        'class'         =>  'form-control',
                                        'required'      =>  'required',
                                    ]) !!}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="input-group" style="float: right">
                                <div class="input-group-addon">
                                    {!! get_currency_symbol(get_basic_setting('currency')) !!}
                                </div>
                                {!! Form::number('subtotal[]',number_format((float)$ts->subtotal, 2, '.', ''),[
                                'class'         =>  'form-control subtotal',
                                'required'      =>  'required',
                                'id'            =>  'subtotal_'.$ts->id,
                                'im'            =>  $ts->id,
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                                ]) !!}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
                </tbody>
                @if(empty($inv))
                <tfoot>
                <tr>
                    <td colspan="5">
                        <button type="button" class="btn btn-warning btn-xs pull-right more">more</button>
                    </td>
                </tr>
                @endif
                </tfoot>
            </table>
        </div><!-- /table-responsive -->
        <table class="table table-bordered">
            @if(!empty($branch_vat_id) and !empty(get_basic_setting('vat')) )
                <tr>
                    <td style="width: 10%">
                        <strong>Sub Total :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('total_subtotal',number_format((float)$total_subtotal, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'total_subtotal',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                    <td>
                        <strong>
                            @if(get_basic_setting('currency') == 'BDT')
                                VAT {{get_basic_setting('vat')}}%
                            @else
                                Tax {{get_basic_setting('vat')}}%
                            @endif
                            :
                        </strong>
                    </td>
                    <td>
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('vat',number_format((float)$vat, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'vat',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                                ]) !!}
                        </div>
                    </td>
                    <td>
                        <strong>Total :</strong>
                    </td>
                    <td>
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('total',number_format((float)$total, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'total',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                                ]) !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                        <strong>Discount : </strong>
                    </td>
                    <td style="width: 20%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('discount',number_format((float)$discount, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'discount',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                                ]) !!}
                        </div>
                    </td>
                    <td style="width: 10%">
                        <strong>Total Bill:</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('total_bill',number_format((float)$total_bill, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'total_bill',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                                ]) !!}
                        </div>
                    </td>
                    <td style="width: 10%">
                        <strong>Receive :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('receive',number_format((float)$receive, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'receive',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                        <strong>Advance :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            @if($receive < $total_bill)
                                {!! Form::number('advance',number_format((float)$advance, 2, '.', ''),[
                                    'class'         =>  'form-control',
                                    'id'            =>  'advance',
                                    'style'         =>  'text-align:right',
                                    'step'          =>  "0.01",
                                    'readonly'      =>  'readonly'
                                ]) !!}
                            @else
                                {!! Form::number('advance',number_format((float)$advance, 2, '.', ''),[
                                    'class'         =>  'form-control',
                                    'id'            =>  'advance',
                                    'style'         =>  'text-align:right',
                                    'step'          =>  "0.01"
                                ]) !!}
                            @endif
                            <span class="text-danger">Note : Add advance Amount</span>
                        </div>
                    </td>
                    <td style="width: 10%">
                        <strong>Due :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('due',number_format((float)$due, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'id'            =>  'due',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                    <td style="width: 10%">
                        <strong>Return :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('change_amount',number_format((float)$change_amount, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'return',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                </tr>
            @else
                <tr>
                    <td style="width: 10%">
                        <strong>Sub Total :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('total_subtotal',number_format((float)$total_subtotal, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'total_subtotal',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                    <td style="width: 10%">
                        <strong>Discount : </strong>
                    </td>
                    <td style="width: 20%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('discount',number_format((float)$discount, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'discount',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                                ]) !!}
                        </div>
                    </td>
                    <td style="width: 10%">
                        <strong>Total Bill:</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('total_bill',number_format((float)$total_bill, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'total_bill',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                                ]) !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">
                        <strong>Receive :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('receive',number_format((float)$receive, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'receive',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                    <td style="width: 10%">
                        <strong>Advance :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            @if($receive < $total_bill)
                                {!! Form::number('advance',number_format((float)$advance, 2, '.', ''),[
                                    'class'         =>  'form-control',
                                    'id'            =>  'advance',
                                    'style'         =>  'text-align:right',
                                    'step'          =>  "0.01",
                                    'readonly'      =>  'readonly'
                                ]) !!}
                            @else
                                {!! Form::number('advance',number_format((float)$advance, 2, '.', ''),[
                                    'class'         =>  'form-control',
                                    'id'            =>  'advance',
                                    'style'         =>  'text-align:right',
                                    'step'          =>  "0.01"
                                ]) !!}
                            @endif
                            <span class="text-danger">Note : Add advance Amount</span>
                        </div>
                    </td>
                    <td style="width: 10%">
                        <strong>Due :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('due',$due,[
                                'class'         =>  'form-control',
                                'id'            =>  'due',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td style="width: 10%">
                        <strong>Return :</strong>
                    </td>
                    <td style="width: 25%">
                        <div class="input-group" style="float: right">
                            <div class="input-group-addon">
                                {!! get_currency_symbol(get_basic_setting('currency')) !!}
                            </div>
                            {!! Form::number('change_amount',number_format((float)$change_amount, 2, '.', ''),[
                                'class'         =>  'form-control',
                                'required'      =>  'required',
                                'id'            =>  'return',
                                'readonly'      =>  'readonly',
                                'style'         =>  'text-align:right',
                                'step'          =>  "0.01"
                            ]) !!}
                        </div>
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="5"></td>
                <td><input type="submit" id="submit" class="btn btn-primary pull-right" value="Save"></td>
            </tr>
        </table>
    </div>
    {!! Form::close() !!}
    <input type="hidden" id="customer_discount">
    <br>
    {{--register new customer--}}
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header" style="padding: 10px 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">ADD NEW CUSTOMER</h4>
                </div>
                <form method="POST" action="#" accept-charset="UTF-8" id="new_customer">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div id="spinner">
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                        </div>
                        <div id="modal-body-customer">
                            <div class="row">
                                <div class="col-xs-12">
                                    <span id="user_error_info"></span>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('name','Customer Name') !!} <span style="color: red">*</span>
                                                {!! Form::text('name',null,[
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'name',
                                                    'placeholder'   =>  'MD. Masud',
                                                    'required'      =>  'required',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        {!! Form::label('type','Customer Type') !!} <span style="color: red">*</span>
                                                        {!! Form::select('type',$customer_type, null,[
                                                            'class'         =>  'form-control',
                                                            'id'            =>  'type',
                                                            'required'      =>  'required',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                    <div class="form-group">
                                                        {!! Form::label('discount_type','Customer Discount Type') !!} <span style="color: red">*</span>
                                                        {!! Form::select('discount_type',$customer_discount_type, 1,[
                                                            'class'         =>  'form-control',
                                                            'id'            =>  'type',
                                                            'required'      =>  'required',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('personal_mobile','Mobile (Personal)') !!} <span style="color: red">*</span>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-phone-square" aria-hidden="true"></i>
                                                    </div>
                                                    {!! Form::number('personal_mobile',null,[
                                                        'class'         =>  'form-control',
                                                        'id'            =>  'personal_mobile',
                                                        'placeholder'   =>  '+8801xxxxxxxxx',
                                                        'required'      =>  'required',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('alt_mobile','Mobile (Alternative)') !!}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-phone-square" aria-hidden="true"></i>
                                                    </div>
                                                    {!! Form::number('alt_mobile',null,[
                                                        'class'         =>  'form-control',
                                                        'id'            =>  'alt_mobile',
                                                        'placeholder'   =>  '+8801xxxxxxxxx',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('nid','NID/Passport/Driving Licence') !!}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-id-card" aria-hidden="true"></i>
                                                    </div>
                                                    {!! Form::number('nid',null,[
                                                        'class'         =>  'form-control',
                                                        'id'            =>  'nid',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('email','Email') !!}
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                                    </div>
                                                    {!! Form::email('email',null,[
                                                        'class'         =>  'form-control',
                                                        'id'            =>  'email',
                                                    ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('country','Country') !!} <span style="color: red">*</span>
                                                {!! Form::select('country',$countries, 16,[
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'country',
                                                    'required'      =>  'required',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('city','City') !!} <span style="color: red">*</span>
                                                {!! Form::text('city', 'Jhenaidah',[
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'city',
                                                    'required'      =>  'required',
                                                    'placeholder'   =>  'Dhaka',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('area','Area (Thana/PO)') !!} <span style="color: red">*</span>
                                                {!! Form::text('area','Shailkupa',[
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'area',
                                                    'required'      =>  'required',
                                                    'placeholder'   =>  'Mohammadpur',
                                                ]) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('post_code','Post Code') !!}
                                                {!! Form::text('post_code',7320,[
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'post_code',
                                                    'placeholder'   =>  '1209',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('house_address','Vill & House Address') !!}
                                        {!! Form::text('house_address',null,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'house_address',
                                            'placeholder'   =>  '57/1 Jafrabad',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('comment','Comment') !!}
                                        {!! Form::text('comment',null,[
                                            'class'         =>  'form-control',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save_change">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{asset('soft/js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('soft/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
    <script>
        $(document).ready(function(){
            //not changeable

            //date picker
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            var csrf = $('meta[name="csrf-token"]').attr('content');
            //employee search
            $("#employee_select").select2({
                placeholder: "search employee name",
                allowClear: true,
                ajax : {
                    url : '{{route('employee.name.search')}}',
                    dataType : 'json',
                    delay : 200,
                    data : function(params){
                        return {
                            q : params.term,
                            page : params.page
                        };
                    },
                    processResults : function(data, params){
                        params.page = params.page || 1;
                        return {
                            results : data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    }
                },
                minimumInputLength : 1,
                width : '80%',
                templateResult : function (repo){
                    var img =  '';
                    return repo.name;
                },
                templateSelection : function(repo){
                    var showtext = repo.text;
                    if(repo.name != undefined) {
                        showtext = repo.name;
                    }
                    return showtext;
                },
                escapeMarkup : function(markup){ return markup; },
            });
            //customer search
            $("#customers_select").select2({
                placeholder: "search a customer",
                allowClear: true,
                ajax : {
                    url : '{{route('sales.get_customer')}}',
                    dataType : 'json',
                    delay : 200,
                    data : function(params){
                        return {
                            q : params.term,
                            page : params.page
                        };
                    },
                    processResults : function(data, params){
                        params.page = params.page || 1;
                        return {
                            results : data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    }
                },
                minimumInputLength : 1,
                width : '450px',
                templateResult : function (repo){
                    var img =  '';
                    if(repo.loading){
                        return repo.name;
                    }else{
                        if(repo.img != null){
                            img = url+'soft/uploads/'+repo.img;
                        }else{
                            img = url+'soft/uploads/default/user.png';
                        }
                    }
                    var markup = "<div class='row' style='margin-left: 0px;margin-right: 0px;'>" +
                        "<div class='col-xs-2'>" +
                        "<img src=" + img + " style='width:50px'></img>"+
                        "</div>"+
                        "<div style='col-xs-10'>" +
                        "Name : " + repo.name+'<br> Mobile (Personal) :'+repo.personal_mobile +"<br>"+
                        "Mobile (Alternative) : " + repo.alt_mobile+'<br> NID/Passport/Driving Licence : '+repo.nid +
                        "</div>"
                    "</div>";

                    return markup;
                },
                templateSelection : function(repo){
                    var showtext = repo.text;
                    if(repo.name != undefined) {
                        showtext = repo.name;
                    }
                    return showtext;
                },
                escapeMarkup : function(markup){ return markup; }
            });

            $('#customers_select').on('change',function () {
                var id = $(this).val();
                get_customer_info(id);
            });

            function get_customer_info(id){
                $.ajax({
                    url: '{{route('sales.get_customer_info')}}',
                    type: 'POST',
                    data: {to : id, '_token': csrf},
                    dataType: 'json',
                    success: function( data ) {
                        if(data.errors){
                            $('#error_info').text(data.errors);
                        }
                        if(data.success){
                            $('#error_info').text('');
                            $('#to_address').html(data.success);
                            $('#to_search').hide();
                            $('#to_address').addClass('customer-address');
                            get_customer_discount(id);
                        }
                    }
                });
            };

            function get_customer_discount(id){
                $.ajax({
                    url: '{{route('sales.get_customer_discount_info')}}',
                    type: 'POST',
                    data: {customer_id : id, '_token': csrf},
                    dataType: 'json',
                    success: function( data ) {
                        if(data.errors){
                            $('#error_info').text(data.errors);
                        }
                        if(data.success){
                            $('#customer_discount').val(data.success);
                            $('#error_info').text('');
                            calculate_discount()
                        }
                    }
                });
            }

            $(document).on('click','#remove_customer_info',function () {
                $('#to_address').html('');
                $('#to_address').removeClass('customer-address');
                $('#to_search').show();
                $("#customers_select").select2("val", "");
            });

            $('#add_new_customer').on('click',function () {
                $('#myModal').modal('toggle');
            });

            $('#save_change').on('click',function () {
                $('#spinner').addClass('sk-spinner sk-spinner-cube-grid')
                $.ajax({
                    url: '{{route('sales.add_customer_info')}}',
                    type: 'POST',
                    data: $('#new_customer').serialize(),
                    dataType: 'json',
                    success: function( data ) {
                        $('#spinner').removeClass('sk-spinner sk-spinner-cube-grid');
                        if(data.errors){
                            $('#user_error_info').text(data.errors);
                        }
                        if(data.success){
                            $("#new_customer input[type=text]").each(function(){
                                $(this).val('')
                            });
                            $("#new_customer input[type=number]").each(function(){
                                $(this).val('')
                            });
                            $('#customers_select').html('<option value="'+data.success+'" selected="selected">'+$('#name').val()+'</option>')
                            $('#myModal').modal('toggle');
                            get_customer_info(data.success);
                        }
                    }
                });
            });

            //change able
            var category = '<option value="" selected="selected">Select category</option>';
            <?php
                foreach ($all_categories as $cat){
                ?>
                category +=  '<option value="{{$cat->id}}">{{$cat->name}}</option>';
                <?php } ?>
            var vat = 0;
            var item = 1;
            var currency = "{!! get_currency_symbol(get_basic_setting('currency')) !!}";
            @if(!empty($branch_vat_id) and !empty(get_basic_setting('vat')) )
                vat = '{{get_basic_setting('vat')}}';
            @endif

            $('.more').on('click',function () {
                var html = '<tr id="row_'+item+'">' +
                    '<td style="width: 15%">' +
                    '<div class="form-group">' +
                    '<select class="form-control cat" required="required" im="'+item+'" name="cat[]">' +
                    category +
                    '</select>' +
                    '</div>' +
                    '</td>' +
                    '<td style="text-align: left">' +
                    '<div class="form-group">' +
                    '<select class="form-control get_price" required="required" id="product_'+item+'" im="'+item+'" name="product[]">' +
                    '<option value="" selected="selected">Select Product</option>' +
                    '</select>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="input-group">' +
                    '<div class="input-group-addon">' +
                    currency +
                    '</div>' +
                    '<input class="form-control" required="required" id="uint_price_'+item+'" im="'+item+'" style="text-align:right;" name="uint_price[]" type="number" step="0.01">' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="row">' +
                    '<div class="col-xs-6" style="padding-right: 0px">' +
                    '<input class="form-control quantity" required="required" id="quantity'+item+'" im="'+item+'" style="text-align:right" name="quantity[]" type="number" step="0.01">' +
                    '</div>' +
                    '<div class="col-xs-6" style="padding-left: 0px">' +
                    '<select class="form-control" required="required" id="size_'+item+'" im="'+item+'" name="unit[]">' +
                    '<option value="L">L</option>' +
                    '<option value="KG">KG</option>' +
                    '<option value="Pitch">Pitch </option>' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '</td>'+
                    '<td>' +
                    '<div class="input-group" style="float: right">' +
                    '<div class="input-group-addon">' +
                    currency +
                    '</div>' +
                    '<input class="form-control subtotal" required="required" id="subtotal_' + item + '" im="' + item + '" readonly="readonly" style="text-align:right" name="subtotal[]" type="number" step="0.01">' +
                    '</div>' +
                    '<a href="javascript:void(0)" class="btn btn-danger btn-xs remove" im="' + item + '" style="margin-top: -109px;position: relative;">' +
                    '<i class="fa fa-times-circle-o" aria-hidden="true"></i>' +
                    '</a>' +
                    '</td>'+
                    '</tr>';
                $('#dynamic').append(html);
                item++
            });

            //removing dynamic tr
            $(document).on('click','.remove',function () {
                var im = $(this).attr('im');
                $('#row_'+im).remove();
            });

            $(document).on('change','.cat',function () {
                var im = $(this).attr('im');
                var id = $(this).val();
                if(id != '') {
                    $.ajax({
                        url: '{{route('sales.get_product')}}',
                        type: 'POST',
                        data: {category : id, '_token': csrf},
                        dataType: 'json',
                        success: function( data ) {
                            if(data.errors){
                                $('#cat_error_info').text(data.errors);
                            }
                            if(data.success){
                                $('#cat_error_info').text('');
                                $('#product_'+im).html(data.success);
                            }
                            //console.log(data)
                        }
                    });
                }
            });

            $(document).on('change','.get_price',function () {
                var im = $(this).attr('im');
                var id = $(this).val();
                if(id != '') {
                    $.ajax({
                        url: '{{route('sales.get_price')}}',
                        type: 'POST',
                        data: {product : id, '_token': csrf},
                        dataType: 'json',
                        success: function( data ) {
                            if(data.errors){
                                $('#cat_error_info').text(data.errors);
                                $('#uint_price_'+im).val('');
                            }
                            if(data.success){
                                $('#cat_error_info').text('');
                                $('#uint_price_'+im).val(data.success);
                                var quantity = $('#quantity'+im).val();
                                if(quantity != '' && !isNaN(quantity)){
                                    calculate_subtotal(im,quantity);
                                }
                            }
                            //console.log(data)
                        }
                    });
                }
                else{
                    $('#uint_price_'+im).val('');
                    $('#quantity'+im).val('');
                    calculate_subtotal(im,0);
                }
            });

            $(document).on('keyup','.uint_price',function () {
                var im = $(this).attr('im');
                var quantity = $('#quantity'+im).val();
                if(quantity !='' && im != ''){
                    calculate_subtotal(im,quantity);
                }else{
                    $('#subtotal_'+im).val('');
                    //alert('error: quantity not found');
                }
            });

            $(document).on('keyup','.quantity',function () {
                var im = $(this).attr('im');
                var quantity = $(this).val();
                if(quantity !='' && im != ''){
                    calculate_subtotal(im,quantity);
                }else{
                    $('#subtotal_'+im).val('');
                    //alert('error: quantity not found');
                }
            });

            function calculate_subtotal(im,quantity) {
                var uint_price = parseFloat($('#uint_price_'+im).val());
                var subtotal = 0.00;
                if(uint_price != '' && quantity != '') {
                    subtotal = parseFloat(uint_price*quantity).toFixed(2);
                }
                if(!isNaN(subtotal)) {
                    $('#subtotal_' + im).val(subtotal);
                    total()
                }
            };

            function total() {
                var sum_sub_total = 0;//,discount_amount,discount,total_bill = 0 ;

                $('.subtotal').each(function () {
                    var subtotal = Number($(this).val());// parseFloat($(this).val()).toFixed(2);
                    if(!isNaN(subtotal)){
                        sum_sub_total+=subtotal
                    }
                });
                $('#total_subtotal').val(sum_sub_total);
                if(vat == 0){//if vat is not set
                    calculate_discount()
                }
                else if(vat > 0){
                    calculate_vat()
                }
            };

            //calculate vat
            function calculate_vat() {
                var total_subtotal = 0;
                if (!isNaN($('#total_subtotal').val())) {
                    total_subtotal = $('#total_subtotal').val();
                }
                total_vat = (total_subtotal*vat)/100;
                var total = Number(total_subtotal)+Number(total_vat);
                $('#vat').val(parseFloat(total_vat).toFixed(2));
                $('#total').val(parseFloat(total).toFixed(2));
                calculate_discount()
            }


            //calculate discount
            function calculate_discount(){
                var discount,total_subtotal = 0;
                var discount_amount = 0;
                if (!isNaN($('#customer_discount').val())) {
                    discount = $('#customer_discount').val();
                }
                if (!isNaN($('#total_subtotal').val())) {
                    total_subtotal = $('#total_subtotal').val();
                }

                discount_amount = parseFloat((Number(total_subtotal)*Number(discount))/100).toFixed(2);
                $('#discount').val(discount_amount);
                total_bill();
            }
            $('#discount').on('keyup',function () {
                total_bill();
            });

            //calculate total bill
            function total_bill(){
                var discount_amount = 0;
                var total_subtotal = 0;
                var vat_amount = 0;
                var total_bill = 0;
                if (!isNaN($('#discount').val())) {
                    discount_amount = $('#discount').val();
                }
                if (!isNaN($('#total_subtotal').val())) {
                    total_subtotal = $('#total_subtotal').val();
                }
                if (!isNaN($('#vat').val())) {
                    vat_amount = $('#vat').val();
                }
                total_bill = Number(total_subtotal)+Number(vat_amount)-Number(discount_amount);
                $('#total_bill').val(parseFloat(total_bill).toFixed(2));
                return_amount();
            }

            $('#receive').on('keyup',function () {
                return_amount();
            });

            $('#advance').on('keyup',function () {
                return_amount();
            });

            function return_amount() {
                var receive = Number($('#receive').val());
                var total_bill = Number($('#total_bill').val());
                var advance = Number($('#advance').val());
                var return_amount = receive-total_bill;
                if(return_amount < 0){
                    $('#advance').attr('readonly','readonly');
                    $('#advance').val('0.00');
                    $('#due').val(Math.abs(parseFloat(return_amount).toFixed(2)));
                    $('#return').val('0.00');
                }
                if(return_amount >= 0){
                    $('#advance').removeAttr('readonly');
                    $('#due').val('0.00');
                    if(advance != '' || advance >0){
                        $('#receive').val(parseFloat(total_bill).toFixed(2));
                        $('#return').val('0.00');
                    }else{
                        $('#return').val(parseFloat(return_amount).toFixed(2));
                    }
                }
            };
        });
    </script>
@endsection