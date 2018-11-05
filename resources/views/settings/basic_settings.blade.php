@extends('layouts.app')
<?php
$company = get_basic_setting('company');
$phone = get_basic_setting('phone');
$email = get_basic_setting('email');
$address = get_basic_setting('address');
$currency = get_basic_setting('currency');
$vat = get_basic_setting('vat');
$print_auther_info = get_basic_setting('print_auther_info');

/*smtp info*/
$smtp_host = get_basic_setting('smtp_host');
$smtp_username = get_basic_setting('smtp_username');
$smtp_password = get_basic_setting('smtp_password');
$smtp_port = get_basic_setting('smtp_port');
?>
@section('css')
    <link href="{{asset('soft/css/plugins/switchery/switchery.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('soft/summernote/css/summernote.css')}}">
    <link href="{{asset('soft/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <style>
        textarea{
            resize: none;
        }
        .tabs-container .nav-tabs > li.active {
            background-color: #ffffff !important;
        }
        .tabs-container .panel-body{
            border-radius: 0px 0px 5px 5px;
        }
        .tabs-container .tab-content > .active,
        .tabs-container .pill-content > .active{
            background-color: #fff !important;
        }
        .bootstrap-tagsinput{
            width: 100% !important;
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
            @endif
            {{--error msg--}}
            @if(session('error_'))
                @alert(['alerts'=>['error_'=>session('error_')]])
                @endalert
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            {!! Form::open(['route'=> 'savegeneralSettings']) !!}
            @panelPrimary(['title'=>'সাধারণ তথ্য'])
            @slot('body')
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#tab-1">কম্পানির তথ্য</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab-2">সাধারণ সেটিংস</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#tab-3">সফটওয়্যার সেটিংস</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('company', 'কম্পানির নাম') !!} <span style="color: red">*</span>
                                            {!! Form::text('company',$company,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'company',
                                                'required'      =>  'required',
                                                'placeholder'   =>  'Rowshan Soft'
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('phone', 'কম্পানির ফোন নম্বর') !!} <span style="color: red">*</span>
                                            {!! Form::number('phone',$phone,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'phone',
                                                'required'      =>  'required',
                                                'placeholder'   =>  '+880 1533 10 55 64'
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('email', 'কম্পানির ইমেইলি') !!}
                                            {!! Form::email('email',$email,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'email',
                                                'placeholder'   =>  'rowshansoft@gmail.com'
                                            ]) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('address', 'কম্পানির ঠিকানা') !!} <span style="color: red">*</span>
                                            {!! Form::textarea('address',$address,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'address',
                                                'placeholder'   =>  'Dhaka,Bangladesh',
                                                'rows'          =>  '8'
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('currency', 'মুদ্রা') !!} <span style="color: red">*</span>
                                            <?php
                                            $all_currency = [
                                                ''              =>  'Select Your Currency',
                                                'BDT'           =>  '&#2547; - Bangladeshi Taka',
                                                'INR'           =>  '&#8377; - Indian rupee',
                                                'PKR'           =>  '&#8360; - Pakistani rupee',
                                                'USD'           =>  '&#36; - US DOLLAR',
                                            ]
                                            ?>
                                            {!! Form::select('currency',$all_currency,$currency,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'currency'
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('vat','ভ্যাট') !!}
                                            <div class="input-group">
                                                {!! Form::text('vat',$vat,[
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'vat'
                                                ]) !!}
                                                <div class="input-group-addon">%</div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('smtp_host', 'SMTP Host') !!} <span style="color: red">*</span>
                                            {!! Form::text('smtp_host',$smtp_host,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'smtp_host'
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('smtp_username', 'SMTP Username') !!} <span style="color: red">*</span>
                                            {!! Form::text('smtp_username',$smtp_username,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'smtp_username'
                                            ]) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('smtp_password', 'SMTP Password') !!} <span style="color: red">*</span>
                                            <input class="form-control" id="smtp_password" name="smtp_password" type="password" value="{{$smtp_password}}">
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('smtp_port', 'SMTP Port') !!} <span style="color: red">*</span>
                                            {!! Form::text('smtp_port',$smtp_port,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'smtp_port'
                                            ]) !!}
                                        </div>
                                    </div>--}}
                                </div>
                            </div>
                        </div>

                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                <label>
                                    print author info when some one print <input name="print_auther_info" value="1" type="checkbox" class="js-switch" {{ ($print_auther_info == 'on') ? 'checked' : '' }} />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @endslot
            @slot('footer')
                <p style="height: 25px;">
                    {!! Form::submit('Save Change',["class"=>"btn btn-primary pull-right"]) !!}
                </p>
            @endslot
            @endpanelPrimary
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('soft/summernote/js/summernote.min.js')}}" type="text/javascript"></script>
    <!-- Switchery -->
    <script src="{{asset('soft/js/plugins/switchery/switchery.js')}}"></script>
    <!-- Tags Input -->
    <script src="{{asset('soft/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#address').summernote({
                height: 100,
                placeholder: 'write your company address',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'strikethrough',
                        'superscript','subscript', 'clear']
                    ],
                    ['font', [ 'fontname','fontsize','style','height',/*'color'*/]],
                    ['para', ['ul', 'ol', 'paragraph']],
                    //['link', ['linkDialogShow', 'unlink', 'video','picture']]
                ]
            });
            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, {color: '#1AB394',secondaryColor : '#f90606'});

            $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
            });
        });
    </script>
@endsection