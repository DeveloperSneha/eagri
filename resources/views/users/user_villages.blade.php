@extends('layouts.app')
@section('content')
<a href="{{url('/uservillage/create')}}" class="btn btn-success" style="margin-bottom: 20px;">Add Existing</a>
<!-------------------New User---------------------------------------------------------------------->
<div class="panel panel-default">
    <div class="panel-heading"><strong>@if(isset($user)) UPDATE @else ADD @endif  User In Village</strong></div>
    @if(isset($user))
    {{ Form::model( $user, ['route' => ['uservillage.update', $user->idUser], 'method' => 'patch','class'=>'form-horizontal'] ) }}
    @else
    {!! Form::open(['url' => 'uservillage','class'=>'form-horizontal']) !!}
    @endif 
    <div class="panel-body">
        {!! Form::open(['url' => 'uservillage','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                @if(isset($user))
                {!! Form::select('idDistrict',$districts, isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control select2','id'=>'idDistrict','disabled']) !!}
                @else
                {!! Form::select('idDistrict',$districts, isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control select2','id'=>'idDistrict']) !!}
                @endif
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
            {!! Form::label('SubDivision', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                @if(isset($user))
                <select name = "idSubdivision"  id="idSubdivision" class="form-control select2" disabled="disabled">
                    @foreach($user_subdiv as $key=>$value)
                    <option value="{{ $value }}" selected="selected" >{{ $key }}</option>
                    @endforeach
                </select>
                @else
                <select name = "idSubdivision"  id="idSubdivision" class="form-control">
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
            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                @if(isset($user))
                <select name = "idBlock"  id="idBlock" class="form-control" disabled="disabled">
                    @foreach($user_village as $val)
                    <option value="{{ $val->block->idBlock }}" selected="selected" >{{ $val->block->idBlock }}</option>
                    @endforeach
                </select>
                @else
                <select name = "idBlock"  id="idBlock" class="form-control select2">
                </select>
                @endif                
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idBlock'))
                    <p>{{ $errors->first('idBlock') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="form-group">
            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                @if(isset($user))
                <select name = "idVillages[]"  id="idVillage" class="form-control select2" multiple="multiple">
                    @foreach($user_village as $val)
                    <option value="{{ $val->village->villageName }}" selected="selected" >{{ $val->village->villageName }}</option>
                    @endforeach
                </select>
                @else
                <select name = "idVillages[]"  id="idVillage" class="form-control select2" multiple="multiple" >
                </select>
                @endif
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idVillage'))
                    <p>{{ $errors->first('idVillage') }}</p>
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
        <button type="submit" class="btn btn-danger">Save</button>
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
                    <th>Subdivision</th>
                    <th>Block</th>
                    <th>Village</th>
                    <th>Section</th>
                    <th>Designation</th>-->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                @foreach($user_list as $var)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $var->userName}}</td>
<!--                    <td>{{ $var->districtName}}</td>
                    <td>{{ $var->subDivisionName}}</td>
                    <td>{{ $var->blockName}}</td>
                    <td>{{ $var->villageName}}</td>
                    <td>{{ $var->sectionName}}</td>
                    <td>{{ $var->designationName}}</td>-->
                    <td> <a href="{{url('/uservillage/'.$var->idUser.'/edituser')}}" class="btn btn-xs btn-warning">Edit</a>
                       
                        {{-- {{ Form::open(['route' => ['uservillage.destroy', $user->idUser], 'method' => 'delete']) }} --}}
                        <!--<button class="btn btn-xs btn-danger" type="submit">Delete</button>-->
                        {{-- {{ Form::close() }} --}}
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
@include('view_script.user_village')
@stop