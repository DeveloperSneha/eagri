@extends('layouts.app')
@section('content')
<div id="formerrors"></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Scheme Activation</strong></div>
    <div class="panel-body">
        @if(isset($sch))
        {{ Form::model( $sch, ['route' => ['nv.update', $sch->idSchemeActivation], 'method' => 'put','class'=>'form-horizontal','files'=> true] ) }}
        @else
        {!! Form::open(['url' => 'schemeactivations/nv','class'=>'form-horizontal','files'=> true]) !!}
        @endif

        @if(isset($sch))
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('idSection',$sections, isset($sch) ? $sch->scheme->section->idSection : null, ['class' => 'form-control','disabled','id'=>'section']) !!}
             </div>
        </div>
        <div class="form-group">
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-7">
                <p class="form-control-static">{{$sch->scheme->schemeName}}</p>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Program', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-7">
                <p class="form-control-static">{{$sch->program->programName}}</p>
            </div>
        </div>
        @else
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::select('idSection',$sections, null, ['class' => 'form-control','id'=>'section']) !!}
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
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <select name="idScheme"  class="form-control select2" id="idScheme">--- Select Scheme ---</select>
                <span class="help-block">
                    <strong>
                        @if($errors->has('idScheme'))
                        <p>{{ $errors->first('idScheme') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Program', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <select name="idProgram"  class="form-control" id='idProgram'>--- Select Program ---</select>
                <span class="help-block">
                    <strong>
                        @if($errors->has('idProgram'))
                        <p>{{ $errors->first('idProgram') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        @endif
        <div class="form-group">
            {!! Form::label('Financial Year', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idFinancialYear',$fys, null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('idFinancialYear'))
                        <p>{{ $errors->first('idFinancialYear') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Start Date', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('startDate', null, ['class' => 'form-control datepicker']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('startDate'))
                        <p>{{ $errors->first('startDate') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
            {!! Form::label('End Date', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('endDate', null, ['class' => 'form-control datepicker']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('endDate'))
                        <p>{{ $errors->first('endDate') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Total Area Allocated', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('totalAreaAllocated', null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('totalAreaAllocated'))
                        <p>{{ $errors->first('totalAreaAllocated') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
            {!! Form::label('Total Fund Allocated', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('totalFundsAllocated', null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('totalFundsAllocated'))
                        <p>{{ $errors->first('totalFundsAllocated') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Unit', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::select('idUnit',$units, null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('idUnit'))
                        <p>{{ $errors->first('idUnit') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
            {!! Form::label('Assistance', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('assistance', null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('assistance'))
                        <p>{{ $errors->first('assistance') }}</p>
                        @endif
                        @if($errors->has('assistanceamt'))
                        <p>{{ $errors->first('assistanceamt') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Workflow', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                @if(isset($sch))
                <select name = "idWorkflow" class="form-control" id='workflow'>
                    @foreach($sch_workflow as $val=>$key)
                    <option value="{{ $val }}" selected="selected"></option>
                    @endforeach
                </select>
                @else
                <select name="idWorkflow"  class="form-control" >--- Select Workflow ---</select>
                @endif
                <span class="help-block">
                    <strong>
                        @if($errors->has('idWorkflow'))
                        <p>{{ $errors->first('idWorkflow') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
            @if(isset($sch))
            {!! Form::label('Extend Days', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('extendDays', null, ['class' => 'form-control']) !!}
                 <span class="help-block">
                    <strong>
                        @if($errors->has('extendDays'))
                        <p>{{ $errors->first('extendDays') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
            @endif
        </div>
        <div class="form-group">
            <div id="desig" class="col-sm-4 col-sm-offset-2"></div>
        </div>
        <div class="form-group">
            @if(isset($sch) && !empty($sch->guidelines))
            {!! Form::label('Guidelines', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                <p class="form-control-static"><a class="current-attachment" href="{{ url('/').Storage::url($sch->guidelines)}}">{{ $sch->guidelines }}</a></p>
            </div>
            {!! Form::label('Update File:', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::file('guidelines', null, ['class' => 'form-control']) !!}
            </div>
            @else
            {!! Form::label('Guidelines', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::file('guidelines', null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('guidelines'))
                        <p>{{ $errors->first('guidelines') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
            @endif
        </div>
        <div class="form-group">
            @if(isset($sch) && !empty($sch->notiFile))
            {!! Form::label('Notification', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                <p class="form-control-static"><a class="current-attachment" href="{{ url('/').Storage::url($sch->notiFile)}}">{{ $sch->notiFile }}</a></p>
            </div>
            {!! Form::label('Update File:', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::file('notiFile', null, ['class' => 'form-control']) !!}
            </div>
            @else
            {!! Form::label('Notification', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-3">
                {!! Form::file('notiFile', null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('notiFile'))
                        <p>{{ $errors->first('notiFile') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('Certificates', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-7">
                {!! Form::select('schemecerts[]',$schemecert, isset($sch) ? $sch->documents->pluck('idCertificate')->toArray(): null ,  ['class' => 'form-control select2','multiple'=>'multiple']) !!}
            </div>
        </div>
    </div>
    <div class="panel-footer">
        @if(isset($sch))
        <!--{!!  Form::submit('Update',['class'=>'btn btn-warning'])!!}-->
        <button type="submit" class="btn btn-danger">Update</button>
        @else
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
        <button type="submit" class="btn btn-danger">Save</button>
        @endif
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Schemes</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Scheme Name</th>
                    <th>Program Name</th>
                    <th>Financial Year</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Unit</th>
                    <th>Extend Days</th>
                    <th>Total Fund Allocated</th>
                    <th>Total Area Allocated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schact as $var)
                <tr>
                    <td>{{ $var->idSchemeActivation }}</td>
                    <td>{{ $var->scheme->schemeName}}</td>
                    <td>{{ $var->program->programName}}</td>
                    <td>{{ $var->fy->financialYearName}}</td>
                    <td>{{ $var->startDate }}</td>
                    <td>{{ $var->endDate }}</td>
                    <td>{{ $var->unit->unitName}}</td>
                    <td>{{ $var->extendDays}}</td>
                    <td>{{ $var->totalFundsAllocated }}</td>
                    <td>{{ $var->totalAreaAllocated }}</td>
                    <td>
                     {{--   {{ Form::open(['route' => ['nv.destroy', $var->idSchemeActivation], 'method' => 'delete','class'=>'form-inline']) }}--}}
                        <a href='{{url('/schemeactivations/nv/'.$var->idSchemeActivation.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
<!--                        <button class="btn btn-xs btn-danger" type="submit">Delete</button>-->
                    {{--    {{ Form::close() }} --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
@section('script')
@include('view_script.scheme_activation_nonvendor')
@stop