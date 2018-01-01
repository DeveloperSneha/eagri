@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>@if(isset($user)) Update User@else Add User @endif</strong></div>
    <div class="panel-body">
        @if(isset($user))
        {!! Form::model($user, ['route' => ['user-registration.update', $user->idUser], 'method' => 'patch','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'user-registration','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idDistrict',$districts,isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control select2']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idDistrict'))
                    <p>{{ $errors->first('idDistrict') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idSection',$sections, isset($user) ? $user_section : null, ['class' => 'form-control','id'=>'section']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idSection'))
                    <p>{{ $errors->first('idSection') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        @if(isset($user))
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "designations[]" id="idDesignation" class="form-control select2" multiple="multiple" >
                    @foreach($user_desig as $val)
                    <option value="{{ $val->designation->idDesignation }}" selected="selected" disabled="disabled">{{ $val->designation->designationName }}</option>
                    @endforeach 
                </select>
            </div>
            
        </div>
        @else
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
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
            {!! Form::label('Username', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::text('userName', null, ['class' => 'form-control','maxlength'=>'50']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('userName'))
                    <p>{{ $errors->first('userName') }}</p>
                    @endif
                </strong>
            </span>
        </div>
    </div>
    <div class="panel-footer">
        @if(isset($user))
        <button type="submit" class="btn btn-danger">Update</button>
        @else
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
        <button type="submit" class="btn btn-danger">Save</button>
        @endif
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Users</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>District</th>
                    <th>Section</th>
                    <th>User Name</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $var)
                <tr>
                    <td>{{ $var->idUser }}</td>
                    <td>{{ $var->userdesig->district->districtName or ''}}</td>
                    <td>{{ $var->userdesig->designation->section->sectionName or ''}}</td>
                    <td>{{ $var->userName}}</td>
                    <td>{{ $var->userdesig->designation->designationName or ''}} </td>
                    <td>
                        {{ Form::open(['route' => ['user-registration.destroy', $var->idUser], 'method' => 'delete']) }}
                        <a href='{{url('/user-registration/'.$var->idUser.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
@section('script')
<script>
    $(document).ready(function() {
        $('select[name="idSection"]').on('change', function() {
            var sectionID = $(this).val();
            if(sectionID) {
                $.ajax({
                    url: "{{url('/section') }}"+'/' +sectionID + "/designations",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="idDesignation"]').empty();
                        $.each(data, function(key, value) {
                            $('select[id="idDesignation"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[id="idDesignation"]').empty();
            }
        });
        
        var cur_section = $( "#section option:selected" ).val();
        if(cur_section){
            $.ajax({
                    url: "{{url('/section') }}"+'/' +cur_section + "/designations",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
//                        $(".select2-selection__choice").prop('disabled', true);
                        console.log($("#idDesignation option:selected"));
                        $.each(data, function(key, value) {
                            $('select[id="idDesignation"]').append('<option value="'+ key +'" >'+ value +'</option>');
                        });
                        
                    }
                });
                    
        }
 });

 </script>
@stop