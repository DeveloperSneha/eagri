@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Edit Scheme Distribution (District) :: {{ $schdist->district->districtName }}</strong></div>
    <div class="panel-body">
        {!! Form::model( $schdist, ['route' => ['districtdistribution.update', $schdist->idSchemDistributionDistrict], 'method' => 'patch','class'=>'form-horizontal'] ) !!}

        <div class="form-group">
            {!! Form::label('Amount', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('amountDistrict', null, ['class' => 'form-control','placeholder'=>'Enter Amount']) !!}
            </div>
            {!! Form::label('Area', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('areaDistrict', null, ['class' => 'form-control','placeholder'=>'Enter Area']) !!}
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <!--{!!  Form::submit('Update',['class'=>'btn btn-warning'])!!}-->
		<button type="submit" class="btn btn-danger">Update</button>
        {!! Form::close() !!}
    </div>
</div>
@stop