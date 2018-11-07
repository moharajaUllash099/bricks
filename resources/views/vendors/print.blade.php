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
                <th colspan="3">
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
                <th style="width: 30%;border: 1px solid black;">প্রতিষ্ঠানের/ব্যাপারীর নাম</th>
                <th style="width: 30%;border: 1px solid black;">সাধারণ তথ্য</th>
                <th style="width: 40%;border: 1px solid black;">ঠিকানা</th>
            </tr>
        </thead>
        <tbody>

        @foreach($vendors as $v)
            <tr>
                <td>
                    @if(!empty($v->company_name))
                        <strong>প্রতিষ্ঠানের নাম : </strong> {{$v->company_name}} <br>
                    @endif
                        <strong>ব্যাপারীর নাম : </strong> {{$v->vendors_name}}
                </td>
                <td>
                    <strong>মোবাইল <br>ব্যক্তিগত  : </strong>{{$v->personal_mobile}}
                    @if(!empty($v->company_name))
                        <br><strong>বিকল্প নাম্বার : </strong> {{$v->alt_mobile}};  <br>
                    @endif
                    @if(!empty($v->company_name))
                        <br><strong>ইমেইল  : </strong> {{$v->email}};
                    @endif
                </td>
                <td>
                    <strong>ঠিকানা : </strong> {{$v->address}}
                    <br><strong>এলাকা (থানা/পোঃ) : </strong> {{ucwords($v->area)}}
                    <br><strong>জেলা : </strong> {{ucwords($v->district)}}
                    <br><strong>দেশ : </strong> {{get_country($v->country)}}
                    @if(!empty($v->post_code))
                        - {{ucwords($v->post_code)}}
                    @endif
                </td>
            </tr>
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