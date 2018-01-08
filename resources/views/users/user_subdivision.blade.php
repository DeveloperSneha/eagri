@extends('layouts.app')
@section('content')
<a href="{{url('/usersubdivision/create')}}" class="btn btn-success" style="margin-bottom: 20px;">Add Existing</a>

<!-------------------New User---------------------------------------------------------------------->
<div class="panel panel-default">
    <div class="panel-heading"><strong>@if(isset($user)) UPDATE @else ADD @endif  User In Sub Division</strong></div>
    <div class="panel-body">
        @if(isset($user))
        {!! Form::model( $user, ['route' => ['usersubdivision.update', $user->idUser], 'method' => 'patch','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'usersubdivision','class'=>'form-horizontal']) !!}
        @endif
        @if(isset($user))
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idDistrict',$districts,isset($user) ? $user_dist : null, ['class' => 'form-control select2','id'=>'idDistrict','disabled', 'selected']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idDistrict'))
                    <p>{{ $errors->first('idDistrict') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        @else
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idDistrict',$districts,isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control select2','id'=>'idDistrict']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idDistrict'))
                    <p>{{ $errors->first('idDistrict') }}</p>
                    @endif
                </strong>
            </span>

        </div>
        @endif
        <div class="form-group">
            {!! Form::label('SubDivision', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                @if(isset($user))
                <select name = "idSubdivisions[]"  id="idSubdivision" class="form-control select2" multiple="multiple" >
                    @foreach($user_subdivision as $val)
                    <option value="{{ $val->subdivision->idSubdivision }}" selected="selected" >{{ $val->subdivision->subDivisionName }}</option>
                    @endforeach
                </select>
                @else
                <select name = "idSubdivisions[]"  id="idSubdivision" class="form-control select2" multiple="multiple" >
                </select>
                @endif
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idSubdivision'))
                    <p>{{ $errors->first('idSubdivision') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idSection',$sections, isset($user) ? $user_section : null, ['class' => 'form-control','id'=>'section']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idSection'))
                    <p>{{ $errors->first('idSection') }}</p>
                    @endif
                </strong>
            </span>
        </div>

        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idDesignation"  id="idDesignation" class="form-control">
                </select>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idDesignation'))
                    <p>{{ $errors->first('idDesignation') }}</p>
                    @endif
                </strong>
            </span>
        </div>

        <div class="form-group">
            {!! Form::label('Username', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::text('userName', null, ['class' => 'form-control','maxlength'=>'50']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('userName'))
                    <p>{{ $errors->first('userName') }}</p>
                    @endif
                </strong>
            </span>
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">@if(isset($user)) Update @else Save @endif</button>
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Users</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>User</th>
                    <th>District</th>
                    <th>Subdivision</th>
                    <th>Section</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user_list as $user)
                <tr>
                    <td>{{ $user->userName}}</td>
                    <td>{{ $user->districtName}}</td>
                    <td>{{ $user->subDivisionName}}</td>
                    <td>{{ $user->sectionName}}</td>
                    <td>{{ $user->designationName}}</td>
                    <td>
                        {{ Form::open(['route' => ['usersubdivision.destroy', $user->idUser], 'method' => 'delete']) }}
                        <a href='{{url('/usersubdivision/'.$user->idUser.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
@section('script')
@include('view_script.user_subdivision')
@stop