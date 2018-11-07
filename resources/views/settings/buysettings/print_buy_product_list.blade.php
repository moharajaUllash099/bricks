@extends('layouts.app_print')
@section('css')
    <style>
        @page {
            /* switch to Protrait */
            size: landscape;
        }
        tbody>tr>td{
            padding: 3px 5px;
        }
        h6,h4{
            text-align: center;
            font-weight: bold;
        }
        body {
            /*padding-top: 45px;*/
        }
    </style>
@endsection

@section('content')
    <table class="conpany-info" style="width: 100%">
        <thead>
        <tr>
            <th colspan="2">
                <h3 style="margin-top: 5px">{{get_basic_setting('company')}}</h3>
                {!! get_basic_setting('address') !!}
                <h5>Phone : {{get_basic_setting('phone')}}</h5>
                <?php $print_auther_info = get_basic_setting('print_auther_info'); ?>
                @if($print_auther_info == 'on')
                    @if(isset($branch_info[0]))
                        {{--<p style="border: 1px solid black; width: 15%; margin: 10px auto;">This copy printed form</p>--}}
                        <h4>{{$branch_info[0]->name}}</h4>
                        {!! $branch_info[0]->address !!}
                        <h5>phone : {{ $branch_info[0]->phone }}</h5>
                    @endif
                    <h6 style="text-align: center">printed by : {{Auth::user()->name}}</h6>
                @endif
            </th>
        </tr>
        <tr>
            <th style="width: 15%;border: 1px solid black;">ক্রমিক নং</th>
            <th style="width: 85%;border: 1px solid black;text-align: center">নাম</th>
        </tr>
        </thead>
        <tbody>
        <?php
                $i=1;
        ?>
        @foreach($buy_item_list as $bi)
            <tr>
                <td>{{$i}}</td>
                <td>{{$bi->name}}</td>
            </tr>
            <?php $i++; ?>
        @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script>
        window.onafterprint = function() {
            history.go(-1);
        };
    </script>
@endsection