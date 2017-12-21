@extends('layouts.app')
@section('content')
<div id="formerrors"></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Create Village Distribution</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'villagedistribution','class'=>'form-horizontal','id'=>'villagedistribution']) !!}
        <div class="form-group">
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                <select name="idSchemeActivation" class="form-control select2">
                    <option value="">--- Select Scheme ---</option>
                    @foreach ($schact as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Scheme Distribution(Block)', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                <select name="schemeDistributionBlock" class="form-control" ></select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Apply to All', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2 checkbox-inline">
                <input type='checkbox' class='select-all'/></div>
        </div>
        <div class="">
            {!! Form::label('Scheme Distribution(Villages)', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10 blockvillage" name='idVillage'></div>
        </div>
    </div>
    <div class="panel-footer">
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
		<button type="submit" class="btn btn-danger">Save</button>
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Village wise Distribution Listing</strong>
    </div>
    <div class="panel-body">
        <table class="table table-bordered"  id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Scheme</th>
                    <th>Scheme Distribution Block</th>
                    <th>Village</th>
                    <th>Financial Target</th>
                    <th>Physical Target</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schvillage as $var)
                <tr>
                        <td>{{ $var->idSchemDistributionVillage }}</td>
                        <td>{{ $var->schactivation->scheme->schemeName}}</td>
                        <td>{{ $var->block->blockName}}</td>
                        <td>{{ $var->village->villageName}}</td>
                        <td>{{ $var->amountVillage }}</td>
                        <td>{{ $var->areaVillage }}</td>
                        <td>
                            {{ Form::open(['route' => ['villagedistribution.destroy', $var->idSchemDistributionVillage], 'method' => 'delete']) }}
                            <a href='{{url('/villagedistribution/'.$var->idSchemDistributionVillage.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
    $(document).ready(function() {
        $('.select-all').on('click', function() {
            var checkAll = this.checked;
            $('input[type=checkbox]').each(function() {
                this.checked = checkAll;
            });
        });
    });
        $('select[name="idSchemeActivation"]').on('change', function() {
            var schID = $(this).val();
            if(schID) {
                $.ajax({
                    url: "{{url('/schact/') }}"+'/' +schID + "/blocks",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="schemeDistributionBlock"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="schemeDistributionBlock"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="schemeDistributionBlock"]').empty();
            }
        });
        $('select[name="schemeDistributionBlock"]').on('change', function() {
            var schblockID = $(this).val();
            if(schblockID) {
                $.ajax({
                    url: "{{url('/schblock/') }}"+'/' +schblockID + "/villages",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       $('.blockvillage').empty();
                       $.each(data, function(key, value) {
                           
                            var checkbox="<div class='form-group'>\n\
                                                <div class='col-sm-3 checkbox-inline'><input type='checkbox' id='village' value="+key+" name='villages["+key+"][idVillage]'><label for="+value+">"+value+"</label></div>\n\
                                                <div class='col-sm-3'><input type = 'text' name='villages["+key+"][amountVillage]' placeholder = 'Financial Target' class='form-control'></div>\n\
                                                <div class='col-sm-3'><input type = 'text' name='villages["+key+"][areaVillage]' placeholder = 'Physical Target' class='form-control' ></div>\n\
                                            </div>"
                                $(".blockvillage").append($(checkbox));
                        });

                    }
                });
            }else{
             //   $('select[name="idBlock"]').empty();
            }
        });
 });
 jQuery( document ).ready( function( $ ) {
   $('#villagedistribution').on('submit',function(e){
        $.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        })
        
  var formData = $(this).serialize();
        $.ajax({
            type:"POST",
            url: "{{url('/villagedistribution/') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
                if( data[Object.keys(data)[0]] === 'SUCCESS' ){		//True Case i.e. passed validation
                window.location = "{{url('villagedistribution')}}";
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
</script>
@stop