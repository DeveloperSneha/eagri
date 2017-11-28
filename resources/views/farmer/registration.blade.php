@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-3">

    </div>
    <div class="col-sm-9">


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
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Gender']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Marital Status', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Marital Status']) !!}
            </div>
            {!! Form::label('Caste Category', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Caste Category']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Mobile No', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter name']) !!}
            </div>
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter District']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Block']) !!}
            </div>
            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('name', null, ['class' => 'form-control','placeholder'=>'Enter Village Name']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-8">
                {!!   Form::submit('Save And Continue',['class'=>'btn btn-primary'])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@stop