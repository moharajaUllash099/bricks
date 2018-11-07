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
        @page {
            /* set page margins */
            margin: 0.5cm 0.5cm;
            /* Default footers */
            @bottom-left {
                content: "Powered By Rowshan Soft";
            }
            @bottom-right {
                content: counter(page) " of " counter(pages);
            }
        }
        /* footer, header - position: fixed */

        #footer {
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
            right: 0;
        }
        /* Fix overflow of headers and content */
        .custom-page-start {
            margin-top: 50px;
        }
        .custom-footer-page-number:after {
            content: counter(page);
        }

        /*for company info */
        .conpany-info{
            width: 100%;
            margin-bottom: 20px;
        }
        .conpany-info>thead>tr>th>h3,.conpany-info>thead>tr>th>h5{
            text-align: center;margin: 0px;text-transform:capitalize;
        }
        .conpany-info>thead>tr>th> p,.conpany-info>thead>tr>td>p{
            text-align: center;
        }

        .conpany-info>thead>tr>td>h5,.conpany-info>thead>tr>td>h6{
            text-align: center;margin: 0px;text-transform:capitalize;
        }
        tbody>tr>td{
            border: 1px solid black;
            padding: 3px 10px;
        }
        /*thead   {display: table-header-group;   }*/
        @media print {
            thead { display: table-header-group; }
            tfoot { display: table-footer-group; }
        }
        @media screen {
            thead { display: block; }
            tfoot { display: block; }
        }
    </style>
    @yield('css')
</head>
<body cz-shortcut-listen="true">
<!-- Custom HTML header -->
@yield('content')
<!-- Custom HTML footer -->
<div id="footer">
    <small>Powered by: Rowshan Soft. www.rowshansoft.com | 01533105564</small>
</div>
@yield('bjs')
<script type="text/javascript">
    $(document).ready(function() {
    window.print();
    });
</script>
@yield('js')
</body>
</html>
