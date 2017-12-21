@extends('layouts.app')
@section('content')

<div class="panel panel-default">
    <div class="panel-heading"><strong>@if(isset($workflow)) Edit @else Add @endif  Workflow</strong></div>
    <div class="panel-body">
        @if(isset($workflow))
        {{ Form::model( $workflow, ['route' => ['workflow.update', $workflow->idWorkflow], 'method' => 'patch','class'=>'form-horizontal'] ) }}
        @else
        {!! Form::open(['url' => 'workflow','class'=>'form-horizontal']) !!}
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
                    <option value="{{ $val->designation->idDesignation }}" selected="selected" disabled="disabled">{{ $val->designation->designationName }}</option>
                    @endforeach 
                </select>
            </div>
            
        </div>
        @else
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <select name = "designations[]" id="idDesignation" class="form-control select2" multiple="multiple" >
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
                {!! Form::text('workflowName', null, ['class' => 'form-control']) !!}
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
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
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
                        {{ Form::open(['route' => ['workflow.destroy', $var->idWorkflow], 'method' => 'delete']) }}
                        <a href='#' class="btn btn-xs btn-warning" disabled>Edit</a>
                        <button class="btn btn-xs btn-danger" type="submit" disabled>Delete</button>
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
    $(document).ready(function () {
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
                success: function (data) {
                    
                    var selectedOptions = [];
                        $('#idDesignation option:selected').each(function (index, option) { 
                            var value = $(this).val();
                               if($.trim(value)){
                                   selectedOptions.push(value);
                               }
                       }); 
                    console.log(selectedOptions);
                    
                    var values = [];
                    $.each(data, function (key, value) {
                      if($.trim(value)){
                                   values.push(key);
                               }
                    });
                    console.log(values);
                    var difference = [];
                        jQuery.grep(values, function(el) {
                               if (jQuery.inArray(el, selectedOptions) == -1) difference.push(el);
                       });
                     console.log(difference); console.log(data); 
                     $.each(data, function (key, value) {
                       
                       var diff = key;
                      
                        if (difference.indexOf(diff)) {
                         
                           $('select[id="idDesignation"]').append('<option disabled= "disabled" value="' + key + '" >' + value + '</option>');
                            
                             }else{
                                  
                                 $('select[id="idDesignation"]').append('<option  value="' + key + '" >' + value + '</option>');
                             }
                         

                    });

                }

            });

        }
        

    });

</script>
@stop