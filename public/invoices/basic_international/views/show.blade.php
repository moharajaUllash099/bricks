<?php
$branch = (isset($payments[0])) ? $payments[0]->branch : '';
$customer = (isset($payments[0])) ? $payments[0]->customer : '';
$inv = (isset($payments[0])) ? $payments[0]->inv : '';
$date = (isset($payments[0])) ? date('d-M, Y',strtotime($payments[0]->sell_date)) : '';
$create_by = (isset($payments[0])) ? $payments[0]->create_by : '';

$delivery_man = (isset($sells[0])) ? $sells[0]->delivery_man : '';

//last part
$total_subtotal = (isset($payments[0])) ? $payments[0]->total_subtotal : '';

$vat = (isset($payments[0])) ? $payments[0]->vat : '';
$total = (isset($payments[0])) ? $payments[0]->total : '';

$discount = (isset($payments[0])) ? $payments[0]->discount : '';
$total_bill = (isset($payments[0])) ? $payments[0]->total_bill : '';
$receive = (isset($payments[0])) ? $payments[0]->receive : '';
$advance = (isset($payments[0])) ? $payments[0]->advance : '';
$due = (isset($payments[0])) ? $payments[0]->due : '';
$shift = (isset($payments[0])) ? $payments[0]->shift : '';

?>
@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>From:</h5>
                            <address>
                                <strong>{{get_basic_setting('company')}}</strong><br>
                                Branch : {{get_branch_name($branch)}}
                                Address : {!! get_branch_address($branch) !!}
                                Phone : {{get_branch_phone($branch)}}
                            </address>
                            <span>To:</span>
                            <address>
                                <strong>{{ucwords(get_customer_info($customer,'name'))}}</strong><br>
                                @if(!empty(get_customer_info($customer,'house_address')))
                                    {{ucwords(get_customer_info($customer,'house_address'))}} <br>
                                @endif
                                @if(!empty(get_customer_info($customer,'area')))
                                    {{ucwords(get_customer_info($customer,'area'))}} <br>
                                @endif
                                @if(!empty(get_customer_info($customer,'city')))
                                    {{ucwords(get_customer_info($customer,'city'))}},
                                @endif
                                @if(!empty(get_customer_info($customer,'country')))
                                    {{ucwords(get_country(get_customer_info($customer,'country')))}}
                                @endif
                                @if(!empty(get_customer_info($customer,'post_code')))
                                     - {{ucwords(get_customer_info($customer,'post_code'))}} <br>
                                @endif
                                Phone : @if(!empty(get_customer_info($customer,'personal_mobile')))
                                    {{ucwords(get_customer_info($customer,'personal_mobile'))}}
                                @endif
                            </address>
                        </div>

                        <div class="col-sm-6 text-right">
                            <h4>Invoice No. <span class="text-navy">INV-{{$inv}}</span></h4>
                            <p><strong>Date : </strong> {{$date}}</p>
                            @if(!empty(get_branch_vat_id($branch)))
                            <p><strong>Vat id : </strong> {{get_branch_vat_id($branch)}}</p>
                            @endif
                            <p><strong>Delivery Man: </strong> {{get_employee($delivery_man,'name')}}</p>
                            <p><strong>Invoice Created by: </strong> {{get_author($create_by)}}</p>
                            <p><strong>Shift: </strong> {{ucwords($shift)}}</p>
                        </div>
                    </div>

                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                            <tr>
                                <th style="width: 70%;">Product</th>
                                <th style="width: 10%;text-align: right">Unit Price</th>
                                <th style="width: 10%;text-align: right">Quantity</th>
                                <th style="width: 10%;text-align: right">Total Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sells as $s)
                                <tr>
                                    <td>{{get_product($s->product)}}</td>
                                    <td style="text-align: right">{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$s->uint_price, 2, '.', '')}}</td>
                                    <td>{{$s->quantity}} {{$s->unit}}</td>
                                    <td style="text-align: right">{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$s->subtotal, 2, '.', '')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /table-responsive -->

                    <table class="table invoice-total">
                        <tbody>
                        <tr>
                            <td><strong>Sub Total :</strong></td>
                            <td>{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$total_subtotal, 2, '.', '')}}</td>
                        </tr>
                        @if($vat)
                        <tr>
                            <td>
                                <strong>
                                @if(get_basic_setting('currency') == 'BDT')
                                    VAT {{get_basic_setting('vat')}}%
                                @else
                                    Tax {{get_basic_setting('vat')}}%
                                @endif
                                :
                                </strong></td>
                            <td>{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$vat, 2, '.', '')}}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Total :</strong>
                            </td>
                            <td>{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$total, 2, '.', '')}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td><strong>Discount :</strong></td>
                            <td>{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$discount, 2, '.', '')}}</td>
                        </tr>
                        <tr>
                            <td><strong>Total Bill :</strong></td>
                            <td>{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$total_bill, 2, '.', '')}}</td>
                        </tr>
                        <tr>
                            <td><strong>Receive :</strong></td>
                            <td>{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$receive, 2, '.', '')}}</td>
                        </tr>
                        <tr>
                            <td><strong>Advance :</strong></td>
                            <td>{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$advance, 2, '.', '')}}</td>
                        </tr>
                        <tr>
                            <td><strong>Due :</strong></td>
                            <td>{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$due, 2, '.', '')}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-right">
                        <a href="{{route('invoice.print',$inv)}}" class="btn btn-primary">Print Duplicate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection