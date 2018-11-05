<?php
?>
@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="row">
        @foreach($branches as $branch)
        <div class="col-xs-6 col-md-3">
            <a href="{{url('sales/invoices?branch='.$branch->id)}}">
                <div class="widget navy-bg p-lg text-center">
                    <div class="m-b-md">
                        <i class="fa fa-home fa-5x" aria-hidden="true"></i>
                        <h2 class="font-bold">
                            {{ucwords($branch->name)}}
                        </h2>
                        {!! $branch->address !!}
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection

@section('js')
@endsection
