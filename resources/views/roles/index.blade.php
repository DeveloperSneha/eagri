@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($role))
    <div class="panel-heading">Edit Role : <strong>{{$role->name }}</strong></div>
    @else
    <div class="panel-heading"><strong>Create Roles</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($role))
        {{ Form::model( $role, ['route' => ['roles.update', $role->id], 'method' => 'put','class'=>'form-horizontal'] ) }}
        @else
        {!! Form::open(['url' => 'roles','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Name Of roles', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
            </div>
            
        </div>
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-8">
                @if(isset($role))
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
    <div class="panel-heading"> <strong>Roles</strong></div>
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
                @foreach($roles as $var)
                <tr>
                    <td>{{ $var->id }}</td>
                    <td>{{ $var->name }}</td>
                    <td><a href='{{url('/roles/'.$var->id.'/edit')}}' class="btn btn-xs btn-primary">Edit</a>
                        {{ Form::open(['route' => ['roles.destroy', $var->id], 'method' => 'delete']) }}
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