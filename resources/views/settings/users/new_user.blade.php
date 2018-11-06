@extends('layouts.app')
@section('css')
<link href="{{asset('soft/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-6 col-lg-offset-3 col-md-offset-3">
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
        <crenter></crenter>
        <div class="col-xs-6 col-lg-offset-3 col-md-offset-3">
            @panelPrimary(['title'=> 'নতুন ব্যবহারকারী ফর্ম'])
                @slot('body')
                    <div class="form-group">
                        {!! Form::label('delivery_man','কর্মচারী অনুসন্ধান করুন (নাম অথবা ফোন নম্বর দিয়ে)',['style'=>'display:block']) !!}
                        {!! Form::select('delivery_man',[],null,[
                            'class'             =>  'form-control',
                            'id'                =>  'employee_select',
                            'style'             =>  'display: none;'
                        ]) !!}
                    </div>
                    @form_open(['route'=>'storeUserInfo'])
                        @slot('form_body')
                            <div class="form-group">
                                {!! Form::label('name', 'নাম') !!}
                                {!! Form::text('name',null,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'name',
                                    'placeholder'   =>  'Full Name',
                                    'required'      =>  'required',
                                    'readonly'      =>  'readonly',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('শাখা নির্বাচন') !!}
                                <?php
                                    $all_branch[''] = 'শাখা নির্বাচন করুন';

                                    if(Auth::user()->role == 1 or Auth::user()->role ==2){
                                        $all_branch['0']    = 'প্রধান শাখা';
                                    }

                                    foreach ($branches as $br){
                                        if(Auth::user()->role != 1 and Auth::user()->role != 2){
                                            if(Auth::user()->branch == $br->id){
                                                $all_branch[$br->id]  =  $br->name;
                                            }
                                        }else{
                                            $all_branch[$br->id]  =  $br->name;
                                        }
                                    }
                                ?>
                                {!! Form::select('branch',$all_branch,null,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'branch',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('role','ব্যবহারকারী হিসাবে নির্বাচন করুন') !!}
                                @php
                                    $userRoles = array(
                                        ''  =>  'Select user role'
                                    );
                                @endphp
                                @foreach($roles as $role)
                                    @if($role->id != 1)
                                        @if(Auth::user()->role == 3)
                                            @if($role->id != 1 and $role->id != 2)
                                                <?php $userRoles[$role->id] = ucwords($role->role_type); ?>
                                            @endif
                                        @else
                                            <?php $userRoles[$role->id] = ucwords($role->role_type); ?>
                                        @endif
                                    @endif
                                @endforeach
                                {!! Form::select('role',$userRoles,null,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'role',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email','ইমেইল') !!}
                                {!! Form::email('email',null,[
                                    'class'         =>  'form-control',
                                    'id'            =>  'email',
                                    'placeholder'   =>  'Enter email...',
                                    'required'      =>  'required',
                                ]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password','পাসওয়ার্ড') !!}
                                {!! Form::password('password',[
                                    'class'         =>  'form-control',
                                    'id'            =>  'password',
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
    <script src="{{asset('soft/js/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            var csrf = $('meta[name="csrf-token"]').attr('content');
            //employee search
            $("#employee_select").select2({
                placeholder: "search employee name",
                allowClear: true,
                ajax : {
                    url : '{{route('employee.name.search')}}',
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
                width : '100%',
                templateResult : function (repo){
                    var img =  '';
                    return repo.name;
                },
                templateSelection : function(repo){
                    var showtext = repo.text;
                    if(repo.name != undefined) {
                        showtext = repo.name;
                        $('#name').val(repo.name);
                    }
                    return showtext;
                },
                escapeMarkup : function(markup){ return markup; },
            });
        });
    </script>
@endsection