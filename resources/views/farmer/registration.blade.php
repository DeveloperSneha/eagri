@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Register Here</strong>
    </div>
    <div class="panel-body">
   {!! Form::open(['url' => 'farmer-reg','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('Name Of Farmer', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Name']) !!}
            </div>
            {!! Form::label('Father/Husband Name', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Father/Husband Name']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Aadhar No', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Aadhar No']) !!}
            </div>
            {!! Form::label('Ration Card No.', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Ration Card No.']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Farmer Category', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Farmer Category']) !!}
            </div>
            {!! Form::label('Gender', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::select('gender', getGender(),null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Marital Status', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::select('name', getMaritalStatus(),null, ['class' => 'form-control']) !!}
            </div>
            {!! Form::label('Caste Category', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::select('name', getCasteCategory(),null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Mobile No', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter name']) !!}
            </div>
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                <select name="district" class="form-control">
                    <option value="">--- Select District ---</option>
                    @foreach ($districts as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
               <select name="block" class="form-control" >--- Select Block ---</select>
            </div>
            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
               <select name="village" class="form-control" >--- Select Village ---</select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-8">
                {!!  Form::submit('Save And Continue',['class'=>'btn btn-primary'])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
<script>
    $(document).ready(function() {
        $('select[name="district"]').on('change', function() {
            var districtID = $(this).val();
            if(districtID) {
                $.ajax({
                    url: "{{url('/district/') }}"+'/' +districtID + "/blocks",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="block"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="block"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="block"]').empty();
            }
        });
        
        $('select[name="block"]').on('change', function() {
            var blockID = $(this).val();
            if(blockID) {
                $.ajax({
                    url: "{{url('/block/') }}"+'/' +blockID + "/villages",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="village"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="village"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="village"]').empty();
            }
        });
    });
</script>
@stop