@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Delete Program :: {{ $programs->programName}}</strong></div>
    <div class="panel-body">
        {!! Form::open(['route' => ['programs.destroy', $programs->idProgram], 'method' => 'delete','class'=>'form-horizontal']) !!}
            <div class="form-group">
            {!! Form::label('Name Of Program', null, ['class' => 'col-sm-2 control-label required']) !!}
                <div class="col-sm-5">
                <p class="form-control-static">{{ $programs->programName}}</p>
                </div>
            </div>
            <div class="form-group">
            {!! Form::label('Name Of Scheme', null, ['class' => 'col-sm-2 control-label required']) !!}
                <div class="col-sm-5">
                <p class="form-control-static">{{ $programs->scheme->schemeName}}</p>
                </div>
            </div>
            
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}
        <a href="{{ url('/programs')}}" class="btn btn-danger">Cancel</a>
    </div>

</div>
@stop