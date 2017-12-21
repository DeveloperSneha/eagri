@extends('layouts.app')
@section('content')
<div id="formerrors"></div>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Scheme Distribution (Block)</strong></div>
    <div class="panel-body">
        {!! Form::open(['url' => 'blockdistribution','class'=>'form-horizontal','id'=>'blockdistribution']) !!}
        <div class="form-group">
            {!! Form::label('Scheme', null, ['class' => 'col-sm-2 control-label',]) !!}
            <div class="col-sm-5">
                {!! Form::select('idSchemeActivation',$schact, null, ['class' => 'form-control ']) !!}
               
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Scheme Distribution(District)', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                <select name="schemeDistributionDistrict" class="form-control" value="{{ old('schemeDistributionDistrict') }}"></select>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Apply to All', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-2 checkbox-inline">
                <input type='checkbox' class='select-all'/></div>
        </div>
        <div class="">
            {!! Form::label('Scheme Distribution(Blocks)', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10 distblock" name='idBlock'></div>
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
                    <th>ID</th>
                    <th>Scheme</th>
                    <th>Block</th>
                    <th>Financial Target</th>
                    <th>Physical Target</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schblock as $var)
                <tr>
                    <td>{{ $var->idSchemDistributionBlock }}</td>
                    <td>{{ $var->schactivation->scheme->schemeName}}</td>
                    <td>{{ $var->block->blockName }}</td>
                    <td>{{ $var->amountBlock }}</td>
                    <td>{{ $var->areaBlock }}</td>
                    <td>
                        {{ Form::open(['route' => ['blockdistribution.destroy', $var->idSchemDistributionBlock], 'method' => 'delete']) }}
                        <a href='{{url('/blockdistribution/'.$var->idSchemDistributionBlock.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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
        $('.select-all').on('click', function() {
            var checkAll = this.checked;
            $('input[type=checkbox]').each(function() {
                this.checked = checkAll;
            });
        });
    });
    $(document).ready(function() {
        $('select[name="idSchemeActivation"]').on('change', function() {
            var schactID = $(this).val();
            if(schactID) {
                $.ajax({
                    url: "{{url('/schact/') }}"+'/' +schactID + "/districts",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="schemeDistributionDistrict"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="schemeDistributionDistrict"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('select[name="schemeDistributionDistrict"]').empty();
            }
         //   e.preventDefault();
        });
        $('select[name="schemeDistributionDistrict"]').on('change', function() {
            var schdistID = $(this).val();
            if(schdistID) {
                $.ajax({
                    url: "{{url('/schdistrict/') }}"+'/' +schdistID + "/blocks",
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                       $('.distblock').empty();
                       $.each(data, function(key, value) {
                           
                            var checkbox="<div class='form-group'>\n\
                                                <div class='col-sm-3 checkbox-inline'><input type='checkbox' id='block' value="+key+" name='blocks["+key+"][idBlock]'><label for="+value+">"+value+"</label></div>\n\
                                                <div class='col-sm-3'><input type = 'text' name='blocks["+key+"][amountBlock]' placeholder = 'Financial Target' class='form-control'></div>\n\
                                                <div class='col-sm-3'><input type = 'text' name='blocks["+key+"][areaBlock]' placeholder = 'Physical Target' class='form-control' ></div>\n\
                                            </div>"
                                $(".distblock").append($(checkbox));
                        });

                    }
                });
            }else{
             //   $('select[name="idBlock"]').empty();
            }
        });
       
         
    });
  jQuery( document ).ready( function( $ ) {
   $('#blockdistribution').on('submit',function(e){
        $.ajaxSetup({
            header:$('meta[name="_token"]').attr('content')
        })
         
  var formData = $(this).serialize();
        $.ajax({
            type:"POST",
            url: "{{url('/blockdistribution/') }}",
            data:formData,
            dataType: 'json',
            success:function(data){
               if( data[Object.keys(data)[0]] === 'SUCCESS' ) {//True Case i.e. passed validation
                    window.location = "{{url('blockdistribution')}}";
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
        //e.preventDefault(e);
    });
});
</script>
@stop