@extends('authority.authority_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Add User</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => '','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::select('idBlock',[''=>''], null, ['class' => 'form-control select2']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                <select name="idDesignation" class="form-control select2" >
                    <option value="">--- Select Designation ---</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Username', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::text('userName', null, ['class' => 'form-control']) !!}
            </div>
        </div>
<!--        <div class="form-group">
            {!! Form::label('Password', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::text('userName', null, ['class' => 'form-control']) !!}
            </div>
        </div>-->
    </div>
    <div class="panel-footer">
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
		<button type="submit" class="btn btn-danger">Save</button>
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Users</strong></div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop
