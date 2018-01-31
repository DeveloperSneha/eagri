@extends('layouts.app')
@section('content')
<div id='formerrors'></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>@if(isset($workflow)) Edit @else Add @endif  Workflow</strong></div>
    <div class="panel-body">
        @if(isset($workflow))
        {{ Form::model( $workflow, ['route' => ['workflow.update', $workflow->idWorkflow], 'method' => 'patch','class'=>'form-horizontal'] ) }}
        @else
        {!! Form::open(['url' => 'workflow','class'=>'form-horizontal','id'=>'workflowform']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::select('idSection',$sections,(isset($workflow) ? $section : null),['class' => 'form-control','id'=>'section']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('idSection'))
                        <p>{{ $errors->first('idSection') }}</p>
                        @endif
                    </strong>
            </span> 
        </div>
        @if(isset($workflow))
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <select name = "designations[]" id="idDesignation" class="form-control select2" multiple="multiple" >
                    @foreach($step as $val)
                    <option value="{{ $val->designation->idDesignation }}" selected="selected">{{ $val->designation->designationName }}</option>
                    @endforeach 
                </select>
            </div>
        </div>
        @else
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <select name = "designations[]" id="idDesignation" class="form-control select2" multiple="multiple" >---Select Designation ---
                </select>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('designation'))
                    <p>{{ $errors->first('designation') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        @endif
        <div class="form-group">
            {!! Form::label('Workflow Name', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('workflowName', null, ['class' => 'form-control','maxlength'=>'50','minlength'=>'2','onkeypress'=>'onlylettersandSpecialChar']) !!}
            </div>
            <span class="help-block">
                    <strong>
                        @if($errors->has('workflowName'))
                        <p>{{ $errors->first('workflowName') }}</p>
                        @endif
                    </strong>
                </span> 
        </div> 
    </div>
    <div class="panel-footer">
        @if(isset($workflow))
        <!--{!!  Form::submit('Update',['class'=>'btn btn-warning'])!!}-->
	    <button type="submit" class="btn btn-danger">Update</button>
            <a href="{{url('/workflow')}}" class="btn btn-danger">Cancel</a>
        @else
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
	    <button type="submit" class="btn btn-danger">Save</button>
        @endif
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Workflow</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>SNO</th>
                    <th>Workflow Name</th>
                    <th>Designations</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workflows as $var)
                <tr>
                    <td>{{ $var->idWorkflow }}</td>
                    <td>{{ $var->workflowName }}</td>
                    <td>
                        @foreach($var->steps as $value)
                        {{$value->designation->designationName}}<br>

                        @endforeach
                    </td>
                    <td>
                        <a href='{{url('/workflow/'.$var->idWorkflow.'/editworkflow')}}' class="btn btn-sm btn-warning">Edit</a>
                      
                       <a href='{{url('/workflow/'.$var->idWorkflow.'/deleteworkflow')}}' class="btn btn-sm btn-danger">Delete</a>
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
     $('select[name="idSection"]').on('change', function () {
            var sectionID = $(this).val();
            if (sectionID) {
                $.ajax({
                    url: "{{url('/section') }}" + '/' + sectionID + "/designations",
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[id="idDesignation"]').empty();
                        $.each(data, function (key, value) {
                            $('select[id="idDesignation"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[id="idDesignation"]').empty();
            }
        });
        var cur_section = $("#section option:selected").val();
        if (cur_section) {
            $.ajax({
                url: "{{url('/section') }}" + '/' + cur_section + "/designations",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    @if(isset($workflow))
                        var myPlayList = [];
                        @foreach($step as $val)
                        var h = {{$val->designation->idDesignation}}; 
                        myPlayList.push(h.toString());
                        @endforeach
                        $.each(data, function(key, value) {
                            if($.inArray(key,myPlayList) === -1){
                                $('select[id="idDesignation"]').append('<option value="'+ key +'" >'+ value +'</option>');
                                }
                                else{
                                $('select[id="idDesignation"]:selected').append('<option value="'+ key +'" >'+ value +'</option>');
                                }                            
                        });
                    @else
                        $('select[id="idDesignation"]').empty();
                        $.each(data, function (key, value) {
                            $('select[id="idDesignation"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    @endif
                }
            });
        }
    
    $('#workflowform').on('submit',function(e){
        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
    });
    var formData = $(this).serialize();
        $.ajax({
            type:"POST",
            url: "{{url('/workflow') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
                if( data[Object.keys(data)[0]] === 'SUCCESS' ){		//True Case i.e. passed validation
                window.location = "{{url('workflow')}}";
                }
                else {					//False Case: With error msg
                $("#msg").html(data);	//$msg is the id of empty msg
                }

            },

            error: function(data){
                        if( data.status === 422 ) {
                            var errors = data.responseJSON.errors;
                            var errorHtml = '<div class="alert alert-danger"><ul>';
                            $.each( errors, function( key, value ) {    
                               errorHtml += '<li>' + value + '</li>'; 
                            });
                            errorHtml += '</ul></div>';
                            $('#formerrors').html(errorHtml);
                           
                     }
                }
        });
        return false;
    });
</script>
@stop