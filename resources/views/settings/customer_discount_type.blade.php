<?php
$id = (isset($this_record[0])) ? $this_record[0]->id : '';
$type = (isset($this_record[0])) ? $this_record[0]->type : old('type');
$discount = (isset($this_record[0])) ? $this_record[0]->discount : old('discount');
?>
@extends('layouts.app')

@section('css')
    <style>
        #customer_type_table_filter{
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
        <div class="col-xs-12 col-md-8">
            @panelPrimary(['title'=>'Customer Discount Type Information'])
                @slot('body')
                    <table class="table table-bordered" id="customer_type_table">
                        <thead>
                        <tr>
                            <td>Type</td>
                            <td>Discount Amount</td>
                            <td>Date</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                    </table>
                @endslot
            @endpanelPrimary
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="alert alert-info">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                Fields with (*) are required.
            </div>
            @panelPrimary(['title'=> (empty($id))  ? 'New Customer Discount Type' : 'Update Customer Discount Type' ])
            @slot('body')
                @if(empty($id))
                    @form_open(['route'=>'saveCustomerDiscountType'])
                @else
                    @form_open(['route'=>['updateCustomerDiscountType',$id]])
                @endif
                @slot('form_body')
                    <div class="form-group">
                        {!! Form::label('type','Type') !!} <span style="color: red">*</span>
                        {!! Form::text('type',$type,[
                            'class'         =>  'form-control',
                            'id'            =>  'type',
                            'required'      =>  'required',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('discount','Discount Amount') !!} <span style="color: red">*</span>
                        <div class="input-group">
                            {!! Form::number('discount',$discount,[
                                'class'         =>  'form-control',
                                'id'            =>  'discount',
                                'required'      =>  'required',
                            ]) !!}
                            <div class="input-group-addon">%</div>
                        </div>
                    </div>
                @endslot
                @endform_open
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
            $('#customer_type_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: url+'settings/discount_type/datatable',
                columns: [
                    {data: 'type'},
                    {data: 'discount'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection
