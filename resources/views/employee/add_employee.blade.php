<?php
#default
$countries = [
    ''  =>  'Select Country'
];
foreach ($all_countries as $ac){
    $countries[$ac->id] = $ac->name;
}
$default_dob = (!empty(old('dob'))) ? old('dob') : date('m/d/Y',strtotime('-18 year'));
$default_joining_date = (!empty(old('joining_date'))) ? old('joining_date') : date('m/d/Y');
$default_country = (!empty(old('country'))) ? old('country') : 16;

$all_branch = [
    ''      =>      'শাখা নির্বাচন করুন',
    '0'     =>      'প্রাধান শাখা',
];
foreach ($branches as $b){
    $all_branch[$b->id] =  $b->name;
}
#use when we use edit
$dob = (isset($this_record[0])) ? date('m/d/Y',strtotime($this_record[0]->dob)) : $default_dob;
$joining_date = (isset($this_record[0])) ? date('m/d/Y',strtotime($this_record[0]->joining_date)) : $default_joining_date;
$img = (isset($this_record[0])) ? $this_record[0]->img : '';
$name = (isset($this_record[0])) ? $this_record[0]->name : old('name');

$branch = (isset($this_record[0])) ? $this_record[0]->branch : old('branch');

$designation = (isset($this_record[0])) ? $this_record[0]->designation : old('designation');
$designation_value = (!empty($designation)) ? [$designation => get_designation($designation)] : [];

$personal_mobile = (isset($this_record[0])) ? $this_record[0]->personal_mobile : old('personal_mobile');
$alt_mobile = (isset($this_record[0])) ? $this_record[0]->alt_mobile : old('alt_mobile');
$nid = (isset($this_record[0])) ? $this_record[0]->nid : old('nid');
$email = (isset($this_record[0])) ? $this_record[0]->email : old('email');
$country = (isset($this_record[0])) ? $this_record[0]->country : $default_country;
$city = (isset($this_record[0])) ? $this_record[0]->city : old('city');
$area = (isset($this_record[0])) ? $this_record[0]->area : old('area');
$post_code = (isset($this_record[0])) ? $this_record[0]->post_code : old('post_code');
$house_address = (isset($this_record[0])) ? $this_record[0]->house_address : old('house_address');
$comment = (isset($this_record[0])) ? $this_record[0]->comment : old('comment');



$id = (isset($this_record[0])) ? $this_record[0]->id : '';
?>
@extends('layouts.app')
@section('css')
    <link href="{{asset('soft/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('soft/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <style>
        textarea{
            resize: none;
        }
        .select2-container--default .select2-selection--single{
            border-radius: 0px;
        }
        #designation_error_info{
            color: red;
        }
        #add_new_designation{
            cursor: pointer;
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
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            @panelPrimary(['title'=>(empty($id)) ? 'নতুন কর্মচারী ফর্ম' : 'কর্মচারীর তথ্য হালনাগাদ ফর্ম' ])
            @slot('body')
                @if(!empty($id))
                    @form_upload(['route'=>['employee.update',$id]])
                @else
                    @form_upload(['route'=>'employee.save'])
                @endif
                @slot('form_body')
                    <div class="row">
                        <div class="col-xs-12 col-md-2 col-md-offset-5">
                            <label class="addImg">
                                ছবি
                                <span id="validimg"></span>
                                <div class="image_preview" id="image_preview1" style="border: 1px dotted;padding: 10px 5px;width: 135px;">
                                    @if(!empty($img))
                                        <img style="max-width: 120px;" src="{{asset('soft/uploads/'.$img)}}" alt="{{$name}}" id="previewing1">
                                    @else
                                        <img id="previewing1"  src="{{asset('soft/uploads/default/addPic.png')}}" alt="user picture" width="120px" style="background-color: lightgray; margin-left: 5px;height: 110px;width: 110px;" class="custom-img-thumbnail" />
                                    @endif
                                </div>
                                {{Form::file('img',[
                                        //'style' =>  "margin-top: -20px;",
                                        'class' =>  'customfile'
                                    ])}}
                            </label>
                        </div>
                    </div>
                    <hr style="margin-left: -15px;margin-right: -15px;border-top: 1px solid #1ab394">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        {!! Form::label('name','কর্মচারীর নাম') !!} <span style="color: red">*</span>
                                        {!! Form::text('name',$name,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'name',
                                            'placeholder'   =>  'MD. Masud',
                                            'required'      =>  'required',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('branch','শাখা') !!} <span style="color: red">*</span>
                                        {!! Form::select('branch',$all_branch, $branch,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'country',
                                            'required'      =>  'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('designation','পদবী') !!} <span style="color: red">*</span>
                                        <div class="input-group" id="to_search">
                                            {!! Form::select('designation',$designation_value,$designation,[
                                                'class'             =>  'form-control',
                                                'id'                =>  'customers_select',
                                                'style'             =>  'display: none;'
                                            ]) !!}
                                            <div class="input-group-addon" style="border: 1px solid #aaa;border-left:none" id="add_new_designation">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group" id="data_1">
                                        {!! Form::label('dob','জন্ম তারিখ') !!} <span style="color: red">*</span>
                                        <div class="input-group date" style="">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            {!! Form::text('dob', $dob,[
                                                'class'         =>  'form-control',
                                                'required'      =>  'required',
                                                'readonly'      =>  'readonly'
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group" id="data_2">
                                        {!! Form::label('joining_date','যোগদান তারিখ') !!} <span style="color: red">*</span>
                                        <div class="input-group date" style="">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            {!! Form::text('joining_date', $joining_date,[
                                                'class'         =>  'form-control',
                                                'required'      =>  'required',
                                                'readonly'      =>  'readonly'
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('personal_mobile','মোবাইল (ব্যক্তিগত)') !!} <span style="color: red">*</span>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone-square" aria-hidden="true"></i>
                                            </div>
                                            {!! Form::tel('personal_mobile',$personal_mobile,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'personal_mobile',
                                                'placeholder'   =>  '+8801xxxxxxxxx',
                                                'required'      =>  'required',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('alt_mobile','মোবাইল (বিকল্প)') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone-square" aria-hidden="true"></i>
                                            </div>
                                            {!! Form::tel('alt_mobile',$alt_mobile,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'alt_mobile',
                                                'placeholder'   =>  '+8801xxxxxxxxx',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('nid','NID/পাসপোর্ট / ড্রাইভিং লাইসেন্স') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-id-card" aria-hidden="true"></i>
                                            </div>
                                            {!! Form::number('nid',$nid,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'nid',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('email','ইমেইল') !!}
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </div>
                                            {!! Form::email('email',$email,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'email',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('country','দেশ') !!} <span style="color: red">*</span>
                                        {!! Form::select('country',$countries, $country,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'country',
                                            'required'      =>  'required',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('city','শহর') !!} <span style="color: red">*</span>
                                        {!! Form::text('city', $city,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'city',
                                            'required'      =>  'required',
                                            'placeholder'   =>  'Dhaka',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('area','এলাকায়') !!} <span style="color: red">*</span>
                                        {!! Form::text('area',$area,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'area',
                                            'required'      =>  'required',
                                            'placeholder'   =>  'Mohammadpur',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('post_code','পোস্ট কোড') !!}
                                        {!! Form::text('post_code',$post_code,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'post_code',
                                            'placeholder'   =>  '1207',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('house_address','বাড়ীর নাম ও ঠিকানা') !!}
                                {!! Form::text('house_address',$house_address,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'house_address',
                                    'placeholder'   =>  '57/1 Jafrabad',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('comment','মন্তব্য') !!}
                                {!! Form::textarea('comment',$comment,[
                                    'class'         =>  'form-control',
                                    'rows'          =>  '5'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                @endslot
                @endform_upload
            @endslot
            @endpanelPrimary
        </div>
    </div>
    {{--register new Designation--}}
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header" style="padding: 10px 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">নতুন পদবীর তথ্য ফর্ম</h4>
                </div>
                <form method="POST" action="{{route('employee.save_designation')}}" accept-charset="UTF-8" id="new_designation">
                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="modal-body">
                        <div id="spinner">
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                            <div class="sk-cube"></div>
                        </div>
                        <div id="modal-body-customer">
                            <div class="row">
                                <div class="col-xs-12">
                                    <span id="designation_error_info"></span>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                {!! Form::label('name','পদবীর নাম') !!} <span style="color: red">*</span>
                                                {!! Form::text('name',null,[
                                                    'class'         =>  'form-control',
                                                    'id'            =>  'name',
                                                    'placeholder'   =>  'Manager',
                                                    'required'      =>  'required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="save_change">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Select2 -->
    <script src="{{asset('soft/js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('soft/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
    <script>
        $(document).ready(function () {
            var csrf = $('meta[name="csrf-token"]').attr('content');
            //picture change work
            $(document).on('change', '.customfile', function(e){
                var addPic = "{{asset('soft/uploads/default/addPic.png')}}";
                $("#validimg").empty(); // To remove the previous error message
                $('img > #previewing1').attr('src',addPic);
                var file = this.files[0];
                if(typeof file == "undefined"){
                    $('#image_preview1 >img').attr('src',addPic);
                }
                else
                {
                    var imagefile = file.type;
                    var match= ["image/jpeg", "image/jpg","image/png"];
                    if(!((imagefile == match[0]) || (imagefile == match[1])|| (imagefile == match[2]) ))
                    {
                        $('#image_preview1 >img').attr('src',addPic);
                        $("#validimg").html('<span style="color:red">Invalid formet<br>Note: Only jpeg and jpg Images type allowed</span>');
                        return false;
                    }
                    else
                    {
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                        imgtype = true;
                    }
                }
            });
            function imageIsLoaded(e) {
                $('#previewing1').attr('src', e.target.result);
                $('#previewing1').attr('width', '150px');
                $('#previewing1').attr('height', '200px');
            };
            //date picker
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
            $('#data_2 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            //add new designation
            $('#add_new_designation').on('click',function () {
                $('#myModal').modal('toggle');
            });
            $('#new_designation').on('submit',function (event) {
                event.preventDefault();
                $("#save_change").trigger("click");
            });


            $('#save_change').on('click',function () {
                $('#spinner').addClass('sk-spinner sk-spinner-cube-grid');;
                $.ajax({
                    url: '{{route('employee.save_designation')}}',
                    type: 'POST',
                    data: $('#new_designation').serialize(),
                    dataType: 'json',
                    success: function( data ) {
                        $('#spinner').removeClass('sk-spinner sk-spinner-cube-grid');
                        if(data.errors){
                            $('#designation_error_info').text(data.errors);
                        }
                        if(data.success){
                            $("#new_designation input[type=text]").each(function(){
                                $(this).val('')
                            });
                            $('#myModal').modal('toggle');
                        }
                    }
                });
            });

            $("#customers_select").select2({
                placeholder: "পদবী",
                allowClear: true,
                ajax : {
                    url : '{{route('employee.search')}}',
                    dataType : 'json',
                    delay : 200,
                    data : function(params){
                        return {
                            q : params.term,
                            page : params.page
                        };
                    },
                    processResults : function(data, params){
                        params.page = params.page || 1;
                        return {
                            results : data.data,
                            pagination: {
                                more : (params.page  * 10) < data.total
                            }
                        };
                    }
                },
                minimumInputLength : 1,
                width : '205px',
                templateResult : function (repo){
                    var img =  '';
                    return repo.name;
                },
                templateSelection : function(repo){
                    var showtext = repo.text;
                    if(repo.name != undefined) {
                        showtext = repo.name;
                    }
                    return showtext;
                },
                escapeMarkup : function(markup){ return markup; },
            });
        });
    </script>
@endsection