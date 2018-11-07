<?php
$old_country = (!empty(old('country'))) ? old('country') : 16;
$old_district = (!empty(old('district'))) ? old('district') : 'ঝিনাইদহ';
$old_area = (!empty(old('area'))) ? old('area') : '';
$old_post_code = (!empty(old('post_code'))) ? old('post_code') : '7320';

$id = (isset($this_record[0])) ? $this_record[0]->id : '';

$company_name = (isset($this_record[0])) ? $this_record[0]->company_name : old('company_name');
$vendors_name = (isset($this_record[0])) ? $this_record[0]->vendors_name : old('vendors_name');

$type = (isset($this_record[0])) ? $this_record[0]->type : old('type');
$discount_type = (isset($this_record[0])) ? $this_record[0]->discount_type : old('discount_type');
$personal_mobile = (isset($this_record[0])) ? $this_record[0]->personal_mobile : old('personal_mobile');
$alt_mobile = (isset($this_record[0])) ? $this_record[0]->alt_mobile : old('alt_mobile');

$email = (isset($this_record[0])) ? $this_record[0]->email : old('email');

$country = (isset($this_record[0])) ? $this_record[0]->country : $old_country;
$district = (isset($this_record[0])) ? $this_record[0]->district : $old_district;
$area = (isset($this_record[0])) ? $this_record[0]->area : $old_area;
$post_code = (isset($this_record[0])) ? $this_record[0]->post_code : $old_post_code;

$address = (isset($this_record[0])) ? $this_record[0]->address : old('address');
$comment = (isset($this_record[0])) ? $this_record[0]->comment : old('comment');


//needs for select

$countries = [
    ''  =>  'Select Country'
];
foreach ($all_countries as $ac){
    $countries[$ac->id] = $ac->name;
}
?>
@extends('layouts.app')

@section('css')
    <style>
        textarea{
            resize: none;
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
            @panelPrimary(['title'=>(empty($id)) ? 'নতুন ব্যাপারীর তথ্য ফর্ম' : 'ব্যাপারীর তথ্য হালনাগাদ ফর্ম' ])
            @slot('body')
                @if(!empty($id))
                    @form_open(['route'=>['vendor.update',$id]])
                @else
                    @form_open(['route'=>'vendor.save'])
                @endif
                @slot('form_body')
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        {!! Form::label('company_name','প্রতিষ্ঠানের নাম') !!}
                                        {!! Form::text('company_name',$company_name,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'company_name',
                                            'placeholder'   =>  'Rowshan Soft'
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        {!! Form::label('vendors_name','ব্যাপারীর নাম') !!} <span style="color: red">*</span>
                                        {!! Form::text('vendors_name',$vendors_name,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'contact_person',
                                            'placeholder'   =>  'MD. Masud',
                                            'required'      =>  'required',
                                        ]) !!}
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
                                            {!! Form::number('personal_mobile',$personal_mobile,[
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
                                            {!! Form::number('alt_mobile',$alt_mobile,[
                                                'class'         =>  'form-control',
                                                'id'            =>  'alt_mobile',
                                                'placeholder'   =>  '+8801xxxxxxxxx',
                                            ]) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
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
                                        {!! Form::label('district','জেলা') !!} <span style="color: red">*</span>
                                        {!! Form::text('district', $district,[
                                            'class'         =>  'form-control',
                                            'id'            =>  'district',
                                            'required'      =>  'required',
                                            'placeholder'   =>  'Dhaka',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        {!! Form::label('area','এলাকা (থানা/পোঃ)') !!} <span style="color: red">*</span>
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
                                {!! Form::label('address','ঠিকানা') !!}<span style="color: red">*</span>
                                {!! Form::text('address',$address,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'address',
                                    'placeholder'   =>  '57/1 Jafrabad',
                                    'required'      =>  'required'
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('comment','মন্তব্য') !!}
                                {!! Form::text('comment',$comment,[
                                    'class'         =>  'form-control',
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
@endsection

@section('js')
    <script>
        $(document).ready(function () {
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
        });
    </script>
@endsection
