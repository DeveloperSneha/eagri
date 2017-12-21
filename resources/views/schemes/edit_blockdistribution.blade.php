@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Edit Scheme Distribution (Block) :: {{ $schblock->block->blockName }}</strong></div>
    <div class="panel-body">
        {!! Form::model( $schblock, ['route' => ['blockdistribution.update', $schblock->idSchemDistributionBlock], 'method' => 'patch','class'=>'form-horizontal'] ) !!}

        <div class="form-group">
            {!! Form::label('Amount', null, ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('amountBlock', null, ['class' => 'form-control','placeholder'=>'Enter Amount']) !!}
            </div>
            {!! Form::label('Area', null, ['class' => 'col-sm-1 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('areaBlock', null, ['class' => 'form-control','placeholder'=>'Enter Area']) !!}
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