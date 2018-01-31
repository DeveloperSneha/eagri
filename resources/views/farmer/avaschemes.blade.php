@extends('farmer.farmer_layout')
@section('content')
<style>
    .blink{
        color:red;
        font-size:15px;
        animation:blink_animation .5s infinite;
        text-decoration:blink;
    }
    @keyframes blink_animation {
        50%   {color:red;}      
        100% {color:blue}
    }
</style>
 <div class="panel panel-default">
            <div class="panel-heading">Available Schemes</div>
            <div class="panel-body">
                @if($districts->count() >0 )
                    @foreach ($districts as $value)
                        @if($farmer->schemes->contains('idScheme', $value->idScheme))
                        <strong> {{  $value->schemeName  }} <span class=""> : Applied</span><br></strong>
                        @else
                        <a href="{{url('/farmer/program/'.$value->idProgram.'/apply')}}">
                            <blink class="blink"> {{  $value->programName  }} : {{  $value->schemeName  }}&nbsp;&nbsp;<img src="{{ asset('dist/img/new_blink.gif') }}"><br></blink>
                        </a>
                        @endif
                    @endforeach
                @else
                <span>No Scheme Is Available For You </span>
                @endif
            </div>
        </div>
       
@stop