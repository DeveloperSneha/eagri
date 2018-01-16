@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Delete Certificates :: {{ $certificate->certificateName}}</strong></div>
    <div class="panel-body">
        {!! Form::open(['route' => ['certificates.destroy', $certificate->idCertificate], 'method' => 'delete','class'=>'form-horizontal']) !!}
            <div class="form-group">
            {!! Form::label('Name Of Certificate', null, ['class' => 'col-sm-2 control-label required']) !!}
                <div class="col-sm-6">
                <p class="form-control-static">{{ $certificate->certificateName}}</p>
                </div>
            </div>
            
            
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        {!! Form::close() !!}
        <a href="{{ url('/certificates')}}" class="btn btn-danger">Cancel</a>
    </div>

</div>
@stop