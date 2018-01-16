@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Delete Unit :: {{ $unit->unitName}}</strong></div>
    <div class="panel-body">
        {!! Form::open(['route' => ['units.destroy', $unit->idUnit], 'method' => 'delete','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('Unit Name', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <p class="form-control-static">{{ $unit->unitName}}</p>
            </div>
         </div>
         <div class="form-group">
            {!! Form::label('Unit Type', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <p class="form-control-static">{{ $unit->unitType}}</p>
            </div>
         </div>
         <div class="form-group">
            {!! Form::label('Base Unit', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <p class="form-control-static">{{ $unit->idBaseUnit}}</p>
            </div>
         </div>
         <div class="form-group">
            {!! Form::label('Conversion Multipier To Base', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <p class="form-control-static">{{ $unit->conversionMultipierToBase}}</p>
            </div>
         </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}
        <a href="{{ url('/units')}}" class="btn btn-danger">Cancel</a>
    </div>

</div>
@stop