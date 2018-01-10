<?php
$user_desig = $user->userdesig()->with('designation')
                ->whereNotNull('idDesignation')
                ->get()->pluck('designation.designationName', 'designation.idDesignation')->unique();
?>
<!DOCTYPE html>
<html>
    @include('layouts.partials.head')
    <div class="">
        <div class="register-logo">
            <a href="{{url('/')}}"><img src="{{asset('dist/img/DOAH.png')}}" height="100" width="160"></a>
        </div>

        <div class="register-box-body">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Select Your Designation And Related Districts</strong>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ route('authority.secondlogin') }}">
                        {{ csrf_field() }}
                        <div class="panel-body">
                        <input type="hidden" name='userName' value="{{$user->userName}}">
                        <input type="hidden" name='password' value="{{$user->password}}">
                        <div class="form-group">
                            {!! Form::label('Designation', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4">
                                {!! Form::select('idDesignation',[''=>'Select']+$user_desig->toArray(),null, ['class' => 'form-control select2','id'=>'idDesignation']) !!}
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
                            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
                            <div class="col-sm-4">
                                <select name = "idDistrict"  id="idDistrict" class="form-control">
                                </select>
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
                            {!! Form::label('Subdivision', null, ['class' => 'col-sm-2 control-label required']) !!}
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
                                <select name = "idBlock"  id="idBlock" class="form-control">
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
                            <div class="col-sm-offset-4 col-sm-4">
                                <button class="btn btn-block btn-success" type="submit">Go To Your Dashboard</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@include('layouts.partials.script')
<script>
 $('select[name="idDesignation"]').on('change', function() {
        var designationID = $(this).val();
        if(designationID) {
            $.ajax({
                url: "{{url('/user/'. $user->idUser) }}" + '/' + designationID + "/details",
                type: "GET",
                dataType: "json",
                success:function(data) {
                        $('select[id="idDistrict"]').empty();
                        $('select[id="idSubdivision"]').empty();
                        $('select[id="idBlock"]').empty();
                        $('select[id="idDistrict"]').append('<option value="">--Select--</option>');
                    $.each(data, function(key, value) {
                       $('select[id="idDistrict"]').append('<option value="'+ value['idDistrict'] +'" >'+ value['districtName'] +'</option>');
                    });
                }
            });
        }else{
            $('select[id="idDistrict"]').empty();
            $('select[id="idSubdivision"]').empty();
            $('select[id="idBlock"]').empty();
        }
    });
     $('select[name="idDistrict"]').on('change', function() {
        var designationID = $( "#idDesignation option:selected" ).val();
        var districtID = $(this).val();
        if(districtID) {
            $.ajax({
                url: "{{url('/user/'. $user->idUser) }}" + '/'+ designationID +'/' + districtID + "/subdivision",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="idSubdivision"]').empty();
                    $('select[id="idBlock"]').empty();
                    $('select[id="idSubdivision"]').append('<option value="">--Select--</option>');
                    $.each(data, function(key, value) {
                         $('select[id="idSubdivision"]').append('<option value="'+ value['idSubdivision'] +'" >'+ value['subDivisionName'] +'</option>');
                    });
                    

                }
            });
        }else{
            $('select[id="idSubdivision"]').empty();
        }
    });
    $('select[name="idSubdivision"]').on('change', function() {
        var designationID = $( "#idDesignation option:selected" ).val();
        var subdivisionID = $(this).val();
        if(subdivisionID) {
            $.ajax({
                url: "{{url('/user/'. $user->idUser) }}" + '/' + designationID +'/' + subdivisionID + "/block",
                type: "GET",
                dataType: "json",
                success:function(data) {
                     $('select[id="idBlock"]').empty();
                     $('select[id="idBlock"]').append('<option value="">--Select--</option>');
                     $.each(data, function(key, value) {
                       $('select[id="idBlock"]').append('<option value="'+ value['idBlock'] +'" >'+ value['blockName'] +'</option>');
                  });
                    

                }
            });
        }else{
            $('select[id="idBlock"]').empty();
        }
    });
</script>
</body>
</html>
