@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Delete Scheme :: {{ $schemes->schemeName}}</strong></div>
    <div class="panel-body">
        {!! Form::open(['route' => ['schemes.destroy', $schemes->idScheme], 'method' => 'delete','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('Name Of Scheme', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <p class="form-control-static">{{ $schemes->schemeName}}</p>
            </div>
         </div>
         <div class="form-group">
            {!! Form::label('Name Of Section', null, ['class' => 'col-sm-2 control-label required']) !!}
                <div class="col-sm-5">
                <p class="form-control-static">{{ $schemes->section->sectionName}}</p>
                </div>
            </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}
        <a href="{{ url('/schemes')}}" class="btn btn-danger">Cancel</a>
    </div>

</div>
@stop