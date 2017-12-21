@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($comprate))
    <div class="panel-heading">Edit Component Rate :<strong>{{$comprate->idCompRate }}</strong></div>
    @else
    <div class="panel-heading"><strong>Create Component Rate</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($comprate))
        {!! Form::model( $comprate, ['route' => ['comprates.update', $comprate->idCompRate], 'method' => 'put','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'comprates','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Component Size', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('idCompSize',$compsizes, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('idSchemeActivation',$schemeactivations, null, ['class' => 'form-control select2']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Rate Per unit', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('ratePerUnit', null, ['class' => 'form-control','placeholder'=>'Rate Per Unit']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-8">
                @if(isset($comprate))
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
    <div class="panel-heading"> <strong>Comprate</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Component Size</th>
                    <th>Scheme</th>
                    <th>Rate per unit</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comprates as $var)
                <tr>
                    <td>{{ $var->idCompRate }}</td>
                    <td>{{ $var->componentsize->size }}</td>
                    <td>{{ $var->schactivation->scheme->schemeName }}</td>
                    <td>{{ $var->ratePerUnit }}</td>
                    <td>
                        {{ Form::open(['route' => ['comprates.destroy', $var->idCompRate], 'method' => 'delete']) }}
                        <a href='{{url('/comprates/'.$var->idCompRate.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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