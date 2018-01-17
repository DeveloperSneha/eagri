@extends('authority.districts.district_layout')
@section('content')
<div class="panel panel-default tab-pane fade in active" id='new'>
    <div class="panel-heading"><strong>{{ $userdesig->user->userName }}</strong></div>
    <div class="panel-body">
        {!! Form::model( $userdesig, ['route' => ['addvillageuser.update', $userdesig->iddesgignationdistrictmapping], 'method' => 'patch','class'=>'form-horizontal'] ) !!}
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idDistrict',$user_district,null, ['class' => 'form-control','disabled', 'selected']) !!}
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
                {!! Form::select('idSubdivision',$subdivisions,isset($userdesig)? $userdesig->idSubdivision : null, ['class' => 'form-control','id'=>'idSubdivision','disabled', 'selected']) !!}
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
                <select name = "idBlock"  id="idBlock" class="form-control" disabled="disabled">
                    <option value="{{ $userdesig->idBlock }}" selected="selected" >{{ $userdesig->block->blockName }}</option>
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
                <select name = "idVillage"  id="idVillage" class="form-control select2">
                    <option value="{{ $userdesig->idVillage }}" selected="selected" ></option>
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
                {!! Form::select('idSection',$sections, isset($userdesig) ? $userdesig->designation->section->idSection : null, ['class' => 'form-control','id'=>'section']) !!}
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
          <button type="submit" class="btn btn-danger">Update</button>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
<script>
    var cur_block = $( "#idBlock option:selected" ).val();
        if(cur_block){
            $.ajax({
                url: "{{url('/authority/districts/distblock') }}"+'/' +cur_block + "/villages",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    @if(isset($userdesig))
                        var myPlayList = [];
                        
                                var h = {{$userdesig->idVillage}}; 
                                myPlayList.push(h.toString());
                          
                        $.each(data, function(key, value) {
                            if($.inArray(key,myPlayList) === -1){
                                   $('select[id="idVillage"]').append('<option value="'+ key +'" >'+ value +'</option>');
                                }else{
                                   $('select[id="idVillage"] option:selected').append('<option value="'+ key +'" >'+ value +'</option>');
                                }                            
                            });
                    @endif
                }
            });
         }
    $('select[name="idSection"]').on('change', function() {
        var sectionID = $(this).val();
        if(sectionID) {
            $.ajax({
                url: "{{url('/authority/districts/distvillageuser') }}"+'/' +sectionID + "/designations",
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
                url: "{{url('/authority/districts/distvillageuser') }}"+'/' +cur_section + "/designations",
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
</script>
@stop