@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($fy))
    <div class="panel-heading">Edit Financial Year : <strong>{{$fy->financialYearName }}</strong></div>
    @else
    <div class="panel-heading"><strong>Add Financial Year</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($fy))
        {!! Form::model( $fy, ['route' => ['fys.update', $fy->idFinancialYear], 'method' => 'put','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'fys','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Financial Year', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::text('financialYearName', null, ['class' => 'form-control','maxlength'=>'4']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('financialYearName'))
                        <p>{{ $errors->first('financialYearName') }}</p>
                        @endif
                    </strong>
                </span> 
        </div>
        <div class="form-group">
            {!! Form::label('Start Date', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::text('finanYearStartDate', null, ['class' => 'form-control datepicker']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('finanYearStartDate'))
                        <p>{{ $errors->first('finanYearStartDate') }}</p>
                        @endif
                    </strong>
                </span> 
        </div>
        <div class="form-group">
            {!! Form::label('End Date', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::text('finanYearEndDate', null, ['class' => 'form-control datepicker']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('finanYearEndDate'))
                        <p>{{ $errors->first('finanYearEndDate') }}</p>
                        @endif
                    </strong>
                </span> 
        </div>
        
    </div>

<div class="panel-footer">
    @if(isset($fy))
    {!!  Form::submit('Update',['class'=>'btn btn-warning'])!!}
    @else
    <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
    <button type="submit" class="btn btn-danger">Save</button>
    @endif
    {!! Form::close() !!}
</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"> <strong>Financial Year</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fys as $var)
                <tr>
                    <td>{{ $var->idFinancialYear }}</td>
                    <td>{{ $var->financialYearName }}</td>
                    <td>{{ $var->finanYearStartDate }}</td>
                    <td>{{ $var->finanYearEndDate }}</td>
                    <td>
                        {{ Form::open(['route' => ['fys.destroy', $var->idFinancialYear], 'method' => 'delete']) }}
                        <a href='{{url('/fys/'.$var->idFinancialYear.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
                        <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop