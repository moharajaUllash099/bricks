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
        <div class="col-xs-12 col-md-8">
            @panelPrimary(['title'=>'পদবীর তালিকা '])
            @slot('body')
                <table class="table table-bordered" id="deginations_table">
                    <thead>
                    <tr>
                        <th>পদবী</th>
                        <th>তৈরী/হালনাগাদ</th>
                        <th style="text-align: right">অ্যাকশন</th>
                    </tr>
                    </thead>
                </table>
            @endslot
            @endpanelPrimary
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="alert alert-warning">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                তারকা (*) চিহ্নিত ফিল্ড গুলো অবশ্যই পূরণ করতে হবে
            </div>
            @panelPrimary(['title'=> (empty($id)) ? 'নতুন পদবীর তথ্য ফর্ম' : 'পদবীর তথ্য হালনাগাদ ফর্ম'])
            @slot('body')
                @if(!empty($id))
                @form_open(['route'=>['employee.updateDesignations',$id]])
                @else
                @form_open(['route'=>'employee.saveDesignations'])
                @endif
                @slot('form_body')
                    <div class="form-group">
                        {!! Form::label('name','পদবীর নাম') !!} <span style="color: red">*</span>
                        {!! Form::text('name',$name,[
                            'class'         =>  'form-control',
                            'id'            =>  'name',
                            'placeholder'   =>  'Manager',
                            'required'      =>  'required',
                        ]) !!}
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
            var branch = "{{isset($_GET['branch']) ? $_GET['branch'] : Auth::user()->branch}}"
            $('#deginations_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('employee.datatable')}}",
                columns: [
                    {data: 'name'},
                    {data: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection