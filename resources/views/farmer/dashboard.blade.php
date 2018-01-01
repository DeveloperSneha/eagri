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
@foreach($sections as $var)
<div class="col-lg-4">
    <!-- small box -->
    <a href="{{url('/farmer/section/'.$var->idSection.'/schemes')}}">
        <div class="small-box bg-gray">
            <div class="inner">
                <h3>{{ $var->sectionName }}</h3>

                <p>Demo Text Here..</p>
            </div>
            <div class="icon">
                <i class="fa fa-cog"></i>
            </div>
            <span class="small-box-footer">Schemes<i class="fa fa-arrow-circle-right"></i></span>
        </div>
    </a>
</div>
@endforeach
<div class="row">
    <div class="col-md-12 marquee_text">
        <div class="panel panel-default">
            <div class="panel-heading"><strong> Availabe Scheme</strong></div>
            <div class="panel-body">
                @if($districts->count() >0 )
                    @foreach ($districts as $value)
                        @if($farmer->schemes->contains('idScheme', $value->idScheme))
                        <strong> {{  $value->schemeName  }} <span class=""> : Applied</span><br></strong>
                        @else
                        <a href="{{url('/farmer/scheme/'.$value->idScheme.'/apply')}}">
                            <blink class="blink"> {{  $value->schemeName  }}<br></blink>
                        </a>
                        @endif
                    @endforeach
                @else
                <span>No Scheme Is Available For You </span>
                @endif
            </div>
        </div>
    </div>
</div>
@stop