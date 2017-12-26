@extends('authority.authority_layout')
@section('content')
<div id="formerrors"></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Scheme Distribution (Block)</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'authority/blockwisescheme','class'=>'form-horizontal','id'=>'blockdistribution']) !!}
        <div class="form-group">
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label',]) !!}
            <div class="col-sm-5">
                {!! Form::select('idSchemeActivation',$schact, null, ['class' => 'form-control ']) !!}
            </div>
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
                    @if($errors->has('district'))
                    <p>{{ $errors->first('district') }}</p>
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
                        <th>Financial Target</th>
                        <th>Physical Target</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sch_blocks as $key=>$value)
                    <tr>
                        <td><strong>{{ $value }} </strong></td>
                        <td>
                            <input type="checkbox" value="{{ $key}}" name="districts[{{$key}}][idDistrict]" id='district' >
                        </td>
                        <td>
                            <input type="text" class="form-control" name="districts[{{$key}}][areaDistrict]"  id="areadistrict{{$key}}" onchange="getArea({{$key}})">
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('districts.*.areaDistrict'))
                                    <p>{{ $errors->first('districts.'.$key.'.areaDistrict')}}</p>
                                    @endif
                                </strong>
                            </span>
                            <input type="hidden" id="hiddenarea{{$key}}">
                        </td>
                        <td>
                            <input type="text" class="form-control " name="districts[{{$key}}][amountDistrict]" id="amtdistrict{{$key}}">
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('districts.*.amountDistrict'))
                                    <p>{{ $errors->first('districts.'.$key.'.amountDistrict')}}</p>
                                    @endif
                                </strong>
                            </span>
                            <input type="hidden" id="hiddenamount{{$key}}">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--        <div class="">
                    {!! Form::label('Scheme Distribution(Blocks)', null, ['class' => 'col-sm-2 control-label']) !!}
                    <div class="col-sm-10 distblock" name='idBlock'></div>
                </div>-->
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
                    <th>ID</th>
                    <th>Scheme</th>
                    <th>Block</th>
                    <th>Financial Target</th>
                    <th>Physical Target</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schblockdist as $var)
                <tr>
                    <td>{{ $var->idSchemDistributionBlock }}</td>
                    <td>{{ $var->schactivation->scheme->schemeName}}</td>
                    <td>{{ $var->block->blockName }}</td>
                    <td>{{ $var->amountBlock }}</td>
                    <td>{{ $var->areaBlock }}</td>
                    <td>
                        {{ Form::open(['route' => ['blockwisescheme.destroy', $var->idSchemDistributionBlock], 'method' => 'delete']) }}
                        <a href='{{url('/authority/blockwisescheme/'.$var->idSchemDistributionBlock.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
        $('.select-all').on('click', function () {
        var checkAll = this.checked;
        var totalCount = $('input:checkbox').length;
        
        var tf = parseFloat($("#area-fund #action:first-child input").val());
        var ta = parseFloat($("#area-fund #action:nth-child(2) input").val());
        
        $('input[type=checkbox]').each(function () {
            
            this.checked = checkAll;
            var area ='#areadistrict'+ this.value;
            var amt = '#amtdistrict'+ this.value;
            $(area).val((parseFloat(ta)/parseFloat(totalCount)).toFixed(0));
            $(amt).val((parseFloat(tf)/parseFloat(totalCount)).toFixed(0));
        });
        $("#area-fund #action:first-child input").val(parseFloat(tf) - ((parseFloat(tf)/parseFloat(totalCount)).toFixed(0)* parseFloat(totalCount)));
//        $("#area-fund #action:first-child(2) input").val(parseFloat(ta) - ((parseFloat(ta)/parseFloat(totalCount)).toFixed(0)* parseFloat(totalCount)));
        
//        if($("#area-fund #action:first-child input").val() <=0){
//           var errors = 'Financial Target Of This District Exceeded the limit';
//            errorHtml='<div class="alert alert-danger"><ul>';
//                            errorHtml += '<li>' + errors + '</li>';
//                            errorHtml += '</ul></div>';
//                          $( '#formerrors' ).html( errorHtml );
//        }else if($("#area-fund #action:first-child(2) input").val() <=0){
//            var errors = 'Physical Target Of This District Exceeded the limit';
//            errorHtml='<div class="alert alert-danger"><ul>';
//                            errorHtml += '<li>' + errors + '</li>';
//                            errorHtml += '</ul></div>';
//                          $( '#formerrors' ).html( errorHtml );
//        }else{
//            var errors = '';
//            errorHtml ='';
//            $( '#formerrors' ).html( errorHtml );
//        }
    });

        $('select[name="idSchemeActivation"]').on('change', function () {

            var schemeActivationID = $(this).val();
            if (schemeActivationID) {
                $.ajax({
                    url: "{{url('/authority/schemedistrict') }}" + '/' + schemeActivationID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#area-fund').empty();
                        $.each(data, function (key, value) {
            $('#area-fund ').append('<div id ="action"><label class="col-sm-2 control-label">' + key + '</label><div class="col-sm-2"><input type="text" value="' + value + '" readonly></div></div>');
            });
            }
    });
    } else {
    $('#area-fund').empty();
    }
    });
    })
            jQuery(document).ready(function ($) {
    $('#blockdistribution').on('submit', function (e) {
    $.ajaxSetup({
    header: $('meta[name="_token"]').attr('content')
    })

            var formData = $(this).serialize();
    $.ajax({
    type: "POST",
            url: "{{url('/authority/blockwisescheme/') }}",
            data: formData,
            dataType: 'json',
            success: function (data) {
            if (data[Object.keys(data)[0]] === 'SUCCESS') {//True Case i.e. passed validation
            window.location = "{{url('authority/blockwisescheme')}}";
            } else {					//False Case: With error msg
            $("#msg").html(data); //$msg is the id of empty msg
            }
            },
            error: function (data) {
            // e.preventDefault(e);
            if (data.status === 422) {

            var errors = data.responseJSON.errors;
            errorHtml = '<div class="alert alert-danger"><ul>';
            $.each(errors, function (key, value) {
            errorHtml += '<li>' + value + '</li>';
            });
            errorHtml += '</ul></div>';
            $('#formerrors').html(errorHtml);
            }
            }
    });
    return false;
    //e.preventDefault(e);
    });
    });
function getArea($key){
    var tf = $("#area-fund #action:first-child input").val();
    var ta = $("#area-fund #action:nth-child(2) input").val();
    var area = '#areadistrict' + $key;
    var amt = '#amtdistrict' + $key;
    var hiddenarea = '#hiddenarea' + $key;
    var hiddenamount = '#hiddenamount' + $key;
    
    var amount = $("#area-fund #action:last-child input").val() * $(area).val();
                 $(amt).val(amount);
    

    if($(hiddenamount).val()==""){
       
        var total_fund = tf +  $(hiddenamount).val();
            total_fund = parseFloat(total_fund) - amount;
        $("#area-fund #action:first-child input").val(total_fund);
        var hiddenamount =  $(hiddenamount).val(amount);
        if(total_fund <= 0){
            var errors = 'Financial Target Of This District Exceeded the Limit';
            errorHtml='<div class="alert alert-danger"><ul>';
                            errorHtml += '<li>' + errors + '</li>';
                            errorHtml += '</ul></div>';
                          $( '#formerrors' ).html( errorHtml );
//                          
        }else{
            var errors = '';
            errorHtml ='';
            $( '#formerrors' ).html( errorHtml );
        }
   }else{
        var total_fund = parseFloat(tf) + parseFloat($(hiddenamount).val()) ;
        total_fund = parseFloat(total_fund) - amount;
           
        $("#area-fund #action:first-child input").val(total_fund);
        var hiddenamount =  $(hiddenamount).val(amount);
        if(total_fund <=0){
           var errors = 'Financial Target Of This District Exceeded the limit';
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
   
   
   
   
//   if($(hiddenarea).val()==""){
//       
//        var total_area = ta +  $(hiddenarea).val();
//            total_area = parseFloat(total_area) - $(area).val();
//        $("#area-fund #action:first-child(2) input").val(total_area);
//        var hiddenarea =  $(hiddenarea).val($(area).val());
//        if(total_area <=0){
//            var errors = 'Physical Target OF This District Exceeded the limit';
//            errorHtml='<div class="alert alert-danger"><ul>';
//                            errorHtml += '<li>' + errors + '</li>';
//                            errorHtml += '</ul></div>';
//                          $( '#formerrors' ).html( errorHtml );
//        }else{
//            var errors = '';
//            errorHtml ='';
//            $( '#formerrors' ).html( errorHtml );
//        }
//   }else{
//        var total_area = parseFloat(ta) + parseFloat($(hiddenarea).val()) ;
//        total_area = parseFloat(total_area) - $(area).val();
//           
//        $("#area-fund #action:first-child(2) input").val(total_area);
//      var hiddenarea =  $(hiddenarea).val($(area).val());
//      alert(hiddenarea);
//      if(total_area <=0){
//            var errors = 'Physical Target OF This District Exceeded the limit';
//            errorHtml='<div class="alert alert-danger"><ul>';
//                            errorHtml += '<li>' + errors + '</li>';
//                            errorHtml += '</ul></div>';
//                          $( '#formerrors' ).html( errorHtml );
//        }else{
//            var errors = '';
//            errorHtml ='';
//            $( '#formerrors' ).html( errorHtml );
//        }
//   }
    }

</script>
@stop