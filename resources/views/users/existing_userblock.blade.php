@extends('layouts.app')
@section('content')
<!-------------------Existing User---------------------------------------------------------------------->
<div class="panel panel-default">
    <div class="panel-heading"><strong>Add Existing User</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'userblock','class'=>'form-horizontal']) !!}
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('User', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('idUser',$users,null, ['class' => 'form-control select2','id'=>'idUser']) !!}
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
                        {!! Form::select('idDistrict',$districts, isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control select2','id'=>'idDistrict']) !!}

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
                    {!! Form::label('SubDivision', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        <select name = "idSubdivision"  id="idSubdivision" class="form-control">
                        </select>
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idSubdivision'))
                                <p>{{ $errors->first('idSubdivision') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Block', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        <select name = "idBlocks[]"  id="idBlock" class="form-control select2" multiple="multiple" >
                        </select>
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idBlock'))
                                <p>{{ $errors->first('idBlock') }}</p>
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
@include('view_script.user_block')
@stop