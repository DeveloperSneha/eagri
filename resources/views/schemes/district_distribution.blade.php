@extends('layouts.app')
@section('content')
<div id="formerrors"></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Scheme Distribution (District)</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'districtdistribution','class'=>'form-horizontal','id'=>'districtdistribution']) !!}
        
        <div class="form-group">
            {!! Form::label('Available Scheme', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::select('idSchemeActivation',$schact, null, ['class' => 'form-control select2']) !!}
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
            <div id="area-fund" class="col-sm-12">
                
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Apply to All District', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-2 checkbox-inline">
                <input type="checkbox" class="select-all"/>
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
                        <th>District</th>
                        <th></th>
                        <th>Physical Target</th>
                        <th>Financial Target</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($districts as $key=>$value)
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
    <div class="panel-heading"><strong>District wise Distribution Listing</strong></div>
    <div class="panel-body">
        <table class="table table-bordered"  id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Scheme</th>
                    <th>Districts</th>
                    <th>Amount Allocated to District</th>
                    <th>Area District</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schdistrict as $var)
                <tr>
                    <td>{{ $var->idSchemDistributionDistrict }}</td>
                    <td>{{ $var->schactivation->scheme->schemeName}}</td>
                    <td>{{ $var->district->districtName }}</td>
                    <td>{{ $var->amountDistrict }}</td>
                    <td>{{ $var->areaDistrict }}</td>
                    <td>
                        {{ Form::open(['route' => ['districtdistribution.destroy', $var->idSchemDistributionDistrict], 'method' => 'delete']) }}
                        <a href='{{url('/districtdistribution/'.$var->idSchemDistributionDistrict.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
            $('input[type=checkbox]').each(function () {
                this.checked = checkAll;
            });
        });
        $('select[name="idSchemeActivation"]').on('change', function() {
            var schemeActivationID = $(this).val();
            if(schemeActivationID) {
                $.ajax({
                    url: "{{url('/schemeactivations') }}"+'/' +schemeActivationID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#area-fund').empty();
                        $.each(data, function(key, value) {
                           $('#area-fund').append('<div id ="aaaaa"><label class="col-sm-2 control-label">'+ key +'</label><div class="col-sm-2"><input type="text" value="'+ value +'" readonly></div></div>');
                        });
                    }
                });
            }else{
                $('#area-fund').empty();
            }
        });
    $('#districtdistribution').on('submit',function(e){
        $.ajaxSetup({
        header:$('meta[name="_token"]').attr('content')
    });
        
    var formData = $(this).serialize();
        $.ajax({
            type:"POST",
            url: "{{url('/districtdistribution/') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
                if( data[Object.keys(data)[0]] === 'SUCCESS' ){		//True Case i.e. passed validation
                window.location = "{{url('districtdistribution')}}";
                }
                else {					//False Case: With error msg
                $("#msg").html(data);	//$msg is the id of empty msg
                }

            },
            error: function(data){
                       // e.preventDefault(e);
                        if( data.status === 422 ) {
                           
                          var errors = data.responseJSON.errors;
                          errorHtml='<div class="alert alert-danger"><ul>';
                          $.each( errors, function( key, value ) {
                               errorHtml += '<li>' + value + '</li>';
                         });
                          errorHtml += '</ul></div>';
                          $( '#formerrors' ).html( errorHtml );

                    }
                }
        });
        return false;
    });

});
function getArea($key){
    var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());
    var area ='#areadistrict'+ $key;
    var amt = '#amtdistrict'+ $key;
     //$(amt).val($("#area-fund #aaaaa:last-child p").text() * $(area).val()); 
    var amount = $("#area-fund #aaaaa:last-child input").val() * $(area).val();
                 $(amt).val(amount);
   // var tf = parseFloat($("#area-fund #aaaaa:first-child input").val());
   // var total_fund = tf - amount;
    document.getElementById('area-fund #aaaaa:first-child input').value = tf - amount;
  //  console.log(total_fund);
   // $("#area-fund #aaaaa:first-child input").val(total_fund);
  
}
</script>
@stop