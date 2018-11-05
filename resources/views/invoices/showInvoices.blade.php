@extends('layouts.app')
@section('css')
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
    <?php
    $dir = public_path('invoices');
    $sample_invoices = scandir($dir);
    ?>
    <div class="row">
        @foreach($sample_invoices as $key => $value)
            @if(!in_array($value, ['.','..']))
                @if(array_key_exists($value,$available_template))
                <div class="col-xs-12 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ ucwords(str_replace('_',' ',$value)) }}
                        </div>
                        <div class="panel-body">
                            <?php
                                $preview_img = public_path('invoices/'.$value.'/screenshot.png')
                            ?>
                            @if(file_exists($preview_img))
                                <img class="img-responsive img-rounded" src="{{asset('invoices/'.$value.'/screenshot.png')}}" alt="{{$value}} screenshot">
                            @endif
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="javascript:void(0)" mytitle="{{ucwords(str_replace('_',' ',$value)) }}" im="{{asset('invoices/'.$value.'/screenshot.png')}}" class="btn btn-default show-priview">
                                        Show Preview
                                    </a>
                                </div>
                                <div class="col-xs-6">
                                    <?php $active_invoice = get_basic_setting('active_invoice')?>
                                    @if($active_invoice != $value)
                                        @if(isset($available_template[$value]))
                                            @if(isset($available_template[$value]['type']) && $available_template[$value]['type'] == 'free')
                                                <a href="{{route('setInvoice',$value)}}" class="btn btn-primary">
                                                    Active Invoice
                                                </a>
                                            @else
                                                <a href="{{route('buyInvoice',$value)}}" class="btn btn-warning pull-right">
                                                    Buy ({{ (isset($available_template[$value]['price']) && !empty($available_template[$value]['price'])) ? $available_template[$value]['price'] : 'Please call' }})
                                                </a>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-xs-12 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Template Settings not found
                        </div>
                        <div class="panel-body">
                            update Template settings <br>
                            if you see this please call us (01533 105564)
                        </div>
                    </div>
                </div>
                @endif
            @endif
        @endforeach
    </div>


    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header" style="padding: 10px 15px;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="modal_title"></h4>
                </div>
                <div class="modal-body" id="modalBody"></div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $('document').ready(function () {
            $('.show-priview').on('click',function () {
                var mytitle = $(this).attr('mytitle');
                var im = $(this).attr('im');
                var modalBody = '<img class="img-responsive img-rounded" src="'+im+'" alt="'+mytitle+' screenshot">';
                $('#modal_title').text(mytitle);
                $('#modalBody').html(modalBody);
                $('#myModal').modal('toggle');
            });
        });
    </script>
@endsection