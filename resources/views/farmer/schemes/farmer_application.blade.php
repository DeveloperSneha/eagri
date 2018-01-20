@extends('farmer.farmer_layout')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Apply For : <strong>{{$program->programName}}</strong></div>
   {{ Form::open(['action' => ['Farmer\FarmerSchemeController@submitSchemeApplication', $program->idProgram], 'method' => 'post','class'=>'form-horizontal'] ) }}
   <div class="panel-body">
       <div class="form-group">
            {!! Form::label('Section Name', null, ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                 <input type="hidden" name='idScheme' value="{{$program->scheme->idScheme}}">
                <p class="form-control-static">{{$program->scheme->section->sectionName}}</p>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Scheme Name', null, ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <p class="form-control-static">{{$program->scheme->schemeName}}</p>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Program For Which Applied', null, ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-4">
               <p class="form-control-static">{{$program->programName}}</p>
                <input type="hidden" name='idProgram' value="{{$program->idProgram}}">
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Area For Which Applied /No.Of Items Applied', null, ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::text('areaApplied',null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Whether You Have Previousely  Applied For This Scheme', null, ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-2">
                {!! Form::select('previouslyApplied',['N'=>'NO','Y'=>'Yes'],null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="panel-footer">
        
        <!--{!!  Form::submit('Submit',['class'=>'btn btn-danger'])!!}-->
		<button type="submit" class="btn btn-danger">Save</button>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
<script>
    $(document).ready(function() {
        $('select[name="idProgram"]').on('change', function() {
            var programID = $(this).val();
            if(programID) {
                $.ajax({
                    url: "{{url('/farmer/program/') }}"+'/' +programID + "/categories",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idCategory"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="idCategory"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idCategory"]').empty();
            }
        });
        
        $('select[name="idCategory"]').on('change', function() {
            var idCategory = $(this).val();
            if(idCategory) {
                $.ajax({
                    url: "{{url('/farmer/category/') }}"+'/' +idCategory + "/components",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idComponent"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="idComponent"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idComponent"]').empty();
            }
        });
    });
</script>
@stop