@extends('authority.districts.district_layout')
@section('content')
<!-------------------Existing User---------------------------------------------------------------------->
<div id='formerrors'></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Add Existing User</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'authority/districts/addblockuser','class'=>'form-horizontal','id'=>'userblock']) !!}
        <div class="row">
            <div class="col-sm-6">
                 <input type="hidden" name="existing">
                <div class="form-group">
                    {!! Form::label('User', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('idUser',$users,null, ['class' => 'form-control select2','id'=>'idUser']) !!}
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idUser'))
                                <p>{{ $errors->first('idUser') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('District', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('idDistrict',$user_district,null, ['class' => 'form-control', 'selected']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('SubDivision', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('idSubdivision',$subdivisions,null, ['class' => 'form-control','id'=>'idSubdivision']) !!}
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idSubdivision'))
                                <p>{{ $errors->first('idSubdivision') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Block', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        <select name = "idBlocks[]"  id="idBlock" class="form-control select2" multiple="multiple" >
                        </select>
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idBlock'))
                                <p>{{ $errors->first('idBlock') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Section', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('idSection',$sections, null, ['class' => 'form-control','id'=>'section']) !!}
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idSection'))
                                <p>{{ $errors->first('idSection') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Designation', null, ['class' => 'col-sm-4 control-label required']) !!}
                    <div class="col-sm-8">
                        <select name = "idDesignation"  id="idDesignation" class="form-control">
                        </select>
                        <span class="help-block">
                            <strong>
                                @if($errors->has('idDesignation'))
                                <p>{{ $errors->first('idDesignation') }}</p>
                                @endif
                            </strong>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="userdet">

                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-danger" name="existing">Save</button>
        {!! Form::close() !!}
    </div>
</div>
@stop
@section('script')
<script>
    $('select[id="idSubdivision"]').on('change', function(e) {
           var subdivisionID = $(this).val();
           if(subdivisionID.length > 0) {
                $.ajax({
                    type: "GET",
                    url: "{{url('/authority/districts/distsub') }}"+'/' +subdivisionID + "/blocks",
                    dataType: 'json',
                    success:function(data) {
                        $('select[id="idBlock"]').empty();
                       // $('select[id="idBlock"]').append('<option value="">Select Block</option>');
                        $.each(data, function(key, value) {
                            $('select[id="idBlock"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[id="idBlock"]').empty();
            }
    });
    $('select[name="idSection"]').on('change', function() {
        var sectionID = $(this).val();
        if(sectionID) {
            $.ajax({
                url: "{{url('/authority/districts/distblockuser') }}"+'/' +sectionID + "/designations",
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
    $('select[name="idUser"]').on('change', function() {
            var userID = $(this).val();
            if(userID) {
                $.ajax({
                    url: "{{url('/authority/districts/distuser') }}"+'/' +userID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                         $('#userdet').empty();
                            $.each(data, function(key, value) {
                            if(value['villageName']===null && value['blockName']===null && value['subDivisionName']===null){
                                $('#userdet').append('<div class="col-sm-12"><p class="form-control-static"><strong>District - </strong> '+value['districtName']+',  <strong>Section -</strong>'+value['sectionName']+',  <strong>Designation -</strong>'+value['designationName']+'</p></div>');
                            }else if(value['villageName']===null && value['blockName']===null){
                                $('#userdet').append('<div class="col-sm-12"><p class="form-control-static"><strong> Subdivision - </strong>'+value['subDivisionName']+',  <strong>Section -</strong>'+value['sectionName']+', <strong>Designation -</strong>'+value['designationName']+'</p></div>');
                            }else if(value['villageName']===null){
                                $('#userdet').append('<div class="col-sm-12"><p class="form-control-static"><strong> Block - </strong>'+value['blockName']+' ,  <strong>Section -</strong>'+value['sectionName']+', <strong>Designation -</strong>'+value['designationName']+'</p></div>');
                            }else{
                                $('#userdet').append('<div class="col-sm-12"><p class="form-control-static"><strong> Village - </strong>'+value['villageName']+' ,  <strong>Section -</strong>'+value['sectionName']+', <strong>Designation -</strong>'+value['designationName']+'</p></div>');
                            }
//                            $.each(value, function(key1, value1) {
//                                $('#userdet').append('<label class="col-sm-4 control-label">'+ key1 +'</label><div class="col-sm-8"><p class="form-control-static">'+value1+'</p></div>');
//                            });
                        });


                    }
                });
            }
        });
    $('#userblock').on('submit',function(e){
        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
    });
    var formData = $(this).serialize();
        $.ajax({
            type:"POST",
            url: "{{url('/authority/districts/addblockuser/') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
                if( data[Object.keys(data)[0]] === 'SUCCESS' ){		//True Case i.e. passed validation
                window.location = "{{url('authority/districts/addblockuser')}}";
                }
                else {					//False Case: With error msg
                $("#msg").html(data);	//$msg is the id of empty msg
                }

            },

            error: function(data){
                       // e.preventDefault(e);
                        if( data.status === 422 ) {
                            var errors = data.responseJSON.errors;
                            $.each( errors, function( key, value ) {                                
                               var errors = data.responseJSON.errors;
                            var errorHtml = '<div class="alert alert-danger"><ul>';
                            $.each( errors, function( key, value ) {    
                               errorHtml += '<li>' + value + '</li>'; 
                            });
                            errorHtml += '</ul></div>';
                             $('#formerrors').html(errorHtml);
                            });
                           
                     }
                }
        });
        return false;
    });
</script>
@stop