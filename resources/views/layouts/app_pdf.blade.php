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
            font-family: 'Solaiman Lipi' !important;
        }
        @font-face {
            font-family: "Solaiman Lipi" !important;
            font-style: normal;
            font-weight: normal;
            src: url({{asset('soft/font/SolaimanLipi_20-04-07.ttf')}});
        }
        * {
            font-family: "Solaiman Lipi";
        }
        @page {
            header: page-header;
            footer: page-footer;
        }
        .conpany-info{
            width: 100%;
            margin-bottom: 20px;
        }
        .conpany-info>thead>tr>th>h3,.conpany-info>thead>tr>th>h5{
            text-align: center;margin: 0px;text-transform:capitalize;
        }
        .conpany-info>thead>tr>th>p,.conpany-info>tbody>tr>td>p{
            text-align: center;
        }

        .conpany-info>tbody>tr>td>h5,.conpany-info>tbody>tr>td>h6{
            text-align: center;margin: 0px;text-transform:capitalize;
        }
    </style>
    @yield('css')
</head>
<body cz-shortcut-listen="true">
<table class="conpany-info">
    <thead>
    <tr>
        <th>
            <h3>{{$company}}</h3>
            <center>
                {!! $address !!}
            </center>
            <h5>Phone : {{$phone}}</h5>
        </th>
    </tr>
    </thead>
    <?php $print_auther_info = get_basic_setting('print_auther_info'); ?>
    @if($print_auther_info == 'on')
        <tbody>
        <tr>
            <td>
                @if(isset($branch_info[0]))
                    <center>
                        <p style="border: 1px solid black; width: 25%;">This copy printed form</p>
                    </center>
                    <h5>{{$branch_info[0]->name}}</h5>
                    <center>
                        {!! $branch_info[0]->address !!}
                    </center>
                    <h6>phone : {{ $branch_info[0]->phone }}</h6>
                @endif
                <center><h6>printed by : {{Auth::user()->name}}</h6></center>
            </td>
        </tr>
        </tbody>
    @endif
</table>
@yield('content')
<htmlpagefooter name="page-footer">
    <small></small>
</htmlpagefooter>
@yield('js')
</body>
</html>
