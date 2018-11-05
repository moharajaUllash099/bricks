<div class="panel panel-primary">
    <div class="panel-heading">
        @if(isset($title))
            {{--{{strtoupper($title)}}--}}
            {{$title}}
        @endif
    </div>
    <div class="panel-body">
        {{$body or ''}}
    </div>
    @if(isset($footer))
        <div class="panel-footer">{{$footer}}</div>
    @endif
</div>