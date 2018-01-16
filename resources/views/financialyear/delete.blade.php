@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Delete Financial Year :: {{ $fys->financialYearName}}</strong></div>
    <div class="panel-body">
        {!! Form::open(['route' => ['fys.destroy', $fys->idFinancialYear], 'method' => 'delete','class'=>'form-horizontal']) !!}
            <div class="form-group">
            {!! Form::label('Financial Year Name', null, ['class' => 'col-sm-2 control-label required']) !!}
                <div class="col-sm-6">
                <p class="form-control-static">{{ $fys->financialYearName}}</p>
                </div>
            </div>
            <div class="form-group">
            {!! Form::label('Start Date', null, ['class' => 'col-sm-2 control-label required']) !!}
                <div class="col-sm-6">
                <p class="form-control-static">{{ $fys->finanYearStartDate}}</p>
                </div>
            </div>
            <div class="form-group">
            {!! Form::label('End Date', null, ['class' => 'col-sm-2 control-label required']) !!}
                <div class="col-sm-6">
                <p class="form-control-static">{{ $fys->finanYearEndDate}}</p>
                </div>
            </div>
            
            
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}
        <a href="{{ url('/fys')}}" class="btn btn-danger">Cancel</a>
    </div>

</div>
@stop