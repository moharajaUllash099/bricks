<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{--favicons--}}
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{asset('soft/favicon/apple-touch-icon-57x57.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('soft/favicon/apple-touch-icon-114x114.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('soft/favicon/apple-touch-icon-72x72.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('soft/favicon/apple-touch-icon-144x144.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{asset('soft/favicon/apple-touch-icon-60x60.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{asset('soft/favicon/apple-touch-icon-120x120.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{asset('soft/favicon/apple-touch-icon-76x76.png')}}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{asset('soft/favicon/apple-touch-icon-152x152.png')}}" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-196x196.png')}}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-32x32.png')}}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-16x16.png')}}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{asset('soft/favicon/favicon-128.png')}}" sizes="128x128" />
    <meta name="application-name" content="{{ config('app.name') }} - {{ config('app.subtitle') }}"/>
    <meta name="msapplication-TileColor" content="#" />
    <meta name="msapplication-TileImage" content="mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />


    <title>{{ config('app.name') }} - {{ get_basic_setting('company') }}</title>
    <link href="{{asset('soft/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('soft/fonts/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .gray-bg{
            background-color: #d2d6de;
        }
    </style>
</head>
<body class="gray-bg">
<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <img class="img-responsive" src="{{asset('soft/uploads/default/soft_logo.png')}}" alt="golden poss">
        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                @alert(['alerts'=>$alerts])
                @endalert
                {{--validation errors--}}
                @if(count($errors) > 0)
                    {{--@alert(['alerts'=>$errors])
                    @endalert--}}
                    @foreach($errors->all() as $error)
                        @alert(['alerts'=>['error_'=>$error]])
                        @endalert
                    @endforeach
                @endif
                {{--session msg--}}
                @if($message = Session::get('alerts'))
                    {{--@if(session('success_'))--}}
                    @alert(['alerts'=>$message])
                    @endalert
                @endif
                @form_open(['route'=>'login'])
                    @slot('form_body')
                        <div class="form-group">
                            {!! Form::label('email','Email') !!}
                            {!! Form::email('email','admin@admin.com',[
                                'class'         =>  'form-control',
                                'id'            =>  'email',
                                'placeholder'   =>  'Enter email...',
                                'required'      =>  'required',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password','Password') !!}
                            <input class="form-control" id="password" required="required" placeholder="Enter password..." value="admin@admin.com" name="password" type="password">
                            {{--{!! Form::password('password',[
                                'class'         =>  'form-control',
                                'id'            =>  'password',
                                'required'      =>  'required',
                                'placeholder'   =>  'Enter password...',
                                'value'         =>  'admin@admin.com'
                            ]) !!}--}}
                        </div>
                    @endslot
                    @slot('form_footer')
                        {!! Form::submit('Login',["class"=>"btn btn-primary block full-width m-b"]) !!}
                    @endslot
                @endform_open
                <hr style="border-top: 1px solid #126612;margin-right: -20px;margin-left: -20px;">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">

        </div>
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-6">Copyright <a target="_blank" href="http://rowshansoft.com"><strong>Rowshan Soft</strong></a></div>
                <div class="col-xs-6 text-right"><small>&copy; 2018-{{date('Y')}}</small></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>