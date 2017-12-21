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
        {!! Form::model( $role, ['route' => ['roles.update', $role->id], 'method' => 'put','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'roles','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Name Of Roles', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
            </div>
           <span class="help-block">
                    <strong>
                        @if($errors->has('name'))
                        <p>{{ $errors->first('name') }}</p>
                        @endif
                    </strong>
                </span>
        </div>
    </div>
    <div class="panel-footer">
        @if(isset($role))
        <!--{!!  Form::submit('Update',['class'=>'btn btn-danger'])!!}-->
	    <button type="submit" class="btn btn-danger">Update</button>
        @else
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
	    <button type="submit" class="btn btn-danger">Save</button>
        @endif
    </div>
    {!! Form::close() !!}
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
                    <td><a href='{{url('/roles/'.$var->id.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
                        {{ Form::open(['route' => ['roles.destroy', $var->id], 'method' => 'delete']) }}
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