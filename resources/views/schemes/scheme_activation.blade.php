@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Scheme Activation</strong></div>
    <div class="panel-body">
        @if(isset($sch))
        {{ Form::model( $sch, ['route' => ['schemeactivations.update', $sch->idSchemeActivation], 'method' => 'put','class'=>'form-horizontal','files'=> true] ) }}
        @else
        {!! Form::open(['url' => 'schemeactivations','class'=>'form-horizontal','files'=> true]) !!}
        @endif
        @if(isset($sch))
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label']) !!}
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
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('idSection',$sections, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
               <select name="idScheme"  class="form-control select2" >--- Select Scheme ---</select>
            </div>
        </div>
        @endif
        <div class="form-group">
           {!! Form::label('Financial Year', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::select('idFinancialYear',$fys, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('Start Date', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('startDate', null, ['class' => 'form-control datepicker']) !!}
            </div>
            {!! Form::label('End Date', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('endDate', null, ['class' => 'form-control datepicker']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Unit', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::select('idUnit',$units, null, ['class' => 'form-control']) !!}
            </div>
            {!! Form::label('Extend Days', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('extendDays', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Total Fund Allocated', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('totalFundsAllocated', null, ['class' => 'form-control']) !!}
            </div>
            {!! Form::label('Total Area Allocated', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('totalAreaAllocated', null, ['class' => 'form-control']) !!}
            </div>

        </div>
        
        <div class="form-group">
            {!! Form::label('Vendor Delivery Day Limit', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::text('vendorDeliveryDayLimit', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            @if(isset($sch) && ! empty($sch->guidelines))
            {!! Form::label('Guidelines', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                <p class="form-control-static"><a class="current-attachment" href="{{ url('/').Storage::url($sch->guidelines)}}">{{ $sch->guidelines }}</a></p>
            </div>
            {!! Form::label('Update File:', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::file('guidelines', null, ['class' => 'form-control']) !!}
            </div>
            @else
            {!! Form::label('Guidelines', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::file('guidelines', null, ['class' => 'form-control']) !!}
            </div>
            @endif
        </div>
        <div class="form-group">
            @if(isset($sch) && ! empty($sch->notiFile))
            {!! Form::label('Notification', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                <p class="form-control-static"><a class="current-attachment" href="{{ url('/').Storage::url($sch->notiFile)}}">{{ $sch->notiFile }}</a></p>
            </div>
            {!! Form::label('Update File:', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::file('notiFile', null, ['class' => 'form-control']) !!}
            </div>
            @else
            {!! Form::label('Notification', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-6">
               {!! Form::file('notiFile', null, ['class' => 'form-control']) !!}
            </div>
            @endif
        </div>
         <div class="form-group">
            {!! Form::label('Workflow', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::select('idWorkflow',$workflow, isset($sch) ? $sch->workflow->pluck('idWorkflow')->toArray(): null ,  ['class' => 'form-control']) !!}
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
                    <th>Vendor Delivery Day Limit</th>
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
                    <td>{{ $var->vendorDeliveryDayLimit }}</td>
                    <td>
                        {{ Form::open(['route' => ['schemeactivations.destroy', $var->idSchemeActivation], 'method' => 'delete','class'=>'form-inline']) }}
                        <a href='{{url('/schemeactivations/'.$var->idSchemeActivation.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
    $(document).ready(function() {
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
    });
 </script>
@stop