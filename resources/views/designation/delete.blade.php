@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Delete Designation :: {{ $designation->designationName}}</strong></div>
    <div class="panel-body">
        {!! Form::open(['route' => ['designations.destroy', $designation->idDesignation], 'method' => 'delete','class'=>'form-horizontal']) !!}
            <div class="form-group">
            {!! Form::label('Name Of Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
                <div class="col-sm-5">
                <p class="form-control-static">{{ $designation->designationName}}</p>
                </div>
            </div>
            <div class="form-group">
            {!! Form::label('Name Of Section', null, ['class' => 'col-sm-2 control-label required']) !!}
                <div class="col-sm-5">
                <p class="form-control-static">{{ $designation->section->sectionName}}</p>
                </div>
            </div>
            
            
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}
        <a href="{{ url('/designations')}}" class="btn btn-danger">Cancel</a>
    </div>

</div>
@stop