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
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
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
    @yield('css')
    <style>
        .damal-menu-nev{
            top: 50px !important;
        }
        @media (min-width: 768px){
            #page-wrapper {
                margin-top: 100px;
            }
        }
    </style>
</head>
<body class="top-navigation">
<div id="wrapper">
    <div class="row">
        <nav class="navbar navbar-default navbar-fixed-top damal-nev" style="height: 20px">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" style="padding: 15px 10px; height: 30px;margin: 0px" href="{{ url('/') }}">{{--config('app.name')--}} {{ $company }}</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="height: 35px !important;">
                    <ul class="nav navbar-nav navbar-right" style="height: 35px;">
                        @if(have_permission([0]))
                        <li class="hidden-xs">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="badge d-badge">99+</span>
                                <div class="notification">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="noti-head text-light bg-damal-green">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <span>Messages (3)</span>
                                        </div>
                                    </div>
                                </div>
                                <ul id="show-notification">
                                    {{--all notifications--}}
                                    <li class="message-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <strong class="text-info">David John</strong>
                                                <div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                </div>
                                                <small class="text-warning">27.11.2015, 15:00</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="message-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <strong class="text-info">David John</strong>
                                                <div>
                                                    Lorem ipsum dolor sit amet, consectetur
                                                </div>
                                                <small class="text-warning">27.11.2015, 15:00</small>
                                            </div>
                                        </div>
                                    </li>
                                    {{--all notifications--}}
                                </ul>
                                <div class="noit-footer bg-damal-green text-center">
                                    <a href="" class="text-light">View All</a>
                                </div>
                            </div>
                        </li>
                        @endif
                        {{--notification--}}
                        @if(have_permission([1,2]))
                        <li>
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" id="show_notification" style="padding: 10px;">
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
                                {{--@if($total_notifications > 0)--}}
                                    <span class="{{($total_notifications > 0) ? 'badge d-badge' : '' }}" id="total_new_notification">
                                        @if($total_notifications > 0)
                                            {{$total_notifications}}
                                        @endif
                                    </span>
                                {{--@endif--}}
                                <div class="notification">
                                    <i class="fa fa-bell-o" aria-hidden="true"></i>
                                </div>
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
                                    <a href="{{route('Notifications')}}" class="text-light">View All</a>
                                </div>
                            </div>
                        </li>
                        @endif
                        <li>
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 10px;padding-bottom: 20px;">
                                <div class="profile">
                                    <div class="profile-name pull-left" style="margin-top: 5px;">
                                        {{ ucwords(Auth::user()->name) }}
                                        <span class="caret"></span>
                                    </div>
                                    <div class="profile-picture bg-warning pull-right" style="background-color: #fff !important;margin-top: -5px;">
                                        @if(!empty(Auth::user()->img))
                                            <img src="{{ asset('soft/uploads/'.Auth::user()->img) }}" width="44" height="44">
                                        @else
                                            <img src="{{ asset('soft/uploads/default/user.png') }}" width="44" height="44">
                                        @endif
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu show-profile">
                                <li>
                                    <a href="{{route('showProfile')}}">Profile</a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-default damal-fixed-top damal-menu-nev">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {{--<a class="navbar-brand" href="--}}{{--url('')--}}{{--">--}}{{--config('app.subtitle')--}}{{--</a>--}}
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav d-nav">
                        <li>
                            <a class="{{(isset($active_menu) && $active_menu['name'] == 'dashboard' ) ? 'active' : '' }}" href="{{ url('/') }}">
                                <i class="fa fa-th-large" aria-hidden="true"></i>
                                Dashboard
                            </a>
                        </li>
                        {{--sales start--}}
                        {{--only can see administrator, branch manager and accountant--}}
                        @if(have_permission([1,2,3,4]))
                            <li>
                                <a href="javascript:void(0)"
                                   class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'sales' ) ? 'active' : '' }}"
                                   data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                    Sales
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('oldInvoices')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'old_invoices' ) ? 'active': '' }}">
                                            Old Invoices
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('newSales')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'new_invoice' ) ? 'active': '' }}">
                                            New Invoice
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{route('return.history')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'return_history' ) ? 'active': '' }}">
                                            Return History
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('return.new')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'add_return' ) ? 'active': '' }}">
                                            New Return
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{--Due Payments--}}
                        @if(have_permission([1,2,3,4]))
                            <li>
                                <a href="javascript:void(0)"
                                   class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'due_payment' ) ? 'active' : '' }}"
                                   data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-hourglass-end" aria-hidden="true"></i>
                                    Due Payments
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('due_payment.all_due_invoices')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'all_due_invoices' ) ? 'active': '' }}">
                                            All Due Invoices
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('due_payment.receive')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'due_receive' ) ? 'active': '' }}">
                                            Due Receive
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{--customers--}}
                        @if(have_permission([1,2,3]))
                        <li>
                            <a href="javascript:void(0)"
                               class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'customers' ) ? 'active' : '' }}"
                               data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Customers
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{route('customers')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'all_customers' ) ? 'active': '' }}">
                                        All  Customers
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{route('createCustomer')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'add_customer' ) ? 'active': '' }}">
                                        Add Customer
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        {{--production--}}
                        @if(have_permission([1,2,3]))
                            <li>
                                <a href="javascript:void(0)"
                                   class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'production' ) ? 'active' : '' }}"
                                   data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-podcast" aria-hidden="true"></i>
                                    Production
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('production.history')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'production_history' ) ? 'active': '' }}">
                                            Production History
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('production.new')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'add_production' ) ? 'active': '' }}">
                                            Today's Prodiction
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{route('storage.history')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'storage_history' ) ? 'active': '' }}">
                                            Storage History
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('storage.new')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'add_storage' ) ? 'active': '' }}">
                                            New Storage
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{--cost manage--}}
                        <li>
                            <a href="javascript:void(0)"
                               class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'cost_management' ) ? 'active' : '' }}"
                               data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Cost Management
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0)" class="dropdown-toggle {{ (isset($active_child_menu) && $active_child_menu['name'] == 'vendor_management' ) ? 'active': '' }}" data-toggle="dropdown">
                                        Vendor Management
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('vendor.list')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'vendor_list' ) ? 'active': '' }}">
                                                Vendor List
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('vendor.new')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'new_vendor' ) ? 'active': '' }}">
                                                New Vendor
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @if(have_permission([1,2]))
                                <li role="separator" class="divider"></li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0)" class="dropdown-toggle {{ (isset($active_child_menu) && $active_child_menu['name'] == 'statement' ) ? 'active': '' }}" data-toggle="dropdown">
                                        Cost Head Management
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('reports.statement.customer')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'customer_statement' ) ? 'active': '' }}">
                                                Cost Category List
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('reports.statement.income')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'income_statement' ) ? 'active': '' }}">
                                                New Cost Category
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="{{route('reports.statement.customer')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'customer_statement' ) ? 'active': '' }}">
                                                Cost line item List
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('reports.statement.income')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'income_statement' ) ? 'active': '' }}">
                                                New Cost line item
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li role="separator" class="divider"></li>
                                @endif
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0)" class="dropdown-toggle {{ (isset($active_child_menu) && $active_child_menu['name'] == 'statement' ) ? 'active': '' }}" data-toggle="dropdown">
                                        Voucher Management
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{route('reports.statement.customer')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'customer_statement' ) ? 'active': '' }}">
                                                Voucher List
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('reports.statement.income')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'income_statement' ) ? 'active': '' }}">
                                                New Voucher
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        {{--cost management end--}}

                        {{--investment--}}
                        @if(have_permission([1,2]))
                            <li>
                                <a href="javascript:void(0)"
                                   class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'production' ) ? 'active' : '' }}"
                                   data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                    Investment
                                    <span class="caret"></span>
                                </a>
                                {{--<ul class="dropdown-menu">
                                    <li>
                                        <a href="{{route('production.history')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'production_history' ) ? 'active': '' }}">
                                            Production History
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('production.new')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'add_production' ) ? 'active': '' }}">
                                            Today's Prodiction
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{route('storage.history')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'storage_history' ) ? 'active': '' }}">
                                            Storage History
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('storage.new')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'add_storage' ) ? 'active': '' }}">
                                            New Storage
                                        </a>
                                    </li>
                                </ul>--}}
                            </li>
                        @endif
                        {{--investment end--}}

                        {{--reports--}}
                        @if(have_permission([1,2,3]))
                            <li>
                                <a href="javascript:void(0)"
                                   class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'reports' ) ? 'active' : '' }}"
                                   data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-flag-checkered" aria-hidden="true"></i>
                                    Reports
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-submenu">
                                        <a href="javascript:void(0)" class="dropdown-toggle {{ (isset($active_child_menu) && $active_child_menu['name'] == 'statement' ) ? 'active': '' }}" data-toggle="dropdown">
                                            Statement
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{route('reports.statement.customer')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'customer_statement' ) ? 'active': '' }}">
                                                    Customer Statement
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('reports.statement.income')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'income_statement' ) ? 'active': '' }}">
                                                    Income Statement
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{route('reports.deu_customer_list.show')}}"  class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'deu_customer_list' ) ? 'active': '' }}">
                                            Due Customer List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('reports.production_report.show')}}"  class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'production_report' ) ? 'active': '' }}">
                                            Production Report
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('reports.sells_report.show')}}"  class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'sales_report' ) ? 'active': '' }}">
                                            Sells Report
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        {{--Product Setting--}}
                        @if(have_permission([1,2]))
                        <li>
                            <a href="javascript:void(0)"
                               class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'product_setting' ) ? 'active' : '' }}"
                               data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-product-hunt" aria-hidden="true"></i>
                                Product Setting
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{route('productCategory')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'product_category' ) ? 'active': '' }}">
                                        Product Category
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a href="{{route('allProducts')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'products' ) ? 'active': '' }}">
                                        Products
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        {{--Settings--}}
                        @if(have_permission([1,2,3]))
                        <li>
                            <a href="javascript:void(0)" class="dropdown-toggle {{(isset($active_menu) && $active_menu['name'] == 'settings' ) ? 'active' : '' }}" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                <i class="fa fa-cogs" aria-hidden="true"></i>
                                Settings
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @if(have_permission([1,2]))
                                <li>
                                    <a href="{{route('generalSettings')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'general_setting' ) ? 'active': '' }}">
                                        General
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('allBranch')}}" class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'all_branch' ) ? 'active': '' }}">
                                        Branch Setup
                                    </a>
                                </li>
                                @endif
                                @if(have_permission([1,2]))
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{route('chooseInvoice')}}"  class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'choose_invoice' ) ? 'active': '' }}">
                                            Choose Invoice
                                        </a>
                                    </li>
                                @endif
                                @if(have_permission([1,2]))
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-submenu">
                                        <a href="javascript:void(0)" class="dropdown-toggle {{ (isset($active_child_menu) && $active_child_menu['name'] == 'employee' ) ? 'active': '' }}" data-toggle="dropdown">Employee</a>
                                        <ul class="dropdown-menu pull-left" style="left:0;">
                                            <li>
                                                <a href="{{route('employee.all')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'all_employee' ) ? 'active': '' }}">
                                                    Employee
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('employee.designations')}}" class="{{ (isset($active_grandchild_menu) && $active_grandchild_menu['name'] == 'employee_designations' ) ? 'active': '' }}">
                                                    Add Designation
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                @if(have_permission([1,2,3]))
                                    @if(have_permission([1,2]))
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="{{route('allCustomersDiscount')}}"  class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'customer_discount_type' ) ? 'active': '' }}">
                                                Customer Discount Type
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('allCustomersType')}}"  class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'customer_type' ) ? 'active': '' }}">
                                                Customer Type
                                            </a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                    @endif
                                    <li>
                                        <a href="{{route('allUsersInfo')}}"  class="{{ (isset($active_child_menu) && $active_child_menu['name'] == 'users' ) ? 'active': '' }}">
                                            Users
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="page-wrapper" class="gray-bg" style="padding-top: 1px">
        {{--breadcrumb--}}
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
        <div class="wrapper wrapper-content">
            @yield('content')
        </div>
        <div class="footer">
            <div class="pull-right">
                {{--
                RS  =   Rowshan soft
                AI  =   Agro Industry
                v-*.* =   Version
                --}}
                <strong>RS-AI-v.1.0.9</strong>
            </div>
            <div>
                <strong>Copyright</strong> <a target="_blank" href="http://rowshansoft.com"><strong>Rowshan Soft</strong></a> © 2018-{{date('Y')}}
            </div>
        </div>
    </div>
    @if(have_permission([1,2]))
        <script>
            $(document).ready(function () {
                /*window.setInterval(function(){
                    $.get(url+"check_jquery_login", function(data){
                        if(data == 'true'){ //check user is loged in or not
                            $.get(url+"get_total_new_notification", function(data){
                                if (data['status'] == 'success'){
                                    $('#total_new_notification').addClass('badge');
                                    $('#total_new_notification').addClass('d-badge');
                                    $('#total_new_notification').text(data['data']);
                                    $('#recent_noti').text(data['data']);
                                }
                            });
                        }else{
                            location.reload();
                        }
                    });
                }, 1000);//10 second if you want to make it 5 second it will 10000 to 5000

                $('#show_notification').on('click',function () {
                    $('#total_new_notification').text('')
                    //$('#total_new_notification').removeClass('badge');
                    //$('#total_new_notification').removeClass('d-badge');
                });*/

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
    {{--@elseif()--}}
        {{--<script>
            $(document).ready(function () {

            });
        </script>--}}
    @endif
    @yield('js')
    <script>
	/*document.addEventListener('contextmenu', event => event.preventDefault());
	$(document).keydown(function (event) {
		if ((event.ctrlKey && event.shiftKey && event.keyCode == 73) || (event.ctrlKey && event.shiftKey && event.keyCode == 74) || (event.ctrlKey && event.keyCode == 85)) {
			return false;
		}
	});*/
	</script>
</div>
</body>
</html>