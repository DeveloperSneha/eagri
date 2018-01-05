@extends('layouts.app')
@section('content')
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#new">New</a></li>
    <li><a data-toggle="tab" href="#existing">Existing</a></li>
</ul>
<div class="tab-content">
    
<!-------------------Existing User---------------------------------------------------------------------->
<div class="panel panel-default tab-pane fade" id='existing'>
    <div class="panel-heading"><strong>Add User</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'userdistrict','class'=>'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('User', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idUser',$users,null, ['class' => 'form-control','id'=>'idUser']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idUser'))
                    <p>{{ $errors->first('idUser') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div id="userdet" class="col-sm-12">
                
        </div>
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                 {!! Form::select('idDistricts[]',$districts, isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control select2','multiple'=>'multiple','id'=>'idDistrict']) !!}
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
    <div class="panel-heading"><strong>@if(isset($user)) UPDATE @else ADD @endif  User In District</strong></div>
    @if(isset($user))
    {{ Form::model( $user, ['route' => ['userdistrict.update', $user->idUser], 'method' => 'patch','class'=>'form-horizontal'] ) }}
    @else
    {!! Form::open(['url' => 'userdistrict','class'=>'form-horizontal']) !!}
    @endif  
    <div class="panel-body">
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                 {!! Form::select('idDistricts[]',$districts, isset($user) ? $user->userdesig->pluck('idDistrict')->toArray(): null, ['class' => 'form-control select2','multiple'=>'multiple','id'=>'idDistrict']) !!}
               
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
          <button type="submit" class="btn btn-danger">@if(isset($user)) Update @else Save @endif</button>
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
                    <td>{{ $user->sectionName}}</td>
                    <td>{{ $user->designationName}}</td>
                    <td>
                        {{ Form::open(['route' => ['userdistrict.destroy', $user->idUser], 'method' => 'delete']) }}
                        <a href='{{url('/userdistrict/'.$user->idUser.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
$(document).ready(function () {
    $('select[name="idSection"]').on('change', function() {
        var sectionID = $(this).val();
        if(sectionID) {
            $.ajax({
                url: "{{url('/userdistrict') }}"+'/' +sectionID + "/designations",
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
                url: "{{url('/userdistrict') }}"+'/' +cur_section + "/designations",
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
        $('select[name="idUser"]').on('change', function() {
            var userID = $(this).val();
            if(userID) {
                $.ajax({
                    url: "{{url('/userdistrict') }}"+'/' +userID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       $('#userdet').empty();
                        $.each(data, function(key, value) {
                           $('#userdet').append('<label class="col-sm-2 control-label">'+ key +'</label><div class="col-sm-10"><p class="form-control-static">'+value+'</p></div>');
                        });

                    }
                });
            }
        });
    });
</script>
@stop