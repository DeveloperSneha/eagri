@extends('layouts.app')
@section('content')
<!-------------------Existing User---------------------------------------------------------------------->
<div id="formerrors"></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Add Existing User</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'userdistrict','class'=>'form-horizontal','id'=>'userdistrict']) !!}
        <div class="row">
            <div class="col-sm-6">
                 <input type="hidden" name="existing">
                <div class="form-group">
                    {!! Form::label('User', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('idUser',$users,null, ['class' => 'form-control select2','id'=>'idUser','data-width'=>'100%']) !!}
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idUser'))
                                <p>{{ $errors->first('idUser') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>

                </div>
                <div class="form-group">
                    {!! Form::label('District', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('idDistricts[]',$districts, isset($user) ? $user_district: null, ['class' => 'form-control select2','multiple'=>'multiple','id'=>'idDistrict','data-width'=>'100%']) !!}
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idDistrict'))
                                <p>{{ $errors->first('idDistrict') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Section', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('idSection',$sections, isset($user) ? $user_section : null, ['class' => 'form-control','id'=>'section']) !!}
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idSection'))
                                <p>{{ $errors->first('idSection') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Designation', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        <select name = "idDesignation"  id="idDesignation" class="form-control">
                        </select>
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idDesignation'))
                                <p>{{ $errors->first('idDesignation') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="userdet">

                </div>
<!--                <div id='userdistrict'>
                    
                </div>
                <div id='usersubdivision'>
                    
                </div>
                <div id='userblock'>
                    
                </div>
                <div id='uservillage'>
                    
                </div>-->
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger" name="existing">Save</button>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
@include('view_script.user_district')
@stop