@extends('layouts.app')
@section('content')
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
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <p class="form-control-static">{{$sch->scheme->section->sectionName}}</p>
            </div>
            
        </div>
        <div class="form-group">
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-7">
                <p class="form-control-static">{{$sch->scheme->schemeName}}</p>
            </div>
        </div>
        @else
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::select('idSection',$sections, null, ['class' => 'form-control','id'=>'section']) !!}
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
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
               <select name="idScheme"  class="form-control select2" >--- Select Scheme ---</select>
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('idScheme'))
                        <p>{{ $errors->first('idScheme') }}</p>
                        @endif
                    </strong>
                </span>
        </div>
        @endif
        <div class="form-group">
            {!! Form::label('Financial Year', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idFinancialYear',$fys, null, ['class' => 'form-control']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('idFinancialYear'))
                        <p>{{ $errors->first('idFinancialYear') }}</p>
                        @endif
                    </strong>
                </span>
        </div>
        <div class="form-group">
            {!! Form::label('Start Date', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('startDate', null, ['class' => 'form-control datepicker']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('startDate'))
                        <p>{{ $errors->first('startDate') }}</p>
                        @endif
                    </strong>
                </span>
            {!! Form::label('End Date', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('endDate', null, ['class' => 'form-control datepicker']) !!}
            </div>
             <span class="help-block">
                    <strong>
                        @if($errors->has('endDate'))
                        <p>{{ $errors->first('endDate') }}</p>
                        @endif
                    </strong>
                </span>
        </div>
        
        <div class="form-group">
            {!! Form::label('Total Fund Allocated', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('totalFundsAllocated', null, ['class' => 'form-control']) !!}
            </div>
             <span class="help-block">
                    <strong>
                        @if($errors->has('totalFundsAllocated'))
                        <p>{{ $errors->first('totalFundsAllocated') }}</p>
                        @endif
                    </strong>
                </span>
            {!! Form::label('Extend Days', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('extendDays', null, ['class' => 'form-control']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('extendDays'))
                        <p>{{ $errors->first('extendDays') }}</p>
                        @endif
                    </strong>
                </span>
        </div>
        <div class="form-group">
            {!! Form::label('Total Area Allocated', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('totalAreaAllocated', null, ['class' => 'form-control']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('totalAreaAllocated'))
                        <p>{{ $errors->first('totalAreaAllocated') }}</p>
                        @endif
                    </strong>
                </span>
             {!! Form::label('Unit', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::select('idUnit',$units, null, ['class' => 'form-control']) !!}
            </div>
             <span class="help-block">
                    <strong>
                        @if($errors->has('idUnit'))
                        <p>{{ $errors->first('idUnit') }}</p>
                        @endif
                    </strong>
                </span>
        </div>
        <div class="form-group">
            {!! Form::label('Assistance', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::text('assistance', null, ['class' => 'form-control']) !!}
                <span class="help-block">
                    <strong>
                        @if($errors->has('assistance'))
                        <p>{{ $errors->first('assistance') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
            {!! Form::label('Workflow', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2">
                {!! Form::select('idWorkflow',$workflow, isset($sch) ? $sch->workflow->pluck('idWorkflow')->toArray(): null ,  ['class' => 'form-control']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('idWorkflow'))
                        <p>{{ $errors->first('idWorkflow') }}</p>
                        @endif
                    </strong>
            </span>
        </div>
        <div class="form-group">
            <div id="desig" class="col-sm-8 col-sm-offset-5"></div>
        </div>
        <div class="form-group">
            @if(isset($sch) && ! empty($sch->guidelines))
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
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('guidelines'))
                        <p>{{ $errors->first('guidelines') }}</p>
                        @endif
                    </strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            @if(isset($sch) && ! empty($sch->notiFile))
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
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('notiFile'))
                        <p>{{ $errors->first('notiFile') }}</p>
                        @endif
                    </strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            {!! Form::label('Scheme Certificates', null, ['class' => 'col-sm-2 control-label']) !!}
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
                    <td>{{ $var->fy->financialYearName}}</td>
                    <td>{{ $var->startDate }}</td>
                    <td>{{ $var->startDate }}</td>
                    <td>{{ $var->unit->unitName}}</td>
                    <td>{{ $var->extendDays}}</td>
                    <td>{{ $var->totalFundsAllocated }}</td>
                    <td>{{ $var->totalAreaAllocated }}</td>
                    <td>
                        {{ Form::open(['route' => ['nv.destroy', $var->idSchemeActivation], 'method' => 'delete','class'=>'form-inline']) }}
                        <a href='{{url('/schemeactivations/nv/'.$var->idSchemeActivation.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
<script>
    $(document).ready(function() 
    {
        $('select[name="idSection"]').on('change', function() {
            var sectionID = $(this).val();
            if(sectionID) {
                $.ajax({
                    url: "{{url('/section') }}"+'/' +sectionID + "/schemes",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idScheme"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="idScheme"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idScheme"]').empty();
            }
        });
        var cur_section = $( "#section option:selected" ).val();
        if(cur_section){
            $.ajax({
                    url: "{{url('/section') }}"+'/' +cur_section + "/schemes",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idScheme"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="idScheme"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });                    
        }
        $('select[name="idWorkflow"]').on('change', function() {
            var workflowID = $(this).val();
            if(workflowID) {
                $.ajax({
                    url: "{{url('/workflow') }}"+'/' +workflowID + "/designations",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#desig').empty();
                        $.each(data, function(key, value) {
                            $('#desig').append('<label >'+ key +'</label>,<br>');
                        });

                    }
                });
            }else{
                $('#desig').empty();
            }
        });
    });
 </script>
@stop