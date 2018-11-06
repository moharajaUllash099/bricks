<?php $company = get_basic_setting('company') ?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }} - {{--config('app.subtitle')--}}{{ $company }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var token = "<?php print_r(csrf_token()) ?>";
        var url = "<?php echo (url('/')) ?>/";
    </script>
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

    <!-- Fonts -->
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">--}}
    {{--jquery--}}
    <script type="text/javascript" src="{{ asset('soft/jquery/jquery-3.3.1.min.js') }}"></script>
    {{--bootstrap--}}
    <link rel="stylesheet" href="{{ asset('soft/bootstrap/css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ asset('soft/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    {{--Font Awesome--}}
    <link rel="stylesheet" href="{{ asset('soft/fonts/font-awesome/css/font-awesome.min.css') }}">
    <!-- Batch Icons -->
    <link rel="stylesheet" href="{{ asset('soft/fonts/batch-icons/css/batch-icons.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('soft/css/style.css')}}" rel="stylesheet">

    <script src="{{asset('soft/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('soft/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('soft/js/inspinia.js')}}"></script>
    <style>
        .navbar-top-links li a {
            color: #ffffff !important;
        }
        .view-all{
            padding: 0PX;
        }
        .dataTables_filter{
            text-align: right;
        }
        .pagination{
            margin: 0px;float: right;
        }
    </style>
    @yield('css')

</head>
<body class="">

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        @if(!empty(Auth::user()->img))
                            <img class="rounded-circle" src="{{ asset('soft/uploads/'.Auth::user()->img) }}" width="44" height="44">
                        @else
                            <img class="rounded-circle" src="{{ asset('soft/uploads/default/user.png') }}" width="44" height="44">
                        @endif
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">{{ ucwords(Auth::user()->name) }}</span>
                            <span class="text-muted text-xs block">{{get_soft_role(Auth::user()->role)}} <b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li>
                                <a href="{{route('showProfile')}}">প্রোফাইল</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        BI
                    </div>
                </li>
                <li>
                    <a class="{{(isset($active_menu) && $active_menu['name'] == 'dashboard' ) ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="fa fa-th-large"></i>
                        <span class="nav-label">ড্যাশবোর্ড</span>
                    </a>
                </li>

                {{--Settings--}}
                @if(have_permission([1,2,3]))
                    <li class="{{(isset($active_menu) && $active_menu['name'] == 'settings' ) ? 'active' : '' }}">
                        <a href="javascript:void(0)">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            <span class="nav-label">সেটিংস</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            @if(have_permission([1,2]))
                                <li class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'employee' ) ? 'active': '' }}">
                                    <a href="javascript:void(0)">
                                        কর্মচারী <span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-third-level">
                                        <li class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'employee_designations' ) ? 'active': '' }}">
                                            <a href="{{route('employee.designations')}}">
                                                পদবী তৈরী করুন
                                            </a>
                                        </li>
                                        <li class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'all_employee' ) ? 'active': '' }}">
                                            <a href="{{route('employee.all')}}">
                                                কর্মচারীর তালিকা
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'buy_settings' ) ? 'active': '' }}">
                                    <a href="javascript:void(0)">
                                        ক্রয় সেটিংস<span class="fa arrow"></span>
                                    </a>
                                    <ul class="nav nav-third-level">
                                        <li class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'buy_categories' ) ? 'active': '' }}">
                                            <a href="{{route('buysettings.category.all')}}">
                                                ক্যাটাগরি 
                                            </a>
                                        </li>
                                        <li class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'buy_products' ) ? 'active': '' }}">
                                            <a href="{{route('buysettings.buyProducts.all')}}">
                                                সকল ক্রয় পণ্যের নাম 
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'sells_settings' ) ? 'active': '' }}">
                                    <a href="{{route('sellsProduct.all')}}">
                                        পণ্য বিক্রি সেটিংস
                                    </a>
                                </li>

                                <li class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'all_branch' ) ? 'active': '' }}">
                                    <a href="{{route('allBranch')}}">
                                        শাথা তৈরী করুন
                                    </a>
                                </li>
                                <li class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'general_setting' ) ? 'active': '' }}">
                                    <a href="{{route('generalSettings')}}">
                                        সাধারণ সেটিংস
                                    </a>
                                </li>

                            @endif
                            @if(have_permission([1,2,3]))
                                <li class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'users' ) ? 'active': '' }}">
                                    <a href="{{route('allUsersInfo')}}">
                                        ব্যবহারকারী
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">

        <div class="row border-bottom">
            {{--top bar--}}
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0; background-color: #563d7c;">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0)"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <div style="padding: 20px 0px;color: #fff;font-size: 14px;font-weight: bold;">Welcome to {{ $company }}</div>
                    </li>
                    @if(have_permission([1,2]))
                        <li class="dropdown hidden-xs">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="javascript:void(0)" id="show_notification">
                                <i class="fa fa-bell"></i>
                                <?php
                                $total_notifications = DB::table('notifications')->where('status',0)->count();
                                //$total_notify = ;
                                $notification_limit = 6;
                                if($total_notifications > 6){
                                    $notification_limit = $total_notifications;
                                }else{
                                    $n_limit = $total_notifications+(6-$total_notifications);
                                    $notification_limit = $n_limit;
                                }
                                $home_notifications = DB::table('notifications')->limit($notification_limit)->latest()->get();
                                ?>
                                @if($total_notifications > 0)
                                    <span class="label label-primary" id="total_new_notification">{{$total_notifications}}</span>
                                @endif
                            </a>
                            <div class="dropdown-menu">
                                <div class="noti-head text-light bg-damal-green">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <span>Recent notifications (<span id="recent_noti">{{$total_notifications}}</span>)</span>
                                        </div>
                                    </div>
                                </div>
                                <ul id="show-notification">
                                    {{--all notifications--}}
                                    @foreach($home_notifications as $hn)
                                        <li class="notification-box">
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-3 col-3 text-center p-r-0">
                                                    <?php
                                                    $user_info = DB::table('users')->where('id',$hn->uid)->get();
                                                    $img = 'default/user.png';
                                                    if (isset($user_info[0]) && !empty($user_info[0]->img)){
                                                        $img = $user_info[0]->img;
                                                    }
                                                    ?>
                                                    <img src="{{ asset('soft/uploads/'.$img) }}" class="w-50 rounded-circle border-violet-1" >
                                                </div>
                                                <div class="col-lg-8 col-sm-8 col-8 p-l-0">
                                                    <strong>{{$hn->name}}</strong>
                                                    ({{get_soft_role($hn->role)}})<br>
                                                    <small>
                                                        <strong>{{ date('d-M-Y h:i:s A',strtotime($hn->created_at)) }}</strong>
                                                    </small>
                                                    <div>
                                                        {{$hn->msg}}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    {{--all notifications--}}
                                </ul>
                                <div class="noit-footer bg-damal-green text-center">
                                    <a href="{{route('Notifications')}}" class="text-light view-all no-padding">View All</a>
                                </div>
                            </div>
                        </li>
                    @endif
                    <li class="pull-right">
                        <a href="{{route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> Sign out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>

            </nav>
        </div>
        {{--breadcrumb--}}
        <div class="row wrapper border-bottom white-bg page-heading">
            <section class="breadcrumb-section" style="border-radius: 5px">
                <div class="row">
                    <div class="col-lg-4 hidden-xs">
                        <h2>
                            {{ isset($active_menu) ? ucwords(str_replace('_',' ',$active_menu['name'])) : '' }}
                            <small>Control panel</small>
                        </h2>
                    </div>
                    <div class="col-lg-8 col-xs-12">
                        <div class="btn-group btn-breadcrumb pull-right">
                            <a href="{{ url('/') }}" class="btn btn-default">
                                <i class="glyphicon glyphicon-home"></i>
                            </a>
                            @if(isset($active_menu) && isset($active_menu['name']) && isset($active_menu['link']))
                                <a href="{{ ($active_menu['link'] != 'javascript:void(0)') ? $active_menu['link'] : 'javascript:void(0)' }}" class="btn btn-default">
                                    {{ ucwords(str_replace('_',' ',$active_menu['name'])) }}
                                </a>
                            @endif
                            {{--active_child_menu--}}
                            @if(isset($active_child_menu) && isset($active_child_menu['name']) && isset($active_child_menu['link']))
                                <a href="{{ ($active_child_menu['link'] != 'javascript:void(0)') ? url($active_child_menu['link']) : 'javascript:void(0)' }}" class="btn btn-default">
                                    {{ ucwords(str_replace('_',' ',$active_child_menu['name'])) }}
                                </a>
                            @endif
                            {{--grandchild--}}
                            @if(isset($active_grandchild_menu) && isset($active_grandchild_menu['name']) && isset($active_grandchild_menu['link']))
                                <a href="{{ ($active_grandchild_menu['link'] != 'javascript:void(0)') ? url($active_grandchild_menu['link']) : 'javascript:void(0)' }}" class="btn btn-default">
                                    {{ ucwords(str_replace('_',' ',$active_grandchild_menu['name'])) }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="wrapper wrapper-content">
            @yield('content')
        </div>

        <div class="footer">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div>
                        <strong>Copyright</strong> <a target="_blank" href="http://rowshansoft.com"><strong>Rowshan Soft</strong></a> © 2018-{{date('Y')}}
                        <span class="hidden-md hidden-lg hidden-sm"><strong>RS-AI-v.0.1.9</strong></span>
                    </div>
                </div>
                <div class="col-md-4 hidden-xs">
                    <div class="pull-right">
                        <strong>RS-BI-v.0.1.1</strong>
                    </div>
                </div>
            </div>
            {{--
                RS  =   Rowshan soft
                BI  =   Bricks Industry
                v-*.* =   Version
                --}}
        </div>

    </div>
</div>
@if(have_permission([1,2]))
    <script>
        $(document).ready(function () {
            $('#show_notification').on('click',function () {
                $.get(url+"notification_see", function(data){
                    if (data == 'true'){
                        $('#total_new_notification').removeClass('badge')
                        $('#total_new_notification').removeClass('d-badge')
                        $('#total_new_notification').text('');
                        $('#recent_noti').text('0');
                    }
                });
            });
        });
    </script>
@endif
@yield('js')
</body>
</html>