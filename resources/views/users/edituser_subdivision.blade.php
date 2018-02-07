@extends('layouts.app')
@section('content')
<div id="formerrors"></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>{{ $userdesig->user->userName }}</strong></div>
    <div class="panel-body">
        {!! Form::model( $userdesig, ['route' => ['usersubdivision.update', $userdesig->iddesgignationdistrictmapping], 'method' => 'patch','class'=>'form-horizontal','id'=>'editusersubdivision'] ) !!}
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idDistrict',$districts,isset($userdesig) ? $userdesig->idDistrict : null, ['class' => 'form-control select2','id'=>'idDistrict','disabled', 'selected','data-width'=>'100%']) !!}
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
                <select name = "idSubdivision"  id="idSubdivision" class="form-control" >
                    <option value="{{ $userdesig->idSubdivision }}" selected="selected" ></option>
                </select>
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
                {!! Form::select('idSection',$sections, isset($userdesig) ? $userdesig->designation->section->idSection : null, ['class' => 'form-control','id'=>'section']) !!}
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

        
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger">Update</button>
        <a href="{{ url('/usersubdivision')}}" class="btn btn-danger">Cancel</a>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
@include('view_script.user_subdivision')
@stop