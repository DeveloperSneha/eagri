@extends('layouts.app')
@section('content')
<div id="formerrors"></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Scheme Distribution (District)</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'districtdistribution','class'=>'form-horizontal','id'=>'districtdistribution']) !!}
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
                <select name="idSchemeActivation"  class="form-control" id='idProgram'>--- Select Program ---</select>
                <span class="help-block">
                    <strong>
                        @if($errors->has('idSchemeActivation'))
                        <p>{{ $errors->first('idSchemeActivation') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>

        <div class="form-group">
            <div id="area-fund" class="col-sm-12">
                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Apply to All District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2 checkbox-inline">
                <input type="checkbox" class="select-all" id="selectall"/>
            </div>
        </div>
        
        <div class="col-sm-8 col-sm-offset-2 ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>District</th>
                        <th></th>
                        <th>Physical Target</th>
                        <th>Financial Target</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($districts as $key=>$value)
                    <tr>
                        <td><strong>{{ $value }} </strong>
                            <span id='errordist{{$key}}'></span>
                        </td>
                        <td>
                            <input type="checkbox" value="{{ $key}}" name="districts[{{$key}}][idDistrict]" id='district' class='count_dist'>
                        </td>
                        <td>
                            <input type="text"  class="form-control" data-toggle="tooltip" data-placement="right" name="districts[{{$key}}][areaDistrict]"  id="areadistrict{{$key}}" onchange="getArea({{$key}})" >
                            <span id='errorarea{{$key}}'></span>
                            <input type="hidden" id="hiddenarea{{$key}}">
                        </td>
                        <td>
                            <input type="text"  class="form-control" name="districts[{{$key}}][amountDistrict]" id="amtdistrict{{$key}}">
                            <span id='erroramt{{$key}}'></span>
                            <input type="hidden" id="hiddenamount{{$key}}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel-footer">
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
		<button type="submit" class="btn btn-danger">Save</button>
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>District wise Distribution Listing</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable"  id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Scheme</th>
                    <th>Program</th>
                    <th>Districts</th>
                    <th>FinancialTarget</th>
                    <th>PhysicalTarget</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schdistrict as $var)
                <tr>
                    <td>{{ $var->idSchemDistributionDistrict }}</td>
                    <td>{{ $var->schactivation->scheme->schemeName}}</td>
                    <td>{{ $var->schactivation->program->programName}}</td>
                    <td>{{ $var->district->districtName }}</td>
                    <td>{{ $var->amountDistrict }}</td>
                    <td>{{ $var->areaDistrict }}</td>
                    <td>
                        {{ Form::open(['route' => ['districtdistribution.destroy', $var->idSchemDistributionDistrict], 'method' => 'delete']) }}
                        <a href='{{url('/districtdistribution/'.$var->idSchemDistributionDistrict.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
@include('view_Script.district_distjs');
@stop