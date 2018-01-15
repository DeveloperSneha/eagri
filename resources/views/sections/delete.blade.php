@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Delete Section :: {{ $section->sectionName}}</strong></div>
    <div class="panel-body">
        {!! Form::open(['route' => ['sections.destroy', $section->idSection], 'method' => 'delete','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('Name Of Sections', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <p class="form-control-static">{{ $section->sectionName}}</p>
            </div>
         </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}
        <a href="{{ url('/sections')}}" class="btn btn-danger">Cancel</a>
    </div>

</div>
@stop