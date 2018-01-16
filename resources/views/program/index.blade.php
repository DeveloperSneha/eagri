@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($program))
    <div class="panel-heading">Edit Program : <strong>{{$program->programName }}</strong></div>
    @else
    <div class="panel-heading"><strong>Create Program</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($program))
        {!! Form::model( $program, ['route' => ['programs.update', $program->idProgram], 'method' => 'put','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'programs','class'=>'form-horizontal']) !!}
        @endif
        @if(isset($program))
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                <p class="form-control-static">{{$program->scheme->section->sectionName}}</p>
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
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-7">
                <p class="form-control-static">{{$program->scheme->schemeName}}</p>
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('sectionName'))
                        <p>{{ $errors->first('sectionName') }}</p>
                        @endif
                    </strong>
                </span>
        </div>
        @else
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
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
               <select name="idScheme" class="form-control select2" >--- Select Scheme ---</select>
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
            {!! Form::label('Name Of Program', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('programName', null, ['class' => 'form-control','placeholder'=>'Enter Name','maxlength'=>'50','minlength'=>'2','onkeypress'=>'return lettersOnly(event)']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('programName'))
                        <p>{{ $errors->first('programName') }}</p>
                        @endif
                    </strong>
                </span>
        </div>
        <div class="form-group">
            {!! Form::label('Vendor Required', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::select('isVendorRequired',['N'=>'No','Y'=>'Yes'], null, ['class' => 'form-control']) !!}

            </div>
        </div>
    </div>
    <div class="panel-footer">
        @if(isset($program))
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
    <div class="panel-heading"> <strong>Programs</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>SNO</th>
                    <th>Scheme</th>
                    <th>Program Name</th>
                    <th>Vendor Required</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                @foreach($programs as $var)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $var->scheme->schemeName }}</td>
                    <td>{{ $var->programName }}</td>
                    <td>@if($var->isVendorRequired == 'Y')Yes @else NO @endif</td>
                    <td>
                        
                        <a href='{{url('/programs/'.$var->idProgram.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
                      
                       <a href='{{url('/programs/'.$var->idProgram.'/deleteprogram')}}' class="btn btn-xs btn-danger">Delete</a>
                     
                    </td>
                </tr>
                <?php $i++; ?>
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