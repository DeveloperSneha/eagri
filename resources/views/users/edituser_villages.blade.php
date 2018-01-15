@extends('layouts.app')
@section('content')
<div class="panel panel-default tab-pane fade in active" id='new'>
    <div class="panel-heading"><strong>{{ $userdesig->user->userName }}</strong></div>
    <div class="panel-body">
        {!! Form::model( $userdesig, ['route' => ['uservillage.update', $userdesig->iddesgignationdistrictmapping], 'method' => 'patch','class'=>'form-horizontal'] ) !!}
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idDistrict',$districts,isset($userdesig) ? $userdesig->idDistrict : null, ['class' => 'form-control select2','id'=>'idDistrict','disabled', 'selected']) !!}
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
                <select name = "idSubdivision"  id="idSubdivision" class="form-control" disabled="disabled">
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
            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idBlock"  id="idBlock" class="form-control select2" disabled="disabled">
                    <option value="{{ $userdesig->idBlock }}" selected="selected" ></option>
                </select>
               
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
                <select name = "idVillage"  id="idVillage" class="form-control select2">
                    <option value="{{ $userdesig->idVillage }}" selected="selected" >{{ $userdesig->village->villageName}}</option>
                 </select>
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
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
@include('view_script.user_village')
@stop