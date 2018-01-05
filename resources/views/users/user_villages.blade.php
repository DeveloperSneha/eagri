@extends('layouts.app')
@section('content')
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#new">New</a></li>
    <li><a data-toggle="tab" href="#">Existing</a></li>
</ul>
<div class="tab-content">
<!-------------------Existing User---------------------------------------------------------------------->
<div class="panel panel-default tab-pane fade" id='existing'>
    <div class="panel-heading"><strong>Add User</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'uservillage','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('User', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idUser',$users,null, ['class' => 'form-control select2']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idUser'))
                    <p>{{ $errors->first('idUser') }}</p>
                    @endif
                </strong>
            </span>
            
        </div>
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idDistrict',$districts,isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control']) !!}
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
            {!! Form::label('SubDivision', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idSubdivision"  class="form-control select2" id="idSubdivision">
                </select>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idSubdivision'))
                    <p>{{ $errors->first('idSubdivision') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="form-group">
            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idBlock"  id="idBlock" class="form-control select2">
                </select>
            </div>
             <span class="help-block">
                <strong>
                    @if($errors->has('idBlock'))
                    <p>{{ $errors->first('idBlock') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="form-group">
            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idVillages[]"  id="idVillage" class="form-control " multiple="multiple" >
                </select>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idVillage'))
                    <p>{{ $errors->first('idVillage') }}</p>
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
        
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idDesignation"  id="idDesignation" class="form-control">
                </select>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idDesignation'))
                    <p>{{ $errors->first('idDesignation') }}</p>
                    @endif
                </strong>
            </span>
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger" name="existing">Save</button>
        {!! Form::close() !!}
    </div>
</div>
    
<!-------------------New User---------------------------------------------------------------------->
<div class="panel panel-default tab-pane fade in active" id='new'>
    <div class="panel-heading"><strong>Add User</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'uservillage','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                 {!! Form::select('idDistrict',$districts, isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control select2','id'=>'idDistrict']) !!}
               
                <!--{!! Form::select('idDistrict',$districts,isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control select2']) !!}-->
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
            {!! Form::label('SubDivision', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idSubdivision"  id="idSubdivision" class="form-control">
                </select>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idSubdivision'))
                    <p>{{ $errors->first('idSubdivision') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="form-group">
            {!! Form::label('Block', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idBlock"  id="idBlock" class="form-control select2">
                </select>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idBlock'))
                    <p>{{ $errors->first('idBlock') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="form-group">
            {!! Form::label('Village', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idVillages[]"  id="idVillage" class="form-control select2" multiple="multiple" >
                </select>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idVillage'))
                    <p>{{ $errors->first('idVillage') }}</p>
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
        
        <div class="form-group">
            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                <select name = "idDesignation"  id="idDesignation" class="form-control">
                </select>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idDesignation'))
                    <p>{{ $errors->first('idDesignation') }}</p>
                    @endif
                </strong>
            </span>
        </div>
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
        <button type="submit" class="btn btn-danger">Save</button>
        {!! Form::close() !!}
    </div>
</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Users</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>User</th>
                    <th>District</th>
                    <th>Subdivision</th>
                    <th>Block</th>
                    <th>Village</th>
                    <th>Section</th>
                    <th>Designation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user_list as $user)
                <tr>
                    <td>{{ $user->userName}}</td>
                    <td>{{ $user->districtName}}</td>
                    <td>{{ $user->subDivisionName}}</td>
                    <td>{{ $user->blockName}}</td>
                    <td>{{ $user->villageName}}</td>
                    <td>{{ $user->sectionName}}</td>
                    <td>{{ $user->designationName}}</td>
                    <td></td>
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
    $('select[id="idDistrict"]').on('change', function(e) {
            var districtID = $(this).val();
            console.log(districtID.length);
            if(districtID.length > 0) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/district') }}"+'/' +districtID + "/subdivisions",
                // data: districtID,
                    dataType: 'json',
                    success:function(data) {
                        $('select[id="idSubdivision"]').empty();
                        $('select[id="idSubdivision"]').append('<option value="">Select Subdivision</option>');
                        $.each(data, function(key, value) {
                            $('select[id="idSubdivision"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[id="idSubdivision"]').empty();
            }
    });
    $('select[id="idSubdivision"]').on('change', function(e) {
           var subdivisionID = $(this).val();
           if(subdivisionID.length > 0) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/usersubdivision') }}"+'/' +subdivisionID + "/blocks",
                    dataType: 'json',
                    success:function(data) {
                        $('select[id="idBlock"]').empty();
                        $('select[id="idBlock"]').append('<option value="">Select Block</option>');
                        $.each(data, function(key, value) {
                            $('select[id="idBlock"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[id="idBlock"]').empty();
            }
    });
    
    $('select[id="idBlock"]').on('change', function() {
        var blockID = $(this).val();
            if(blockID.length > 0) {
                $.ajax({
                    url: "{{url('/userblock') }}"+'/' +blockID + "/villages",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="idVillage"]').empty();
                        $.each(data, function(key, value) {
                            $('select[id="idVillage"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[id="idVillage"]').empty();
            }
    });
    
    $('select[name="idSection"]').on('change', function() {
        var sectionID = $(this).val();
        if(sectionID) {
            $.ajax({
                url: "{{url('/uservillage') }}"+'/' +sectionID + "/designations",
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
                url: "{{url('/usersubdivision') }}"+'/' +cur_section + "/designations",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="idDesignation"]').empty();
                    $.each(data, function(key, value) {
                        $('select[id="idDesignation"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
         }
    });
</script>
@stop