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
</style>
@endsection

@section('content')
    <table class="conpany-info" style="width: 100%">
        <thead>
        <tr>
            <th colspan="4">
                <h3>{{get_basic_setting('company')}}</h3>
                {!! get_basic_setting('address') !!}
                <h5>Phone : {{get_basic_setting('phone')}}</h5>
                <br>
            </th>
        </tr>
        <?php $print_auther_info = get_basic_setting('print_auther_info'); ?>
        @if($print_auther_info == 'on')
            <tr>
                <th colspan="4">
                    @if(isset($branch_info[0]))
                        <p style="border: 1px solid black; width: 15%; margin: 10px auto;">This copy printed form</p>
                        <h5>{{$branch_info[0]->name}}</h5>
                        {!! $branch_info[0]->address !!}
                        <h6>phone : {{ $branch_info[0]->phone }}</h6>
                    @endif
                    <h6 style="text-align: center">printed by : {{Auth::user()->name}}</h6>
                </th>
            </tr>
        @endif
        </thead>
        <tbody>
            <tr>
                <td style="width: 20%">ছবি</td>
                <td style="width: 30%">নাম এবং সাধারণ তথ্য</td>
                <td style="width: 10%">কার্মরত শাখা</td>
                <td style="width: 40%">ঠিকানা</td>
            </tr>
            @foreach($employees as $c)
                <tr>
                    <td>
                        <?php $img = 'soft/uploads/default/user.png'; ?>
                        @if(!empty($c->img))
                            <?php $img = 'soft/uploads/'.$c->img; ?>
                        @endif
                        <img src="{{asset($img)}}" style="height: 80px">
                    </td>
                    <td>
                        <strong>Name : </strong> {{$c->name}} <br>
                        @if(!empty($c->nid))
                            <strong>NID/Passport/Driving Licence : </strong> {{$c->nid}} <br>
                        @endif
                        <strong>Phone : </strong> {{$c->personal_mobile}}
                        @if(!empty($c->alt_mobile))
                            <br> <strong>Phone (alt) : </strong> {{$c->alt_mobile}}
                        @endif
                        @if(!empty($c->email))
                            <br> <strong>Email : </strong> {{$c->email}}
                        @endif
                        <br> <strong>Date of Birth : </strong> {{date('d M, Y',strtotime($c->dob))}}
                        <br> <strong>Joining Date : </strong> {{date('d M, Y',strtotime($c->joining_date))}}
                    </td>
                    <td>
                        {{get_branch_name($c->branch)}}
                    </td>
                    <td>
                        <strong>Country :</strong> {{get_country($c->country)}} <br>
                        <strong>City :</strong> {{$c->city}} <br>
                        <strong>Area :</strong> {{$c->area}}
                        @if(!empty($c->post_code))
                            - {{$c->post_code}}
                        @endif
                        @if(!empty($c->house_address))
                            <br>
                            <strong>House Address :</strong> {{$c->house_address}}
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