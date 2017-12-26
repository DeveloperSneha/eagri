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
                <input type='checkbox' class='select-all' id="ckbCheckAll"/>
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
                            <input type="checkbox" value="{{ $key}}" name="blocks[{{$key}}][idBlock]" >
                        </td>
                        <td>
                            <input type="text" class="form-control" name="blocks[{{$key}}][amountBlock]" id="amountBlock">
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('blocks.*.amountBlock'))
                                    <p>{{ $errors->first('blocks.'.$key.'.amountBlock')}}</p>
                                    @endif
                                </strong>
                            </span>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="blocks[{{$key}}][areaBlock]" id="areaBlock">
                            <span class="help-block">
                                <strong>
                                    @if($errors->has('blocks.*.areaBlock'))
                                    <p>{{ $errors->first('blocks.'.$key.'.areaBlock')}}</p>
                                    @endif
                                </strong>
                            </span>                                                       
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
    var tot, dep;
    $(document).ready(function () {
        $('.select-all').on('click', function () {
            var checkAll = this.checked;
            $('input[type=checkbox]').each(function () {
                this.checked = checkAll;
            });
        });

        $('select[name="idSchemeActivation"]').on('change', function () {
            var schemeActivationID = $(this).val();
            if (schemeActivationID) {
                $.ajax({
                    url: "{{url('/authority/schemedistrict') }}" + '/' + schemeActivationID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        tot = data.amountDistrict;
                        dep = data.areaDistrict;

                        
                        $("#blockdistribution").on('change', function () {
                            var val2 = document.getElementById("amountBlock").value;
                            if (!tot) {
                                tot = 0;
                            }
                            if (!val2) {
                                val2 = 0;
                            }
                            var ansA = document.getElementById('areaBlock');
                            ansA.value = val2 * dep;
                            var ansD = document.getElementById("area-fund");
//                            var ansD = document.getElementById("area-fund").innerHTML += (tot - ansA.value);
                            ansD.value = tot - ansA.value;
                            console.log(ansD.value);
//                            document.write(ansD.value);
                        })
                        $('#area-fund').empty();
                        $.each(data, function (key, value) {
                            $('#area-fund ').append('<label class="col-sm-2 control-label">' + key + '</label><div class="col-sm-2"><p class="form-control-static">' + value + '</p></div>');

                        });

                    }
                });
            } else {
                $('#area-fund').empty();
            }
        });
    })
    jQuery(document).ready(function ($) {
    $(document).ready(function () {
                            $("#ckbCheckAll").click(function () {
                                $(".checkBoxClass").attr('checked', this.checked);
                            });
                        });
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
                        $("#msg").html(data);	//$msg is the id of empty msg
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
</script>
@stop