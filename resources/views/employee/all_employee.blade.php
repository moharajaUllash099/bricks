@extends('layouts.app')
@section('css')
    <style>
        #employees_table_filter{
            text-align: right;
        }
        .pagination{
            margin: 0px;float: right;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-2 col-md-offset-10">
            <a class="btn btn-primary pull-right" href="{{route('employee.new')}}" style="margin-bottom: 10px">নতুন কর্মচারী</a>
        </div>
    </div>
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
        <div class="col-xs-12">
            @panelPrimary(['title'=>'employee information'])
            @slot('body')
                <table class="table table-bordered" id="employees_table" style="width: 100%">
                    <thead>
                    <tr>
                        <th style="width: 10%">ছবি</th>
                        <th style="width: 15%">নাম</th>
                        <th style="width: 10%">কার্মরত শাখা</th>
                        <th style="width: 15%">সাধারণ তথ্য</th>
                        <th style="width: 20%">ঠিকানা</th>
                        <th style="width: 20%">তৈরী/হালনাগাদ</th>
                        <th style="text-align: right;width: 10%">অ্যাকশন</th>
                    </tr>
                    </thead>
                </table>
            @endslot
            @endpanelPrimary
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('soft/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('soft/js/datatables.bootstrap.js') }}"></script>

    <link rel="stylesheet" href="{{asset('soft/css/plugins/dataTables/buttons.dataTables.min.css')}}">
    <script src="{{asset('vendor/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>

    <script>
        $(function() {
            window.LaravelDataTables=window.LaravelDataTables||{};
            window.LaravelDataTables["dataTableBuilder"]=$("#employees_table").DataTable({
                "serverSide":true,
                "processing":true,
                "ajax":{
                    "url" : '{{route('employee.all.datatable')}}',
                    "type": "GET"
                },
                "columns":[
                    {data: 'img',"orderable":false,"searchable":false},
                    {data: 'name',"orderable":true,"searchable":true},
                    {data: 'branch',"orderable":true,"searchable":true},
                    {data: 'personal_mobile',"orderable":true,"searchable":true},
                    {data: 'country',"orderable":true,"searchable":true},
                    {data: 'created_at',"orderable":true,"searchable":true},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    //hidden
                    /*{data:'alt_mobile',visible : false},
                    {data:'nid',visible : false},
                    {data:'email',visible : false},
                    {data:'city',visible : false},
                    {data:'area',visible : false},
                    {data:'post_code',visible : false},
                    {data:'house_address',visible : false}*/
                ],
                "dom":"Blfrtip",
                "buttons":[
                    {
                        extend      :   'print',
                        text        :   '<i class="fa fa-print" aria-hidden="true"></i> Print all info',
                        className   :   'btn btn-primary',
                        action: function (e, dt, button, config) {
                            window.location = '{{route('employee.print_info')}}';
                        }
                    }
                ]
            });
        });
    </script>
@endsection