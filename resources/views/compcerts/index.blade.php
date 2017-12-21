@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        @if(isset($compcert))
        <strong>Edit Component Certificate</strong>
        @else
        <strong>Add Component Certificate</strong>
        @endif
    </div>
    <div class="panel-body">
        @if(isset($compcert))
        {!! Form::model( $compcert, ['route' => ['compcerts.update', $compcert->idCompCerts], 'method' => 'patch','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'compcerts','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Component', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('idComponent', $components, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Certificate', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('idCertificate',$certificates, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-8">
                @if(isset($compcert))
                {!!  Form::submit('Update',['class'=>'btn btn-warning'])!!}
                @else
               <!-- {!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
		       <button type="submit" class="btn btn-danger">Save</button>
                @endif
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong> Component Certificate</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Component</th>
                    <th>Certificate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compcerts as $var)
                <tr>
                    <td>{{ $var->idCompCerts }}</td>
                    <td>{{ $var->component->componentName }}</td>
                    <td>{{ $var->certificate->certificateName }}</td>
                    <td>
                        {{ Form::open(['route' => ['compcerts.destroy', $var->idCompCerts], 'method' => 'delete','class'=>'form-inline']) }}
                        <a href='{{url('/compcerts/'.$var->idCompCerts.'/edit')}}' class="btn btn-xs  btn-warning">Edit</a>
                        <button class="btn btn-xs  btn-danger" type="submit">Delete</button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop