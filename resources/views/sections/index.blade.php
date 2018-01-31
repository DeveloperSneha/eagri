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
                {!! Form::text('sectionName', null, ['class' => 'form-control','placeholder'=>'Enter Section Name','maxlength'=>'50','minlength'=>'2','onkeypress'=>'onlylettersandSpecialChar']) !!}
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
                    <a href="{{url('/sections')}}" class="btn btn-danger">Cancel</a>
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
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>SNO</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                @foreach($sections as $var)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $var->sectionName }}</td>
                    <td>
                       
                        <a href='{{url('/sections/'.$var->idSection.'/editsection')}}' class="btn btn-xs btn-warning">Edit</a>
                      {{--   {{ Form::open(['route' => ['sections.destroy', $var->idSection], 'method' => 'delete']) }} --}}
                       <a href='{{url('/sections/'.$var->idSection.'/deletesection')}}' class="btn btn-xs btn-danger">Delete</a>
                      {{--  {{ Form::close() }} --}}
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop