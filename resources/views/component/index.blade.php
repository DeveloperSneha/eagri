@extends('layouts.app')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>@if(isset($component)) Edit @else Create @endif Component</strong>
    </div>
    <div class="panel-body">
        @if(isset($component))
        {!! Form::model( $component, ['route' => ['components.update', $component->idComponent], 'method' => 'put','class'=>'form-horizontal'] ) !!}
        @else
        {!! Form::open(['url' => 'components','class'=>'form-horizontal']) !!}
        @endif
        <div class="form-group">
            {!! Form::label('Item', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::select('idCategory',$categories, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Name Of Components', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-4">
                {!! Form::text('componentName', null, ['class' => 'form-control','placeholder'=>'Enter Component Name']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Is Active', null, ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::select('isActive',[''=>'Select','Y'=>'Yes','N'=>'No'], null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="panel-footer">
           
                @if(isset($component))
                {!!  Form::submit('Update',['class'=>'btn btn-warning'])!!}
                @else
                <!--{!!  Form::submit('Save',['class'=>'btn btn-warning'])!!}-->
			    <button type="submit" class="btn btn-danger">Save</button>
                @endif
          
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><strong> Components</strong></div>
    <div class="panel-body">
        <table class="table table-bordered" id='table1'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>IsActive</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($components as $var)
                <tr>
                    <td>{{ $var->idComponent }}</td>
                    <td>{{ $var->category->categoryName}}</td>
                    <td>{{ $var->componentName }}</td>
                    <td>{{ $var->isActive }}</td>
                    <td>
                        {{ Form::open(['route' => ['components.destroy', $var->idComponent], 'method' => 'delete']) }}
                        <a href='{{url('/components/'.$var->idComponent.'/edit')}}' class="btn btn-xs btn-warning">Edit</a>
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