@extends('authority.authority_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Add User</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => '/authority/adduser','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::select('idBlock',$sch_blocks, null, ['class' => 'form-control select2']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::select('designations[]',$designations, null, ['class' => 'form-control select2','multiple'=>'multiple']) !!}
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
                    <th>S.No.</th>
                    <th>UserName</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                 <?php $i = 1; ?>
                @foreach($users as $var)
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{$var->userName }}</td>
                    <td>@foreach($var->userdesig as $desig)
                        {{$desig->designation->designationName or ''}} ,<br>
                        @endforeach
                    </td>
                    <td>
                        {{ Form::open(['route' => ['adduser.destroy', $var->idUser], 'method' => 'delete']) }}
                        <a href='{{url('/authority/adduser/'.$var->idUser.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
                        <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                        {{ Form::close() }}
                    </td>
                </tr>
                <?php $i++; ?>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
