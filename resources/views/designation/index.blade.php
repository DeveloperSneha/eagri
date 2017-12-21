@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>@if(isset($designation)) Edit @else Add @endif  Designation</strong></div>
    <div class="panel-body">
        @if(isset($designation))
        {!! Form::model( $designation, ['route' => ['designations.update', $designation->idDesignation], 'method' => 'patch','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'designations','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::select('idSection',$sections, null, ['class' => 'form-control']) !!}
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
            {!! Form::label('Designation Name', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('designationName', null, ['class' => 'form-control','placeholder'=>'Enter  Name']) !!}
            
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('designationName'))
                        {{ $errors->first('designationName') }}
                        @endif
                    </strong>
                </span>
        </div>
        <div class="form-group">
            {!! Form::label('Level', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-1">
              {!! Form::text('level', null, ['class' => 'form-control']) !!}
            </div>
            <span class="help-block">                
                    <strong>
                        @if($errors->has('level'))
                        <p>{{ $errors->first('level') }}</p>
                        @endif
                    </strong>
                </span>
        </div>        
    </div>
    <div class="panel-footer">
        @if(isset($designation))
        {!!  Form::submit('Update',['class'=>'btn btn-warning'])!!}
        @else
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
	    <button type="submit" class="btn btn-danger">Save</button>
        @endif

        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Designations</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Section</th>
                    <th>Designation Name</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($designations as $var)
                <tr>
                    <td>{{ $var->idDesignation }}</td>
                    <td>{{ $var->section->sectionName}}</td>
                    <td>{{ $var->designationName }}</td>
                    <td>{{ $var->level }}</td>
                    <td>
                        {{ Form::open(['route' => ['designations.destroy', $var->idDesignation], 'method' => 'delete']) }}
                        <a href='{{url('/designations/'.$var->idDesignation.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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