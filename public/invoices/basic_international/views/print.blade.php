<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Print Table</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    {{--jquery--}}
    <script type="text/javascript" src="{{ asset('soft/jquery/jquery-3.3.1.min.js') }}"></script>
    <style>
        body {
            font: 12pt Georgia, "Times New Roman", Times, serif;
            line-height: 1.3;
        }
        /*
        print
         */
        @page {
            size: portrait; /*landscape*/
            /* set page margins */
            margin: 0.5cm 0.5cm;
            /* Default footers */
            @bottom-left {
                content: "powered by Rowshan Soft";
            }
            @bottom-right {
                content: counter(page) " of " counter(pages);
            }
        }
        @media print {
            thead { display: table-header-group; }
            tfoot { display: table-footer-group; }
        }
        @media screen {
            thead { display: block; }
            tfoot { display: block; }
        }
        /*
        Footer
         */
        #footer {
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
            right: 0;
        }
        /*
        table
         */
        #inv-head>tbody>tr>td{
            border: none !important;
        }
        tbody>tr>td{
            border: 1px solid black !important;
            padding: 3px 10px;
        }
        .duplicate{
            border: 1px solid black;
            padding: 10px;
            width: 150px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body cz-shortcut-listen="true">
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
<table width="100%" id="inv-head" class="table">
    <tbody>
    <tr>
        <td width="60%">
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
        </td>
        <td width="40%">
            <h4>Invoice No. <span class="text-navy">INV-{{$inv}}</span></h4>
            <p><strong>Date : </strong> {{$date}}</p>
            @if(!empty(get_branch_vat_id($branch)))
                <p><strong>Vat id : </strong> {{get_branch_vat_id($branch)}}</p>
            @endif
            <p><strong>Delivery Man: </strong> {{get_employee($delivery_man,'name')}}</p>
            <p><strong>Invoice Created by: </strong> {{get_author($create_by)}}</p>
            <p><strong>Shift: </strong> {{ucwords($shift)}}</p>
            @if(isset($invo_status))
            <p class="duplicate">{{$invo_status}}</p>
            @endif
        </td>
    </tr>
    </tbody>
</table>
<table width="100%" class="table">
    <tbody>
    <tr>
        <td style="width: 55%">
            <strong>Product</strong>
        </td>
        <td style="width: 15%;text-align: right">
            <strong>Unit Price</strong>
        </td>
        <td style="width: 15%;text-align: right">
            <strong>Quantity</strong>
        </td>
        <td style="width: 15%;text-align: right">
            <strong>Total Price</strong>
        </td>
    </tr>
    @foreach($sells as $s)
        <tr>
            <td>{{get_product($s->product)}}</td>
            <td style="text-align: right">{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$s->uint_price, 2, '.', '')}}</td>
            <td>{{$s->quantity}} {{$s->unit}}</td>
            <td style="text-align: right">{!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$s->subtotal, 2, '.', '')}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3" style="text-align: right">
            <strong>Sub Total :</strong>
        </td>
        <td style="text-align: right">
            {!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$total_subtotal, 2, '.', '')}}
        </td>
    </tr>
    @if($vat)
        <tr>
            <td colspan="3" style="text-align: right">
                <strong>
                    @if(get_basic_setting('currency') == 'BDT')
                        VAT {{get_basic_setting('vat')}}%
                    @else
                        Tax {{get_basic_setting('vat')}}%
                    @endif
                    :
                </strong></td>
            <td style="text-align: right">
                {!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$vat, 2, '.', '')}}
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: right">
                <strong>Total :</strong>
            </td>
            <td style="text-align: right">
                {!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$total, 2, '.', '')}}
            </td>
        </tr>
    @endif
    <tr>
        <td colspan="3" style="text-align: right">
            <strong>Discount :</strong>
        </td>
        <td style="text-align: right">
            {!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$discount, 2, '.', '')}}
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right">
            <strong>Total Bill :</strong>
        </td>
        <td style="text-align: right">
            {!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$total_bill, 2, '.', '')}}
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right">
            <strong>Receive :</strong>
        </td>
        <td style="text-align: right">
            {!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$receive, 2, '.', '')}}
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right">
            <strong>Advance :</strong>
        </td>
        <td style="text-align: right">
            {!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$advance, 2, '.', '')}}
        </td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right">
            <strong>Due :</strong>
        </td>
        <td style="text-align: right">
            {!! get_currency_symbol(get_basic_setting('currency')) !!} {{number_format((float)$due, 2, '.', '')}}
        </td>
    </tr>
    </tbody>
</table>
<div id="footer">
    <small>Powered by: Rowshan Soft. www.rowshansoft.com | 01533105564</small>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        window.print();
    });
    window.onafterprint = function() {
        history.go(-1);
    };
</script>

</body>
</html>