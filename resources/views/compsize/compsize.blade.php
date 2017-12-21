@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    @if(isset($compsize))
    <div class="panel-heading"><strong>Edit Component Size </strong></div>
    @else
    <div class="panel-heading"><strong>Add  Component Size</strong></div>
    @endif
    <div class="panel-body">
        @if(isset($compsize))
        {!! Form::model( $compsize, ['route' => ['compsizes.update', $compsize->idCompSize], 'method' => 'put','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'compsizes','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Component', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('idComponent',$components, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Unit', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::select('idUnit',$units, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Size', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-5">
                {!! Form::text('size', null, ['class' => 'form-control','placeholder'=>'Component Size in Decimals']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-8">
                @if(isset($compsize))
                {!!  Form::submit('Update',['class'=>'btn btn-warning'])!!}
                @else
                <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
			    <button type="submit" class="btn btn-danger">Save</button>
                @endif
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"> <strong>Compsize</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Component</th>
                    <th>Unit</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($compsizes as $var)
                <tr>
                    <td>{{ $var->idCompSize }}</td>
                    <td>{{ $var->component->componentName }}</td>
                    <td>{{ $var->unit->unitName }}</td>
                    <td>{{ $var->size }}</td>
                   <td>
                        {{ Form::open(['route' => ['compsizes.destroy', $var->idCompSize], 'method' => 'delete']) }}
                        <a href='{{url('/compsizes/'.$var->idCompSize.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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