@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Delete Workflow :: {{ $workflow->workflowName}}</strong></div>
    <div class="panel-body">
        {!! Form::open(['route' => ['workflow.destroy', $workflow->idWorkflow], 'method' => 'delete','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('Name Of Workflow', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <p class="form-control-static">{{ $workflow->workflowName}}</p>
            </div>
         </div>
         <div class="form-group">
            {!! Form::label('Name Of Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                @foreach($workflow->steps as $value)
                <span class="form-control-static">{{$value->designation->designationName}}<br></span>
                @endforeach
            </div>
         </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}
        <a href="{{ url('/workflow')}}" class="btn btn-danger">Cancel</a>
    </div>

</div>
@stop