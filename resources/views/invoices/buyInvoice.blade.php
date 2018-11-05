@extends('layouts.app')
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ucwords(str_replace('_',',',$template))}}
                </div>
                <div class="panel-body">
                    <img class="img-responsive img-rounded" src="{{asset('invoices/'.$template.'/screenshot.png')}}" alt="basic_international screenshot">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    Template name : <strong>{{ucwords(str_replace('_',' ',$template))}}</strong>
                    <br>
                    Price : <strong>
                    @if(isset($template_info[$template]))
                        @if(isset($template_info[$template]['price']) or !empty($template_info[$template]['price']))
                            {{ $template_info[$template]['price'] }}
                        @else
                            call for price
                        @endif
                    @endif
                    </strong>
                    <h3>For Active call : 01533 105564</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection