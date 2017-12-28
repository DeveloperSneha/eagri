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
                    @foreach($sch_blocks as $key=>$value)
                    <tr>
                        <td><strong>{{ $value }} </strong>
                        <span id='errorblock{{$key}}' class="help-block"></span>
                        </td>
                        <td>
                            <input type="checkbox" value="{{ $key}}" name="blocks[{{$key}}][idBlock]" id='block' >                            
                        </td>
                        <td>
                            <input type="text" class="form-control" name="blocks[{{$key}}][areaBlock]"  id="areablock{{$key}}" onchange="getArea({{$key}})">
                            <span id='errorarea{{$key}}' class="help-block"></span>
                            <input type="hidden" id="hiddenarea{{$key}}">
                        </td>
                        <td>
                            <input type="text" class="form-control " name="blocks[{{$key}}][amountBlock]" id="amtblock{{$key}}">
                            <span id='erroramt{{$key}}' class="help-block"></span>
                            <input type="hidden" id="hiddenamount{{$key}}">
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
@include('view_Script.block_distjs');
@stop