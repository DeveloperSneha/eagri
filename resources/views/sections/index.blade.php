@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>@if(isset($section)) Edit @else Create @endif Section</strong></div>
    <div class="panel-body">
        @if(isset($section))
        {{ Form::model( $section, ['route' => ['sections.update', $section->idSection], 'method' => 'put'] ) }}
        @else
        {!! Form::open(['url' => 'sections','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Name Of Sections', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('sectionName', null, ['class' => 'form-control','placeholder'=>'Enter Section Name']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('sectionName'))
                        <p>{{ $errors->first('sectionName') }}</p>
                        @endif
                    </strong>
                </span>

        </div>
        </div>
        <div class="panel-footer">
            @if(isset($section))
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
    <div class="panel-heading"><strong>Section</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections as $var)
                <tr>
                    <td>{{ $var->idSection }}</td>
                    <td>{{ $var->sectionName }}</td>
                    <td>
                        {{ Form::open(['route' => ['sections.destroy', $var->idSection], 'method' => 'delete']) }}
                        <a href='{{url('/sections/'.$var->idSection.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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