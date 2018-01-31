@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>@if(isset($unit)) Edit @else Create @endif Units</strong></div>
    <div class="panel-body">
        @if(isset($unit))
        {{ Form::model( $unit, ['route' => ['units.update', $unit->idUnit], 'method' => 'put','class'=>'form-horizontal'] ) }}
        @else
        {!! Form::open(['url' => 'units','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Name Of units', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('unitName', null, ['class' => 'form-control','placeholder'=>'Enter Unit Name','maxlength'=>'20','minlength'=>'2','onkeypress'=>'return lettersOnly(event)']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('unitName'))
                    <p>{{ $errors->first('unitName') }}</p>
                    @endif
                </strong>
            </span> 
        </div>
        <div class="form-group">
            {!! Form::label('Unit Type', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('unitType', null, ['class' => 'form-control','placeholder'=>'Enter Unit Type','maxlength'=>'20','minlength'=>'2','onkeypress'=>'return lettersOnly(event)']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('unitType'))
                    <p>{{ $errors->first('unitType') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="form-group">
            {!! Form::label('Base Unit', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('idBaseUnit', null, ['class' => 'form-control','placeholder'=>'Enter Base Unit','maxlength'=>'20','minlength'=>'1']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('idBaseUnit'))
                    <p>{{ $errors->first('idBaseUnit') }}</p>
                    @endif
                </strong>
            </span>
        </div>
        <div class="form-group">
            {!! Form::label('Conversion Muiltipier To Base', null, ['class' => 'col-sm-2 control-label required']) !!}
            <div class="col-sm-5">
                {!! Form::text('conversionMultipierToBase', null, ['class' => 'form-control','placeholder'=>'Enter Conversion Muiltipier To Base','maxlength'=>'20','minlength'=>'2']) !!}
            </div>
            <span class="help-block">
                <strong>
                    @if($errors->has('conversionMultipierToBase'))
                    <p>{{ $errors->first('conversionMultipierToBase') }}</p>
                    @endif
                </strong>
            </span>
            <span class="help-block">
                <strong>
                    @if($errors->has('conversionMultipierToBase1'))
                    <p>{{ $errors->first('conversionMultipierToBase1') }}</p>
                    @endif
                </strong>
            </span>
        </div>
    </div>
    <div class="panel-footer">
        @if(isset($unit))
        <!--{!!  Form::submit('Update',['class'=>'btn btn-warning'])!!}-->
        <button type="submit" class="btn btn-danger">Update</button>
        <a href="{{url('/units')}}" class="btn btn-danger">Cancel</a>
        @else
        <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
        <button type="submit" class="btn btn-danger">Save</button>
        @endif

        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong> Units</strong></div>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped dataTable" id='table1'>
            <thead>
                <tr>
                    <th>SNO</th>
                    <th>Unit Name</th>
                    <th>Type</th>
                    <th>Base Unit</th>
                    <th>Conversion Muiltipier To Base</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach($units as $var)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $var->unitName }}</td>
                    <td>{{ $var->unitType }}</td>
                    <td>{{ $var->idBaseUnit }}</td>
                    <td>{{ $var->conversionMultipierToBase }}</td>
                    <td>
                        <a href='{{url('/units/'.$var->idUnit.'/editunit')}}' class="btn btn-sm btn-warning">Edit</a>

                        <a href='{{url('/units/'.$var->idUnit.'/deleteunit')}}' class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop