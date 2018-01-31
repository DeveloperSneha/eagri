@extends('authority.subdivisions.subdivision_layout')
@section('content')

<div id="formerrors"></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Scheme Distribution (Block)</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'authority/subdivisions/blockdist','class'=>'form-horizontal','id'=>'blockdistribution']) !!}
        <div class="form-group">
            {!! Form::label('Section', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
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
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <select name="idScheme"  class="form-control select2" id="idScheme">--- Select Scheme ---</select>
                <span class="help-block">
                    <strong>
                        @if($errors->has('idScheme'))
                        <p>{{ $errors->first('idScheme') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Program', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                <select name="idSchemeActivation"  class="form-control" id='idProgram'>--- Select Program ---</select>
                <span class="help-block">
                    <strong>
                        @if($errors->has('idSchemeActivation'))
                        <p>{{ $errors->first('idSchemeActivation') }}</p>
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-4">
                {!! Form::select('idDistrict',$user_district,null, ['class' => 'form-control', 'selected']) !!}
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
               {!! Form::select('idSubdivision',$user_subdivision,null, ['class' => 'form-control','id'=>'idSubdivision']) !!}
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
            <div id="area-fund" class="col-sm-12">

            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Apply to All', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2 checkbox-inline">
                <input type='checkbox' class='select-all'/>
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('block'))
                    <p>{{ $errors->first('block') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="col-sm-8 col-sm-offset-2 ">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Block</th>
                        <th></th>
                        <th>Physical Target</th>
                        <th>Financial Target</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blocks as $key=>$value)
                    <tr>
                        <td><strong>{{ $value }} </strong>
                        <span id='errorblock{{$key}}' class="help-block"></span>
                        </td>
                        <td>
                            <input type="checkbox" value="{{ $key}}" name="blocks[{{$key}}][idBlock]" id='block' class="count_dist">                            
                        </td>
                        <td>
                            <input type="text" class="form-control" name="blocks[{{$key}}][areaBlock]"  id="areablock{{$key}}" onchange="getArea({{$key}})" onkeypress="return isNumberKey(event)" minlength="1" maxlength="12">
                            <span id='errorarea{{$key}}' class="help-block"></span>
                            <input type="hidden" id="hiddenarea{{$key}}">
                        </td>
                        <td>
                            <input type="text" class="form-control " name="blocks[{{$key}}][amountBlock]" id="amtblock{{$key}}" onkeypress="return isNumberKey(event)" minlength="1" maxlength="12" onkeydown="return false;">
                            <span id='erroramt{{$key}}' class="help-block"></span><input type="hidden" id="hiddenamount{{$key}}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>
    <div class="panel-footer">
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
        <button type="submit" class="btn btn-danger">Save</button>
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Block wise Distribution Listing</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Section</th>
                    <th>Scheme</th>
                    <th>Program</th>
                    <th>District</th>
                    <th>Subdivision</th>
                    <th>Block</th>
                    <th>Financial Target</th>
                    <th>Physical Target</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                 <?php $i=1;?>
                @foreach($schblock as $var)
                <tr>
                    <td>{{ $i}}</td>
                    <td>{{ $var->schactivation->scheme->section->sectionName}}</td>
                    <td>{{ $var->schactivation->scheme->schemeName}}</td>
                    <td>{{ $var->schactivation->program->programName}}</td>
                    <td>{{ $var->district->districtName }}</td>
                    <td>{{ $var->subdivision->subDivisionName }}</td>
                    <td>{{ $var->block->blockName }}</td>
                    <td>{{ $var->amountBlock }}</td>
                    <td>{{ $var->areaBlock }}</td>
                    <td></td>
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
    $('select[name="idSection"]').on('change', function() {
            var sectionID = $(this).val();
            if(sectionID) {
                $.ajax({
                    url: "{{url('/authority/districts/schsubdist') }}"+'/' +sectionID + "/schemes",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="idScheme"]').empty();
                        $('select[name="idScheme"]').append('<option val>---Select Scheme--</option>');
                        $.each(data, function(key, value) {
                            $('select[name="idScheme"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="idScheme"]').empty();
            }
    });
    $('select[name="idScheme"]').on('change', function() {
        var schemeID = $(this).val();
        if(schemeID) {
            $.ajax({
                url: "{{url('/authority/districts/schblockdist') }}"+'/' +schemeID + "/programs",
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('select[id="idProgram"]').empty();
                    $('select[id="idProgram"]').append('<option val>---Select Program--</option>');
                    $.each(data, function(key, value) {
                        $('select[id="idProgram"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                    
                }
            });
        }else{
            $('select[name="idProgram"]').empty();
        }
    });
   $('select[name="idSchemeActivation"]').on('change', function() {
        var schemeActivationID = $(this).val();
        if(schemeActivationID) {
            $.ajax({
                url: "{{url('/authority/subdivisions/blockdist') }}"+'/' +schemeActivationID + '/funddetails',
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#area-fund').empty();
                    $.each(data, function(key, value) {
                       $('#area-fund').append('<div id ="aaaaa"><label class="col-sm-2 control-label">'+ key +'</label><div class="col-sm-2"><input type="text" value="'+ value +'" readonly></div></div>');
                    });
                    $('#selectall').prop('checked', false);
                    var checkAll = this.checked;
                    $('input[type=checkbox]').each(function () {
                        this.checked = checkAll;
                        var area ='#areablock'+ this.value;
                        var amt = '#amtblock'+ this.value;
                        var hiddenarea = '#hiddenarea'+this.value;
                        var hiddenamount = '#hiddenamount'+this.value;
                            $(area).val('');
                            $(amt).val('');
                            $(hiddenarea).val('');
                            $(hiddenamount).val('');
                    });
                }
            });
        }else{
            $('#area-fund').empty();
        }
    });
    
$(document).ready(function () {
    $('.select-all').on('click', function () {
        var checkAll = this.checked;
        var totalCount = $('.count_dist').length;
        var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());
        var ta = parseFloat($("#area-fund #aaaaa:nth-child(2) input").val());
        var assistance = parseFloat($("#area-fund #aaaaa:last-child input").val());
        if(checkAll === true){
            $('input[type=checkbox]').each(function () {

                this.checked = checkAll;
                var area ='#areablock'+ this.value;
                var amt = '#amtblock'+ this.value;
                var hiddenarea = '#hiddenarea'+this.value;
                var hiddenamount = '#hiddenamount'+this.value;

                $(area).val((parseFloat(ta)/parseFloat(totalCount)).toFixed(0));
                $(amt).val((((parseFloat(ta)/parseFloat(totalCount)).toFixed(0))* parseFloat(assistance)).toFixed(0));
                $(hiddenarea).val((parseFloat(ta)/parseFloat(totalCount)).toFixed(0));
                $(hiddenamount).val((((parseFloat(ta)/parseFloat(totalCount)).toFixed(0))* parseFloat(assistance)).toFixed(0));
            });
            $("#area-fund #aaaaa:first-child input").val(parseFloat(tf) - (((((parseFloat(ta)/parseFloat(totalCount)).toFixed(0))* parseFloat(assistance)).toFixed(0))*parseFloat(totalCount)));
            $("#area-fund #aaaaa:nth-child(2) input").val(parseFloat(ta) - ((parseFloat(ta)/parseFloat(totalCount)).toFixed(0)* parseFloat(totalCount)));
        }else{
            $('input[type=checkbox]').each(function () {
                this.checked = checkAll;
                var area ='#areablock'+ this.value;
                var amt = '#amtblock'+ this.value;
                var hiddenarea = '#hiddenarea'+this.value;
                var hiddenamount = '#hiddenamount'+this.value;
                    $(area).val('');
                    $(amt).val('');
                    $(hiddenarea).val('');
                    $(hiddenamount).val('');
            });
            var cur_program = $( "#idProgram option:selected" ).val();
            if(cur_program) {
                $.ajax({
                    url: "{{url('/authority/subdivisions/blockdist') }}"+'/' +cur_program + '/funddetails',
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#area-fund').empty();
                        $.each(data, function(key, value) {
                           $('#area-fund').append('<div id ="aaaaa"><label class="col-sm-2 control-label">'
                                   + key +'</label><div class="col-sm-2">\n\
                                <input type="text" value="'+ value +'" readonly ><input type="hidden" name="'+key+'" value="'+ value +'">\n\
                                </div></div>');
                        });
                    }
                });
            }
        }
        if($("#area-fund #aaaaa:first-child input").val() <0){
           var errors = 'Financial Target Of This Block Exceeded the limit';
            errorHtml='<div class="alert alert-danger"><ul>';
                            errorHtml += '<li>' + errors + '</li>';
                            errorHtml += '</ul></div>';
                          $( '#formerrors' ).html( errorHtml );
        }else if($("#area-fund #aaaaa:nth-child(2) input").val() <=0){
            var errors = 'Physical Target Of This Block Exceeded the limit';
            errorHtml='<div class="alert alert-danger"><ul>';
                            errorHtml += '<li>' + errors + '</li>';
                            errorHtml += '</ul></div>';
                          $( '#formerrors' ).html( errorHtml );
        }else{
            var errors = '';
            errorHtml ='';
            $( '#formerrors' ).html( errorHtml );
        }
    });

    
    $('#blockdistribution').on('submit', function (e) {
    $.ajaxSetup({
    header: $('meta[name="_token"]').attr('content')
    })

    var formData = $(this).serialize();
        $.ajax({
        type: "POST",
                url: "{{url('/authority/districts/schblockdist') }}",
                data: formData,
                dataType: 'json',
                success: function (data) {
                if (data[Object.keys(data)[0]] === 'SUCCESS') {//True Case i.e. passed validation
                window.location = "{{url('authority/districts/schblockdist')}}";
                } else {					//False Case: With error msg
                        $("#msg").html(data); //$msg is the id of empty msg
                    }
                },
                error: function(data){
                       // e.preventDefault(e);
                        if( data.status === 422 ) {
                            var errors = data.responseJSON.errors;
                            errorHtml='<div class="alert alert-danger"><ul>';
                            $.each( errors, function( key, value ) {
                                 if (key.split(".")[1] + '.amountBlock'==key.split(".")[1] + '.' +key.split(".")[2])
                                 {
                                    erroramt = '<p>' + value + '</p>';
                                    $( '#erroramt'+key.split(".")[1] ).html( erroramt );
                                 }
                                 else if(key.split(".")[1] + '.areaBlock'==key.split(".")[1] + '.' +key.split(".")[2])
                                 {
                                     erroraa = '<p>' + value + '</p>';
                                     $( '#errorarea'+key.split(".")[1] ).html( erroraa );
                                 }else if(key.split(".")[1] + '.idBlock'==key.split(".")[1] + '.' +key.split(".")[2])
                                 {
                                     errordist = '<p>' + value + '</p>';
                                     $( '#errorblock'+key.split(".")[1] ).html( errordist );
                                 }
                                 else{
                                     errorHtml += '<li>' + value + '</li>';
                                 }
                            });
                                errorHtml += '</ul></div>';
                                $( '#formerrors' ).html( errorHtml );
                     }
                     
                }
        });
    return false;
    //e.preventDefault(e);
    });
});

function getArea($key){
        var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());
        var ta = parseFloat($("#area-fund #aaaaa:nth-child(2) input").val());
        var area ='#areablock'+ $key;
        var amt = '#amtblock'+ $key;
        var hiddenarea = '#hiddenarea'+$key;
        var hiddenamount = '#hiddenamount'+$key;

  if( $('#selectall').prop('checked')){
      if($(area).val()<0){
             $(area).css('border-color', 'red');
              $(area).tooltip();
              $(area).attr('title', 'Negative Value Not Allowed !!');
            // alert('Negative Value Not Allowed !!');
            return;
        }
        
        var amount = $("#area-fund #aaaaa:last-child input").val() * $(area).val();
                     $(amt).val(amount);
        
        var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());
        var total_fund = parseFloat(tf) + parseFloat($(hiddenamount).val()) ;
            total_fund = parseFloat(total_fund) - amount;

            $("#area-fund #aaaaa:first-child input").val(total_fund);
            var hiddenamount =  $(hiddenamount).val(amount);
            if(total_fund <0){
               var errors = 'Financial Target Of This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
        var ta = parseFloat($("#area-fund #aaaaa:nth-child(2) input").val());
        var total_area = parseFloat(ta) + parseFloat($(hiddenarea).val()) ;
            total_area = parseFloat(total_area) - $(area).val();

            $("#area-fund #aaaaa:nth-child(2) input").val(total_area);
          var hiddenarea =  $(hiddenarea).val($(area).val());
          if(total_area <0){
                var errors = 'Physical Target OF This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
  
  }else{
      if($(area).val()<0){
             $(area).css('border-color', 'red');
              $(area).tooltip();
              $(area).attr('title', 'Negative Value Not Allowed !!');
            // alert('Negative Value Not Allowed !!');
            return;
        }
        var amount = $("#area-fund #aaaaa:last-child input").val() * $(area).val();
                     $(amt).val(amount);

        var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());

        if($(hiddenamount).val()==""){

            var total_fund = tf +  $(hiddenamount).val();
                total_fund = parseFloat(total_fund) - amount;
            $("#area-fund #aaaaa:first-child input").val(total_fund);
            var hiddenamount =  $(hiddenamount).val(amount);
            if(total_fund <0){
                $(area).css('border-color', 'red');
                $("#area-fund #aaaaa:first-child input").css('border-color', 'red');
                var errors = 'Financial Target Of This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );


            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
       }else{
            var total_fund = parseFloat(tf) + parseFloat($(hiddenamount).val()) ;
            total_fund = parseFloat(total_fund) - amount;

            $("#area-fund #aaaaa:first-child input").val(total_fund);
            var hiddenamount =  $(hiddenamount).val(amount);
            if(total_fund <0){
               var errors = 'Financial Target Of This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
       }




       if($(hiddenarea).val()==""){

            var total_area = ta +  $(hiddenarea).val();
                total_area = parseFloat(total_area) - $(area).val();
            $("#area-fund #aaaaa:nth-child(2) input").val(total_area);
            var hiddenarea =  $(hiddenarea).val($(area).val());
            if(total_area <0){
                var errors = 'Physical Target OF This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
       }else{
            var total_area = parseFloat(ta) + parseFloat($(hiddenarea).val()) ;
            total_area = parseFloat(total_area) - $(area).val();

            $("#area-fund #aaaaa:nth-child(2) input").val(total_area);
          var hiddenarea =  $(hiddenarea).val($(area).val());
          if(total_area <0){
                var errors = 'Physical Target OF This Block Exceeded the limit';
                errorHtml='<div class="alert alert-danger"><ul>';
                                errorHtml += '<li>' + errors + '</li>';
                                errorHtml += '</ul></div>';
                              $( '#formerrors' ).html( errorHtml );
            }else{
                var errors = '';
                errorHtml ='';
                $( '#formerrors' ).html( errorHtml );
            }
       }
   }
}
</script>
@stop