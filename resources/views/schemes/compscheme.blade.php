@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($compscheme))
    <div class="panel-heading">Edit Component of Schemes : <strong>{{ $compscheme->name }}</strong></div>
    @else
    <div class="panel-heading"><strong>Create Component of Schemes</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($compscheme))
        {{ Form::model( $compscheme, ['route' => ['compschemes.update', $compscheme->id], 'method' => 'put','class'=>'form-horizontal'] ) }}
        @else
        {!! Form::open(['url' => 'compschemes','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::select('scheme_id',getMainScheme(), null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('SubScheme', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::select('subscheme_id', getSubScheme(),null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Component Of Scheme name', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::text('name',null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-6">
                @if(isset($compscheme))
                {!!  Form::submit('Update',['class'=>'btn btn-primary'])!!}
                @else
                {!!  Form::submit('Save',['class'=>'btn btn-primary'])!!}
                @endif
            </div>
        </div>
       {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"> <strong>Component of Schemes</strong></div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compschemes as $var)
                <tr>
                    <td>{{ $var->id }}</td>
                    <td>{{ $var->name }}</td>
                    <td><a href='{{url('/compschemes/'.$var->id.'/edit')}}' class="btn btn-xs btn-primary">Edit</a>
                        {{ Form::open(['route' => ['compschemes.destroy', $var->id], 'method' => 'delete']) }}
                        <button class="btn btn-xs btn-primary" type="submit">Delete</button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop