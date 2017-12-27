@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>@if(isset($scheme)) Edit @else Create @endif  Scheme</strong></div>
    <div class="panel-body">
        @if(isset($scheme))
        {{ Form::model( $scheme, ['route' => ['schemes.update', $scheme->idScheme], 'method' => 'patch','class'=>'form-horizontal'] ) }}
        @else
        {!! Form::open(['url' => 'schemes','class'=>'form-horizontal']) !!}
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
            {!! Form::label('Scheme Name', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('schemeName', null, ['class' => 'form-control','placeholder'=>'Enter Scheme Name']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('schemeName'))
                        <p>{{ $errors->first('schemeName') }}</p>
                        @endif
                    </strong>
                </span>
        </div>
        <div class="form-group">
            {!! Form::label('Remarks', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::textarea('remarks', null, ['class' => 'form-control','size'=>'30x3','placeholder'=>'Enter Remarks']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('remarks'))
                        <p>{{ $errors->first('remarks') }}</p>
                        @endif
                    </strong>
                </span>
        </div>      
        
    </div>
    <div class="panel-footer">
            
                @if(isset($scheme))
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
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Section</th>
                    <th>Scheme Name</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schemes as $var)
                <tr>
                    <td>{{ $var->idScheme }}</td>
                    <td>{{ $var->section->sectionName }}</td>
                    <td>{{ $var->schemeName }}</td>
                    <td>{{ $var->remarks }}</td>
                    <td>
                        {{ Form::open(['route' => ['schemes.destroy', $var->idScheme], 'method' => 'delete']) }}
                        <a href='{{url('/schemes/'.$var->idScheme.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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