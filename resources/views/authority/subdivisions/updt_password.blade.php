@extends('authority.subdivisions.subdivision_layout')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif 
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Update Password</strong>
    </div>
    {!! Form::open(['url' => 'authority/subdivisions/chpwd','class'=>'form-horizontal']) !!}
    <div class="panel-body">
        <div class="form-group">
            {!! Form::label('Old Password :', null, ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('old_password', null, ['class' => 'form-control','required']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('New Password :', null, ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-3">
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Confirm Password :', null, ['class' => 'col-sm-4 control-label']) !!}
            <div class="col-sm-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Update</button>
    </div>
    {!! Form::close() !!}
</div>
@stop