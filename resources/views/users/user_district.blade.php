@extends('layouts.app')
@section('content')
<a href="{{url('/userdistrict/create')}}" class="btn btn-success" style="margin-bottom: 20px;">Add Existing</a>
<!-------------------New User---------------------------------------------------------------------->
<div class="panel panel-default">
    <div class="panel-heading"><strong>ADD User In District</strong></div>
    {!! Form::open(['url' => 'userdistrict','class'=>'form-horizontal']) !!}
    <div class="panel-body">
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                 {!! Form::select('idDistricts[]',$districts, isset($user) ? $user_district: null, ['class' => 'form-control select2','multiple'=>'multiple','id'=>'idDistrict']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idDistrict'))
                    <p>{{ $errors->first('idDistrict') }}</p>
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
                    <th>S.No.</th>
                    <th>User</th>
<!--                    <th>District</th>
                    <th>Section</th>
                    <th>Designation</th>-->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                @foreach($user_list as $user)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $user->userName}}</td>
<!--                    <td>{{ $user->districtName}}</td>
                    <td>{{ $user->sectionName}}</td>
                    <td>{{ $user->designationName}}</td>-->
                    <td>
                      
                        <a href='{{url('/userdistrict/'.$user->idUser.'/edituser')}}' class="btn btn-xs btn-warning">Edit</a>
                        {{--  {{ Form::open(['route' => ['userdistrict.destroy', $user->idUser], 'method' => 'delete']) }} --}}
                        <!--<button class="btn btn-xs btn-danger" type="submit">Delete</button>-->
                     {{--   {{ Form::close() }} --}}
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
@section('script')
@include('view_script.user_district')
@stop