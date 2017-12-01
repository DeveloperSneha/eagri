@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($scheme))
    <div class="panel-heading">Edit Scheme : <strong>{{$scheme->name }}</strong></div>
    @else
    <div class="panel-heading"><strong>Create Scheme</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($scheme))
        {{ Form::model( $scheme, ['route' => ['schemes.update', $scheme->id], 'method' => 'put','class'=>'form-horizontal'] ) }}
        @else
        {!! Form::open(['url' => 'schemes','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Name', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
            </div>
            <div class="col-sm-2">
                @if(isset($scheme))
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
    <div class="panel-heading"> <strong>Schemes</strong></div>
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
                @foreach($schemes as $var)
                <tr>
                    <td>{{ $var->id }}</td>
                    <td>{{ $var->name }}</td>
                    <td><a href='{{url('/schemes/'.$var->id.'/edit')}}' class="btn btn-xs btn-primary">Edit</a>
                        {{ Form::open(['route' => ['schemes.destroy', $var->id], 'method' => 'delete']) }}
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