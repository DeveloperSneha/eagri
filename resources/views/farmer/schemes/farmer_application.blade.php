@extends('farmer.farmer_layout')
@section('content')
<div class="panel panel-success">
    <div class="panel-heading">Apply For : <strong>{{$scheme->schemeName}}</strong></div>
   {{ Form::open(['action' => ['Farmer\FarmerSchemeController@submitSchemeApplication', $scheme->idScheme], 'method' => 'post','class'=>'form-horizontal'] ) }}
   <input type="hidden" name='idScheme' value="{{$scheme->idScheme}}">
   <div class="panel-body">
        <div class="form-group">
            {!! Form::label('Scheme Name', null, ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <p class="form-control-static">{{$scheme->schemeName}}</p>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Program For Which Applied', null, ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::select('idProgram',$programs, null, ['class' => 'form-control']) !!}
            </div>
        </div>
<!--       <div class="form-group">
           {!! Form::label('Category For Which Applied', null, ['class' => 'col-sm-3 control-label']) !!}
           <div class="col-sm-4">
               {!! Form::select('idCategory',[''=>'Select'], null, ['class' => 'form-control']) !!}
           </div>
       </div>
       <div class="form-group">
           {!! Form::label('Component For Which Applied', null, ['class' => 'col-sm-3 control-label']) !!}
           <div class="col-sm-4">
               {!! Form::select('idComponent',[''=>'Select'], null, ['class' => 'form-control']) !!}
           </div>
       </div>-->
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