@extends('layouts.app')
@section('css')
    <style>
        .dataTables_filter{
            text-align: right;
        }
        .pagination{
            margin: 0px;float: right;
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
        <div class="col-xs-12">
            <a href="{{url('sale/new')}}" class="btn btn-primary btn-sm pull-right" style="margin-bottom: 10px">New Invoice</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @panelPrimary(['title'=>'Old Sales Invoices'])
                @slot('body')
                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active">
                            <a class="nav-link" data-toggle="tab" href="#tab-1">
                                Morning
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="tab" href="#tab-2">
                                Evening
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <table class="table table-bordered" id="morning_invoices_table">
                                    <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Invoice Date</th>
                                        <th>Customer Name (id)</th>
                                        <th>Total Bill</th>
                                        <th>Receive</th>
                                        <th>Advance</th>
                                        <th>Due</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div role="tabpanel" id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <table class="table table-bordered" id="evening_invoices_table">
                                    <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Invoice Date</th>
                                        <th>Customer Name (id)</th>
                                        <th>Total Bill</th>
                                        <th>Receive</th>
                                        <th>Advance</th>
                                        <th>Due</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endslot
            @endpanelPrimary
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('soft/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('soft/js/datatables.bootstrap.js') }}"></script>
    <script>
        $(function() {
            $('#morning_invoices_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('sales.datatable.morning')}}',
                columns: [
                    {data: 'inv'},
                    {data: 'sell_date',searchable: true},
                    {data: 'customer'},
                    {data: 'total_bill'},
                    {data: 'receive'},
                    {data: 'advance'},
                    {data: 'due'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });

            $('#evening_invoices_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('sales.datatable.evening')}}',
                columns: [
                    {data: 'inv'},
                    {data: 'sell_date',searchable: true},
                    {data: 'customer'},
                    {data: 'total_bill'},
                    {data: 'receive'},
                    {data: 'advance'},
                    {data: 'due'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection