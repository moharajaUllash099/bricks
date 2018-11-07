@extends('layouts.app')
@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-1 col-md-offset-11">
            <a href="{{route('vendor.new')}}" class="btn btn-sm btn-primary pull-right" style="margin-bottom: 15px">নতুন ব্যাপারী</a>
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
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @panelPrimary(['title'=>'vendor list'])
            @slot('body')
                <table class="table table-bordered" id="vendor_table" style="width: 100%">
                    <thead>
                    <tr>
                        <th style="width: 25%">প্রতিষ্ঠানের/ব্যাপারীর নাম</th>
                        <th style="width: 25%">সাধারণ তথ্য</th>
                        <th style="width: 25%">ঠিকানা</th>
                        <th style="width: 15%">তৈরী/হালনাগাদ</th>
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
            window.LaravelDataTables["dataTableBuilder"]=$("#vendor_table").DataTable({
                "serverSide":true,
                "processing":true,
                "ajax":{
                    "url" : '{{route('vendor.datatable')}}',
                    "type": "GET"
                },
                "columns":[
                    {data: 'company_name',"orderable":true,"searchable":true},
                    {data: 'personal_mobile',"orderable":true,"searchable":true},
                    {data: 'address',"orderable":true,"searchable":true},
                    {data: 'created_at',"orderable":true,"searchable":true},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                "dom":"Blfrtip",
                "buttons":[
                    {
                        extend      :   'print',
                        text        :   '<i class="fa fa-print" aria-hidden="true"></i> Print all info',
                        className   :   'btn btn-primary',
                        action: function (e, dt, button, config) {
                            window.location = '{{route('vendor.print_list')}}';
                        }
                    }
                ]
            });
        });
    </script>
@endsection