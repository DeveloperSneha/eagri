@extends('authority.districts.district_layout')
@section('content')
<a href="{{url('authority/districts/addblockuser/create')}}" class="btn btn-success" style="margin-bottom: 20px;">Add Existing</a>   
<!-------------------New User---------------------------------------------------------------------->
<div id='formerrors'></div>
<div class="panel panel-default tab-pane fade in active" id='new'>
    <div class="panel-heading"><strong>ADD   User In Block</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'authority/districts/addblockuser','class'=>'form-horizontal','id'=>'userblock']) !!}
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idDistrict',$user_district,null, ['class' => 'form-control', 'selected']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('SubDivision', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idSubdivision',$subdivisions,null, ['class' => 'form-control','id'=>'idSubdivision']) !!}
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
                <select name = "idBlocks[]"  id="idBlock" class="form-control select2" multiple="multiple" data-width="100%" >
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
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idSection',$sections, null, ['class' => 'form-control','id'=>'section']) !!}
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
                {!! Form::text('userName', null, ['class' => 'form-control','maxlength'=>'50','minlength'=>'2','onkeypress'=>'return onlylettersandSpecialChar(event)']) !!}
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
<div class="panel panel-default">
    <div class="panel-heading"><strong>Users</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
                @foreach($user_list as $var)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $var->userName}}</td>
                    <td> <a href='{{url('/authority/districts/addblockuser/'.$var->idUser.'/details')}}' class="btn btn-xs btn-warning">Edit</a>
                        
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
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
    var cur_sub = $( "#idSubdivision option:selected" ).val();
        if(cur_sub){
            $.ajax({
                url: "{{url('/authority/districts/distsub') }}"+'/' +cur_sub + "/blocks",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="idBlock"]').empty();
                    $.each(data, function(key, value) {
                        $('select[id="idBlock"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
         } 
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
    var cur_section = $( "#section option:selected" ).val();
        if(cur_section){
            $.ajax({
                url: "{{url('/authority/districts/distblockuser') }}"+'/' +cur_section + "/designations",
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