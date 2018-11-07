<?php
$id = (isset($this_record[0])) ? $this_record[0]->id : '';
$category = (isset($this_record[0])) ? $this_record[0]->category : old('category');

$name = (isset($this_record[0])) ? $this_record[0]->name : old('name');
?>
@extends('layouts.app')

@section('css')
    <style>

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
            @panelPrimary(['title'=>'ক্রয় পন্যের তথ্য'])
            @slot('body')
                <div class="row">
                    <div class="col-xs-12">
                        <div id="dataButton"></div>
                        <table class="table table-bordered" id="product-table">
                            <thead>
                            <tr>
                                <th>পন্যের নাম</th>
                                <th>ক্যাটাগরি</th>
                                <th>তৈরী/হালনাগাদ</th>
                                <th>অবস্থা</th>
                                <th class="text-right">অ্যাকশন</th>
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
            @panelPrimary(['title'=> (empty($id)) ? 'ক্রয় পন্যের তথ্য ফর্ম' : 'পন্যের তথ্য হালনাগাদ ফর্ম'])
            @slot('body')
                @if(!empty($id))
                    @form_open(['route'=> ['buysettings.buyProducts.update',$id]])
                @else
                    @form_open(['route'=>'buysettings.buyProducts.save'])
                @endif
                @slot('form_body')
                    <div class="form-group">
                        {!! Form::label('category','ক্যাটাগরি') !!} <span style="color: red">*</span>
                        <?php
                        $categories = [
                            ''  =>  'ক্যাটাগরি নির্বচন করুন'
                        ];
                        foreach ($cats as $cat){
                            $categories[$cat->id]  =  $cat->name;
                        }
                        ?>
                        {!! Form::select('category',$categories,$category,[
                                'class'         =>  'form-control',
                                'id'            =>  'category',
                                'required'      =>  'required',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'ক্রয় পন্যের নাম') !!} <span style="color: red">*</span>
                        {!! Form::text('name',$name,[
                            'class'         =>  'form-control',
                            'id'            =>  'name',
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

    <link rel="stylesheet" href="{{asset('soft/css/plugins/dataTables/buttons.dataTables.min.css')}}">
    <script src="{{asset('vendor/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    <script>
        (function(window,$){
            window.LaravelDataTables=window.LaravelDataTables||{};
            window.LaravelDataTables["dataTableBuilder"]=$("#product-table").DataTable({
                "serverSide":true,
                "processing":true,
                "ajax":{
                    "url" : '{{route('buysettings.buyProducts.buyProductsDataTable')}}',
                    "type": "GET"
                },
                "columns":[
                    {data: 'name',"orderable":true,"searchable":true},
                    {data: 'category',"orderable":false,"searchable":true},
                    {data: 'created_at',"orderable":false,"searchable":false},
                    {data: 'is_deleted',"orderable":false,"searchable":false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                "dom":"Blfrtip",
                "buttons":[
                    /*{
                        extend      :   'pdf',
                        text        :   '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download pdf',
                        className   :   'btn btn-primary',
                        action: function (e, dt, button, config) {
                            window.location = url+'product/download/pdf';
                        }
                    },*/
                    {
                        extend      :   'print',
                        text        :   '<i class="fa fa-print" aria-hidden="true"></i> Print',
                        className   :   'btn btn-primary',
                        action: function (e, dt, button, config) {
                            window.location = '{{route('buysettings.buyProducts.print_buy_product_list')}}';
                        }
                    }
                ]
            });
        })(window,jQuery);
    </script>
@endsection