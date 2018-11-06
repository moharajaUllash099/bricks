<?php
$name = (isset($this_record[0])) ? $this_record[0]->name : old('name');

$id = (isset($this_record[0])) ? $this_record[0]->id : '';
?>
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
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    @panelPrimary(['title'=>'ক্রয় ক্যাটাগরি টেবিল'])
                    @slot('body')
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered" id="cat-table">
                                    <thead>
                                    <tr>
                                        <th>ক্যাটাগরির নাম</th>
                                        <th>তৈরী/হালনাগাদ</th>
                                        <th>অবস্থা</th>
                                        <th style="text-align: right">অ্যাকশন</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    @endslot
                    @endpanelPrimary
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="alert alert-warning">
                        <i class="fa fa-info-circle" aria-hidden="true"></i> তারকা (*) চিহ্নিত ফিল্ড অবশ্যই পূরণ করতে হবে
                    </div>
                    @panelPrimary(['title'=>(empty($id)) ? 'ক্রয় ক্যাটাগরি  তথ্য ফর্ম' : 'ক্রয় ক্যাটাগরি হালনাগাদ তথ্য ফর্ম' ])
                    @slot('body')
                        @if(!empty($id))
                            @form_open(['route'=> ['buysettings.category.update',$id]])
                        @else
                            @form_open(['route'=>'buysettings.category.save'])
                        @endif
                        @slot('form_body')
                            <div class="form-group">
                                {!! Form::label('name', 'ক্রয় ক্যাটাগরির নাম') !!} <span style="color: red">*</span>
                                {!! Form::text('name',$name,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'name',
                                    'placeholder'   =>  'Category Name',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>
                        @endslot
                        @endform_open
                    @endslot
                    @endpanelPrimary
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('soft/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('soft/js/datatables.bootstrap.js') }}"></script>
    <script>
        $(function() {
            $('#cat-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('buysettings.category.datatable')}}',
                columns: [
                    //{data: 'parent'},
                    {data: 'name'},
                    {data: 'created_at'},
                    {data: 'is_deleted'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection