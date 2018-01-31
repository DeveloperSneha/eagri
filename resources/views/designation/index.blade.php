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
                {!! Form::text('designationName', null, ['class' => 'form-control','placeholder'=>'Enter  Name','maxlength'=>'50','minlength'=>'2','onkeypress'=>'return onlylettersandSpecialChar()']) !!}
            
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
              {!! Form::text('level', null, ['class' => 'form-control','maxlength'=>'1','minlength'=>'1','onkeypress'=>'return isNumber(event)']) !!}
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
        {!!  Form::submit('Update',['class'=>'btn btn-danger'])!!}
        <a href="{{url('/designations')}}" class="btn btn-danger">Cancel</a>
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
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>SNO</th>
                    <th>Section</th>
                    <th>Designation Name</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                @foreach($designations as $var)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $var->section->sectionName}}</td>
                    <td>{{ $var->designationName }}</td>
                    <td>{{ $var->level }}</td>
                    <td>
                        <a href='{{url('/designations/'.$var->idDesignation.'/editdesignation')}}' class="btn btn-sm btn-warning">Edit</a>
                      
                       <a href='{{url('/designations/'.$var->idDesignation.'/deletedesignation')}}' class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@stop